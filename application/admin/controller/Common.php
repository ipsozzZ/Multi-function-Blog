<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/2
 * Time: 20:15
 */

namespace app\admin\controller;

use think\Controller;

class Common extends Controller
{
    protected function _initialize()
    {
        parent::_initialize();  // 继承父类的初始化方法
        // 登录状态验证
        session_start();
        if (!session('loginname', '', 'admin') || !session('loginid','', 'admin')){
            $controller = request()->controller();  // 获取当前控制器
            $action = request()->action();  // 获取当前方法
            if($controller === 'Index' && $action === 'index'){
               $this->redirect('login/index');
            }
            $this->error('未登录，不允许访问！','login/index');
//            $this->redirect('login/index');
        }
        // 获取网站配置信息
        $configRes = db('config')->find();
        $config = json_decode($configRes['config'],true);
        $this->assign('config',$config);

        $this->assign('admin',session('loginname','','admin'));
    }

    // 栏目图片上传
    public function uploadimg(){
        // 获得上传文件对象
        $file = request()->file('imgfile');
        // 判断$file是不是文件对象
        if ($file){
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); // 上传文件到网站指定目录
            $imgPath ="uploads\\".$info->getSaveName();  // 获取图片地址
            return json(['code'=>1 ,'msg'=>'上传成功!','img'=>$imgPath]);
        }else{
            return json(['code'=>0 ,'msg'=>$file->gatError()]);
        }
    }

    // 栏目单张图片删除
    /**
     * @param string $url 图片地址
     */
    public function delimg($url=""){
        if ($url != "" || !empty($url)){
            $file = ROOT_PATH."public\\".$url;
            if (file_exists($file)){
                $res = unlink($file);
                if ($res){
                    // 删除成功
                    // 删除数据表中对应的图片记录
                    $this->delpic($url);
                    return json(['code' => 1,'msg' => '删除成功!!']);
                }
                return json(['code' => 0,'msg' => '删除失败!!!']);
            }
            // 删除数据表中对应的图片记录
            $this->delpic($url);
            return json(['code' => 2,'msg' => '文件不存在!!!']);
        }
    }

    // 删除数据表中的图片记录
    protected function delpic($url){
        // 判断数据表中是不是有对应的图片记录
        $pic = db('pics')->where('pic',$url)->field('id')->find();
        if ($pic){
            db('pics')->delete($pic['id']);
        }
    }
}