<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/8/4
 * Time: 15:11
 */

namespace app\index\controller;


class Page extends Common
{
    //
    public function index($id){
        $page = db('category')->where('id',$id)->find();
        if (!$page){
            abort('404'); // 手动抛出异常
        }
       /* // 获取当前位置
        $curr_location = $this->getlocation($id);
        $this->assign('location',$curr_location);*/
        $this->assign('page',$page);
        // 返回左侧栏目列表
        $about = $this->getchild('about');
        $top_child = $about[0];  // 顶级栏目作为左侧栏目标题
        $this->assign('top_child', $top_child);
        unset($about[0]);
        $this->assign('about',$about);

        // 获取当前栏目id
        $this->assign('currid',$id);
        return view();
    }
}