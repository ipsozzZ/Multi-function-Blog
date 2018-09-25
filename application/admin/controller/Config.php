<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/9
 * Time: 20:53
 */

namespace app\admin\controller;


class Config extends Common
{
    public function index(){
        if (request()->isPost()){
            $data = input('post.');
            // 获取上传文件对象
            $file = input('file.logoimg'); // logoimg是html中文件域的name值
            if ($file){  // 如果没有上传图片就不对$data['logo']进行处理
                $data['logo'] = $this->loadimg($file);  // 把文件在服务器上的路径赋给$data['logo'];
            }

            /*json_encode()将数组转换成字符串，如果输入值有中文则需要加第二个参数'JSON_UNESCAPED_UNICODE',否则它会将中文转码*/
//            dump(json_encode($data,JSON_UNESCAPED_UNICODE));
            // 写入数据库
            // 方法一： 这是确定数据表为空的情况 这种是在数据表里手动将id改为1，因为这里只有一条记录，所以可以手动将数据库中表的id赋值为1
//            $result = db('config')->where('id',1)->update(['config'=>json_encode($data,JSON_UNESCAPED_UNICODE)]);
//            if (!$result){
//                $this->error('修改失败!');
//            }

            // 方法二：自动新增，不用手动改id，不确定数据表中是否有记录
            $result = db('config')->find();
            if (!$result){
                db('config')->insert(['config'=>json_encode($data,JSON_UNESCAPED_UNICODE)]);
            }else{
                $result = db('config')->where('id',$result['id'])->update(['config'=>json_encode($data,JSON_UNESCAPED_UNICODE)]);
                if(!$result){
                    $this->error('修改失败！');
                }
            }
        }
        $res = db('config')->find();
        $config = json_decode($res['config'],true);  // 加第二个参数true,是为了将不加参数时的对象类型的数据转换成数组类型
        // 分配模板变量
        /*注意，数组在分配到html页面中的调用方式时“数组名.索引”或者“数组名['索引']”,而对象的调用则是“对象名->索引”*/
        $this->assign('config',$config);
        return view();
    }

    protected function loadimg($file)
    {
        if ($file){
            // 上传图片
            $info = $file->move(ROOT_PATH, 'public'.DS.'uploads','logo/logo');
            // 获取服务器上的的文件路径
            $path = $info->getSaveName();
            return $path;
        }
    }
}