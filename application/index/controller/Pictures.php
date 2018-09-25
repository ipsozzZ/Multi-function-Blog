<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/8/25
 * Time: 14:28
 */

namespace app\index\controller;


class Pictures extends Common
{

    protected function _initialize(){
        parent::_initialize();
        // 返回左侧栏目列表
        $pictures_child = $this->getchild('pictures');
        $top_child = $pictures_child[0];  // 顶级栏目作为左侧栏目标题
        $this->assign('top_child', $top_child);
        unset($pictures_child[0]);  // 由于顶级栏目不显示在左侧栏目中，所以过滤掉顶级栏目
        $this->assign('pictures_child', $pictures_child);
    }

    /**
     * @param null $id 栏目的id
     * @return \think\response\View
     */
    public function index($id=null)
    {
        // 获取文章内容
        if ($id == null){
            $this->error('访问内容不存在！！！');
        }
        $res = db('article')->alias('a')
            ->join('pics b','b.aid=a.id')
            ->where('cid',$id)
            ->field('a.*, b.pic')
            ->paginate('8');
        $panduanid = db('category')->where('id',$id)->find();
        if ($panduanid == null){
            abort('404');
        }
        $this->assign('list',$res);
        // 获取当前栏目id
        $this->assign('currid', $id);
        return view();
    }

    // 图片详情页
    public function show($id){
        $result = db('article')->alias('a')
            ->join('pics b','b.aid=a.id')
            ->where('a.id',$id)
            ->field('a.*,b.pic')
            ->select();
        $panduan_id = db('category')->where('id',$result[0]['cid'])->find();
        if (!$panduan_id){
            abort('404');
        }
        // 获取当前栏目id
        $this->assign('currid', $result[0]['cid']);
        $this->assign('article',$result[0]);

        return view();
    }
}