<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/6/7
 * Time: 13:33
 */

namespace app\admin\controller;


class Banner extends Common
{
    // 轮播图列表
    public function index(){
        $res = model("Banner")->order('id Desc')->select();
        $this->assign('pics',$res);
        return view('banner_list');
    }

    // 添加轮播图
    public function Add(){
        if (request()->isPost()){
            $data = input('post.');
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('upimg');
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                $picpath = "uploads\\".$info->getSaveName();
                $data['pic'] = $picpath;
            }
            // 使用模型的方法写入数据库
            if(model("Banner")->save($data)){
                $this->success('添加成功!','index');
            }
            $this->error('添加失败!!!','index');
        }
        return view('banner_add');
    }

    // 处理异步数据
    public function setajax(){
        if (request()->isAjax()){
            $data = input('post.');
            $newdata = [];
            $newdata['id'] = $data['id'];
            if ($data['act'] == "show"){
                $newdata['isshow'] = $data['v'];
            }
            if ($data['act'] == "sort"){
                $newdata['sort'] = $data['v'];
            }
            if (model('Banner')->update($newdata)){
                return json(1);
            }else{
                return json(0);
            }
        }
    }

    // 编辑轮播图
    public function edit($id){
        if (request()->isPost()){
            $data = input('post.');
            if(!isset($data['isshow'])){
                $data['isshow'] = 0;
            }
            // 获取表单上传文件 例如上传了001.jpg
            $file = request()->file('upimg');
            if ($file){
                if($file){
                    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    $picpath = "uploads\\".$info->getSaveName();
                    $data['pic'] = $picpath;
                }
                // 删除图片
                $pic = db('banner')->field('pic')->find($id);
                $picurl = ROOT_PATH.'public\\'.$pic['pic'];
                @unlink($picurl);  // 使用@即使没有图片也执行删除操作并且不会报错，否则就会报错
            }
            if(model('Banner')->save($data,['id'=>$id])){
                $this->success('更新成功!','index');
            }
            $this->error('更新失败!!!','index');
        }
        $res = model('Banner')->get($id);
        $this->assign('banner',$res);
        return view('banner_edit');
    }

    // 删除轮播图
    public function del($id,$pic=null){
//        dump(urldecode($pic));
//        dump($id);
        $banner_model = model('Banner');
        // 删除数据库记录
        if ($banner_model::destroy($id)){
            // 删除服务器上的图片
            $picurl = ROOT_PATH.'public\\'.urldecode($pic);
            @unlink($picurl);
            $this->success('删除成功!!','index');
        }
        $this->error('删除失败!!!','index');
    }
}