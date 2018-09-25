<?php
namespace app\admin\controller;

use think\Db;

class Index extends Common
{
    public function index()
    {
        return view();
    }

    /**
     * 获取后台首页面
     * @return \think\response\View
     */
    public function system(){
        // 获取服务器信息，使用超全局变量,$_SERVER
//        dump(php_uname());  // 不加参数时获得详细的操作系统信息，加参数获得简写形式
//        dump(PHP_OS); // 获得简写操作系统信息
        $system = [
            'ip' => $_SERVER['SERVER_ADDR'], // 获取服务器ip地址
            // 服务器域名/主机名
            'host' => $_SERVER['SERVER_NAME'],
            // 服务器操作系统
            'os' => PHP_OS,
            // 运行环境
            'server' => $_SERVER["SERVER_SOFTWARE"],
            // 服务器端口
            'port' => $_SERVER['SERVER_PORT'],
            // PHP版本
            'php_ver' => PHP_VERSION,
            'mysql_ver' => Db::query('select version() as ver')[0]['ver'],
            'database' => config('database')['database'],
        ];
        $logRes = db('loginlog')->order('logintime desc')->where('mid',session('loginid','','admin'))->limit(10)->select();
        $this->assign('system',$system);
        $this->assign('log',$logRes);
//        dump();
        return view();
    }
}
