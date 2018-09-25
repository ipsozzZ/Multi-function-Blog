<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/8/25
 * Time: 14:43
 */

namespace app\index\controller;


class Contact extends Common
{
    function index($id){
        $page = db('category')->where('id',$id)->find();
        if (!$page){
            abort('404');
        }
        $this->assign('page',$page);
        // 返回左侧栏目列表
        $contact = $this->getchild('contact');
        $top_child = $contact[0];  // 顶级栏目作为左侧栏目标题
        $this->assign('top_child', $top_child);
        unset($contact[0]);
        $this->assign('contact',$contact);

        // 获取当前栏目id
        $this->assign('currid',$id);
        return view();
    }
}