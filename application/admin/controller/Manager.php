<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/4/24
 * Time: 14:02
 */

namespace app\admin\controller;
use app\admin\model\Manager as Model;
//use think\Controller;
//use think\Validate;

class Manager extends Common
{
//    管理员列表
    public function index(){
        /*db('user')->where('id',1)->find(); // 查询符合条件的一条数据*/
        $res = db('manager')->paginate(5); // 查询整个数据库内符合条件的所有数据
        $this->assign('manager',$res);
        return view();
    }

//  添加管理员
    public function add(){
        if(request()->isPost()){
            $data = input('post.'); // 接受数据
            $validate = Validate('Manager'); // 定义验证器
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError(),"add","","1"); // 如果后端验证没有通过，就进行错误提示，并进行跳转
                return;
            }
//            如果验证通过，则数据写入数据库
            unset($data['repassword']);
            $data['password'] = md5($data['password']); // 使用md5进行加密
            if (db("manager")->insert($data)){
                $this->success("管理员添加成功", "add","","1"); // 因为这里已经在控制器目录下了，所以不用在add前加控制器名了
            }else{
                $this->error("数据添加异常", "add","","1");
            }
            return;
        }
        return view();
    }

    // 编辑管理员
    public function edit($id){  // 使用了方法的参数绑定，只要传递过来的参数有id，就能获取这个值
        if(request()->isPost()){
            $data = input("post.");
            if(isset($data['account'])){
                unset($data['account']);
            }
            if (!$data['password']){
                unset($data['password']);
                unset($data['repassword']);
            }else{
                $validate = validate('manager');
                if(!$validate->scene('edit')->check($data)){
                    $this->error($validate->getError());
                }
                unset($data['repassword']);
                $data['password'] = md5($data['password']);
            }
            if ($data['state'] == 0 && $id == 1){
                $this->error('超级管理员不允许锁定！','','','1');
            }
//            dump($data);
            $result =  db('manager')->where('id',$id)->update($data);
            if (!$result){
                $this->error('管理员修改失败！','','','1');
            }
            $this->success('管理员修改成功!','manager/index','','1');
            return;
        }
        $res = db('manager')->where('id',$id)->field('account,state')->find();
        $this->assign('manager',$res);
        return view();
    }
//    管理员删除
    public function del($id){
        if ($id == 1){
            $this->error('超级管理员不允许删除','manager/index',"","1");
        }
        $result = db('manager')->where('id',$id)->delete();
        if($result){
            $this->success('删除成功','manager/index',"","1");
        }else{
            $this->error('删除失败','manager/index',"","1");
        }
    }

//    当前管理员的密码修改
    public function setpass(){ // 不用传递id，因为当前id可以从session中获取
        if(request()->isPost()){
            $data = input('post.');
//            dump($data);
            $validate = validate('Manager'); // 实例话验证器类
            // 验证器场景验证
            if (!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            $res = db('manager')->field('password')->find(session('loginid','','admin'));
            if (md5($data['oldpassword']) != $res['password']){
                $this->error('旧密码输入错误!');
            }
            $result = db('manager')->where('id',session('loginid','admin'))->setField('password',md5($data['password']));
            if (!$result){
                $this->error('密码修改失败！');
            }
            $this->success('密码修改成功！');
//            dump($res);
            return;
        }
        return view();
    }

}