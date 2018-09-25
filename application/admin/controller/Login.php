<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/4/30
 * Time: 20:37
 */

namespace app\admin\controller;
use think\Controller;
//use think\Session;

class Login extends Controller
{
    public function index(){
        if (request()->isPost()){
            // 1、接受数据
            $data = input('post.');
            // 2、登录验证
            $result = $this->logincheck($data);
            if (isset($result['mid'])){
                $data_log = [
                    'mid' => $result['mid'],
                    'ip' => request()->ip(),
                    'logintime' => time(),
                    'msg' => $result['msg'],
                ];
                // 获取日志表的记录数量
                $log_rows = db('loginlog')->count();
                $log_min = db('loginlog')->min('logintime');
                if ($log_rows = 30){
                    $log_min = db('loginlog')->min('logintime'); // 获取日志中记录时间最晚的的记录
                    db('loginlog')->where('logintime', $log_min)->delete();
                }
//                dump($log_min);
//                dump($log_rows);
                db('loginlog')->insert($data_log);
            }

            // code=1登录成功，跳转后台首页
            if ($result['code'] == 1){
                $this->success($result['msg'],'index/index');
            }
            $this->error($result['msg']); // 否则就输出登录错误信息
            dump($data);
        }
        // 用session值判断登录状态
        if (session('loginname', '', 'admin') && session('loginid','', 'admin')){
            $this->redirect('未登录，不允许访问！','index/index');
        }
        return view();
    }

    /**
     * 登录验证
     * @param $data  登录信息
     * return code:0:登录失败，1：登陆成功，msg：登录的提示信息
     */
    protected function logincheck($data){
        // 1、后端数据验证 (验证数据是否符合后端数据验证规则，验证验证码是否正确)（因为能执行这个方法就说明前端数据验证已经通过，所以我们就只需要进行后端数据验证）
        $validate = validate('Manager');
        if(!$validate->scene('login')->check($data)){
            // $this->error($validate->getError());
            return ['code'=>0, 'msg'=>$validate->getError()];
        }
        // 2、验证用户名是否在数据库中是否存在
        $res=db('manager')->where('account',$data['account'])->find();
        if(!$res){
            // $this->error('用户名不存在');
            return ['code'=>0, 'msg'=>'用户名不存在'];
        }
        // 3、验证密码是否与数据库中密码是否一致
        if (md5($data['password'])!=$res['password']){
            // $this->error('密码输入不正确！');
            return ['code'=>0, 'msg'=>'密码输入不正确', 'mid'=>$res['id']];
        }
        // 4、验证管理员的状态
        if ($res['state'] == 0){
            // $this->error('账号已经被锁定，不允许登录！');
            return ['code'=>0, 'msg'=>'账号已经被锁定，不允许登录！', 'mid'=>$res['id']];
        }
        // 保存登录信息到session，登录成功！
        session('loginname',$res['account'], 'admin');  // prefix:'admin'是指作用域是admin部分，防止同一台电脑同时登录前后台时发生错误
        session('loginid', $res['id'], 'admin');
//        $this->error('登录成功！','index/index','','3');
        return ['code'=>1, 'msg'=>'登录成功！', 'mid'=>$res['id']];
    }
    // 退出登录
    public function logout(){
        session(null,'admin'); // 删除保存在session中的值
        $this->success('退出成功！','login/index');
    }
}