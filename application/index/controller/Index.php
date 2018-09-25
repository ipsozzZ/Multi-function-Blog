<?php
namespace app\index\controller;

use think\Db;

class Index extends Common
{
    public function index()
    {
        $banner = $this->getbanner();
        $about = $this->getabout();
        $pictures = $this->getpictures();
        $pic_cate = $this->getcatebyid($pictures[0]['list'][0]['cid']);
        $this->assign([
            'banner' => $banner,
            'about' => $about,
            'pictures' => $pictures,
            'pic_cate' => $pic_cate,
        ]);
        return view();
    }

    // 获取轮播图
    private function getbanner(){
        $res = db('banner')->where('isshow',1)->order('sort ASC')->field('title,pic,url')->select();
        return $res;
    }

    // 获取关于我的文字描述
    private function getabout(){
        $res = db('category')->where('mark','about')->field('content,name,keyword')->find();
        return $res;
    }

    // 获取pictures 首页MY　PICTURES中每个分类图片只能显示６张，在后台中将内容图片置顶就可以在首页中展示
    private function getpictures(){
        $res_pid = db('category')->where('mark','pictures')->field('id')->find();
        $res = db('category')->where('pid',$res_pid['id'])->field('id,name')->select();
        foreach ($res as $k=>$v){
            $list = db('article')->alias('a')
                ->join('pics b','b.aid=a.id')
                ->where('a.cid',$v['id'])
                ->where('a.istop',1)
                ->field('a.id,a.title,a.cid,b.pic')
                ->select();
            $res[$k]['list'] = $list;
        }
        return $res;
    }

    // 获取分栏的标题栏目
    private function getcatebyid($id){
        $cate = db('category')->where('id',$id)->field('id,name,pid,keyword')->select();
        $arr = [];
        if ($cate){
            $arr['name'] = $cate[0]['name'];
            $arr['keyword'] = $cate[0]['keyword'];
            if ($cate[0]['pid'] != 0){
                $pre_cate = $this->getcatebyid($cate[0]['pid']);
                $arr = $pre_cate;
            }
            return $arr;
        }
    }
}