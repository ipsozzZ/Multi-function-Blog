<?php
/**
 * tp内置验证
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/4/25
 * Time: 14:36
 */

/** 后台数据验证器*/
namespace app\admin\validate;

use think\Validate;
class Manager extends Validate
{
    protected $rule = [
        'account' => 'require|min:4|unique:manager',
        'password' => 'require|min:6|confirm:repassword',
        'code'  => 'require|captcha',
    ];
    protected $message  =   [   // 验证提示信息
        'account.require' => '账号不能为空',
        'account.min'     => '账号长度不符合规则',
        'account.unique'   => '账号已存在',
        'password.require'  => '密码不能为空',
        'password.min'        => '密码长度不能小于6位',
        'password.confirm'  => '两次密码输入不一致',
        'code.require'   => '验证码不能为空',
        'code.captcha'   => '验证码输入不正确',
    ];

    protected $scene = [  // 场景验证
        'add' =>  ['account', 'password'],
        'edit'  =>  ['password'],
        'login' =>  ['account'=>'require|min:4','password'=>'require|min:6','code'],
//        'pass' => ['password'],  // 本来是用来做修改密码的,但是由于和‘edit’一样所以可以直接用一个就行
    ];
}