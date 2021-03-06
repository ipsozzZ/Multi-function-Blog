<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/8/4
 * Time: 16:29
 */

namespace app\index\controller;


class News extends Common
{
    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        // 返回左侧栏目列表
        $news_child = $this->getchild('news');
        $top_child = $news_child[0];  // 顶级栏目作为左侧栏目标题
        $this->assign('top_child', $top_child);
        unset($news_child[0]);
        $this->assign('news_child', $news_child);
    }

    public function index($id=null){
        $this->assign('currid', $id);
        // 获取文章内容
        if ($id == null){
            $this->error('访问内容不存在！！！');
        }
        $res = db('article')->alias('a')
            ->join('pics b','b.aid=a.id')
            ->where('cid',$id)
            ->field('a.*, b.pic')
            ->select();
        if (!$res){
            abort('404');
        }
        $this->assign('list',$res);
        return view();
    }
    // 文章详情页
    public function show($id){
        $result = db('article')->alias('a')
            ->join('pics b','b.aid=a.id')
            ->where('a.id',$id)
            ->field('a.*,b.pic')
            ->select();
        if (!$result){
            abort('404');
        }
        // 当前文章id
        $aid = $result[0]['id'];
        $ip = request()->ip(); // 通过tp的ip()函数获取访客ip
        // 每点击一次浏览数加一
        if ($result){
            /**
             * 第一种方法
             * 使用session防刷浏览次数，效果不太理想，容易破解
             */
           /* if (session('views') != md5($aid)){
                db('article')->where('id',$aid)->setInc('views'); // setInc()为tp的内置函数，用于对数据库中的数据进行更新每次加一
                session('views',md5($aid));
            }*/

            /**
             * 第二种方法
             * 数据库添加浏览日志记录访客的ip地址防刷
             * whereTime('viewtime','d')tp的一个查询时间函数，当数据添加时间是在规定的时间内的符合条件
             * whereTime('viewtime','<', date('Y/m/d',time())) p的一个查询时间函数，小于某个时间
             */
            db('viewslog')->whereTime('viewtime','<', date('Y/m/d',time()))->delete(); // 把一天以前的数据全部清楚，因为用不到
            $res_views = db('viewslog')
                ->where('aid',$aid)
                ->where('viewIP',$ip)
                ->whereTime('viewtime','d') // 当访问一次后要过一天以后才能在访问的时候增加浏览次数
                ->find();
            if (!$res_views){
                db('article')->where('id',$aid)->setInc('views'); // setInc()为tp的内置函数，用于对数据库中的数据进行更新每次加一
                db('viewslog')->insert(['aid'=>$aid,'viewIP'=>$ip,'viewtime'=>time()]);
            }
        }
        // 在评论区显示评论内容
        $myComment = db('comment')->where('aid',$id)->paginate(5);
        // 获取当前ip在当前文章中的评论列表中的点赞情况
        $fabul_A = db('fabullog')->where('aid',$id)->where('uip',$ip)->field('id')->find();
        // 获取当前文章下的所有评论中当前ip所赞过的所有评论id
        $YCid = db('comment')->alias('a')
            ->join('fabullog b','a.id = b.cid')
            ->where('a.aid',$id)
            ->where('b.uip',$ip)
            ->field('a.id')
            ->select();
        // 将二维数组中的id值取出来放到一维数组中
        $arr_Cid = $this->changeArray($YCid);
//        dump($arr_Cid);die;
        $this->assign([
            'arr_Cid' => $arr_Cid,
            'fabul_A' => $fabul_A,
            'comment' => $myComment,
            'currid' => $result[0]['cid'],
            'article' => $result[0]
        ]);
        return view();
    }

    // 文章评论
    public function comment($comment,$aid){
        if ($comment == null || $aid == null){
            return json("请输入你想要对作者说的话");
        }else{
            if (!db('article')->where('id',$aid)->find()){
                return json("文章不存在或已被作者删除!!");
            }
            $data = [
                'aid' => $aid,
                'content' => $comment,
                'pic' => "",
                'uid' => request()->ip(),
                'uname' => "我超帅的",
                'views' => 0,
                'addtime' => time(),
            ];
            $res = db('comment')->insert($data);
            // 将文章表中的文章评论数量加1
            if (!$res){
               return json("糟糕！发表评论失败!!");
            }
             $Acomment = db('article')->where('id',$aid)->field('id,comment')->find();
                $Acomment['comment'] = $Acomment['comment'] + 1;
                $result = db('article')->where('id',$aid)->setField('comment',$Acomment['comment']);
                if ($result==0){
                    return json("糟糕！发表评论失败!!");
                }
                return json("ok");
        }
    }

    // 文章、评论点赞
    public function fabulous($id,$mark){
        if ($id ==null || $mark == null){
            return json("点赞失败");
        }else{
            if ($mark == "comment"){
                $currip = request()->ip();
                // 判断是否已经点过赞
                $res = db('fabullog')->where('cid',$id)->where('uip',$currip)->find();
                if ($res){
                    return json("你已经为楼主点过赞了呢！");
                }else{
                    $Cfabul = db('comment')->where('id',$id)->find();
                    $Cfabul['views'] = $Cfabul['views'] + 1;
                    $result = db('comment')->where('id',$id)->setField('views',$Cfabul['views']);
                    if ($result == 0){
                        return json("评论点赞失败!");
                    }
                    $data = [
                        'uip' => request()->ip(),
                        'aid' => null,
                        'cid' => $id,
                        'fabultime' => time(),
                    ];
                    $inresult = db('fabullog')->insert($data);
                    if ($inresult == 0){
                        return json("点赞操作异常!");
                    }
                    return json("ok");
                }
            }
            elseif ($mark == "article"){
                $currip = request()->ip();
                // 判断是否已经点过赞
                $res = db('fabullog')->where('aid',$id)->where('uip',$currip)->find();
                if ($res){
                    return json("你已经为作者点过赞了呢！");
                }else{
                    $Afabul = db('article')->where('id',$id)->find();
                    $Afabul['fabul'] += 1;
                    $Aresult = db('article')->where('id',$id)->setField('fabul',$Afabul['fabul']);
                    if ($Aresult == 0){
                        return json("文章点赞失败");
                    }
                    $data = [
                        'uip' => request()->ip(),
                        'aid' => $id,
                        'cid' => null,
                        'fabultime' => time(),
                    ];
                    $inresult = db('fabullog')->insert($data);
                    if ($inresult == 0){
                       return ("点赞操作异常");
                    }
                    return json("ok");
                }
            }else{
                return json("操作异常！");
            }
        }
    }

    // 将二维数组转化为一维数组
    protected function changeArray($arr){
        $newArr = [];
        foreach ($arr as $k => $v){
            foreach ($v as $i){
                $newArr[] = $i;
            }
        }
        return $newArr;
    }
}