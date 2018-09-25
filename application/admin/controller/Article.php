<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/17
 * Time: 19:11
 */

namespace app\admin\controller;
use app\admin\model\Category as CateModel;
use think\Console;
use think\Model;
use think\Validate;

class Article extends Common
{
    // 内容列表
    public function index($cid=null){
        if ($cid){
            $map = ['a.cid'=>$cid];
        }else{
            $map = [];
        }
        // JOIN方法也是连贯操作方法之一，用于根据两个或多个表中的列之间的关系，从这些表中查询数据。
        $res = db('article')->alias('a') // 给article表一个别名a
            ->join('category b','b.id=a.cid')  // b是category的别名 b.id=a.cid 条件是栏目表的cid等于内容表的id
            ->join('pics c','c.aid=a.id','LEFT') // 将内容表与内容图片表用内容id建立关联
            ->order('a.istop Desc, a.toptime Desc, a.addtime Desc') // 按是否置顶、置顶时间、添加时间降序排序
            ->field("a.*,b.name,count(c.pic) as pic")  // 筛选
            ->where($map)
            ->group('a.id')
            ->paginate(5,false,['query'=>['cid'=>$cid]]); // paginate 分页，每页的记录数,还要注意分页参数的使用
        $this->assign('list',$res);
        // 栏目获取
        $cateall = CateModel::order('sort Desc,id Asc')->select(); // 获取所有的栏目
        $res = CateModel::getcateall($cateall, 0,-1);  // 已优化
        $this->assign('cate',$res);
        $this->assign('cid',$cid);
        return view('article_list');
    }

    // 添加内容
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            $data['addtime'] = strtotime($data["addtime"]); // 因为前台提交来的时间是一个字符串，所以要将字符串通过strtotime()转换成时间戳
            if (isset($data['istop'])){ // 如果置顶了需要获取当前的置顶时间
                $data['toptime'] = time();
            }
            $data['views'] = 0;
            // 后端数据验证
            $validate = Validate('Article');
            if (!$validate->check($data)){
                $this->error($validate->getError(),'article/add');
            }
            // 写入数据库
            $data['fabul'] = 0;
            $data['comment'] = 0;
            $result = model('Article')->allowField(true)->save($data);  // allowField(true) 过滤了数据表中没有的字段，不用unset来删除了
            if (!$result){
                $this->error("内容添加失败");
            }
            $this->success("内容添加成功",'article/index');
            return;
        }
        // 静态方法获取栏目列表
        // $CateModel = model('Category'); // 如果不加“use app\admin\model\category as CateModel;”，就需要用这个方法
        $cateall = CateModel::order('sort Desc,id Asc')->select(); // 获取所有的栏目
        $res = CateModel::getcateall($cateall, 0,-1);  // 已优化
        $this->assign('cate',$res);
        return view('article_add');
    }

    // 编辑内容
    public function edit($id){
        if (request()->isPost()){
            $data = input('post.');
            $data['addtime'] = strtotime($data['addtime']);
            if (isset($data['istop'])){ // 如果置顶了需要获取当前的置顶时间
                $data['toptime'] = time();
            }
            $data['views'] = 0;
            // 后端数据验证
            $validate = Validate('Article');
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            // 更新文章信息
            model('Article')->allowField(true)->save($data,['id' => $id]);
            $this->success('修改成功！','index');
        }

        // 获取文章对应图片信息

        // 方法1、分表查询
        // 获取文章信息
        $res = db('article')->where('id',$id)->find();
        $pics = db('pics')->where('aid',$id)->field('pic')->select();
        $res['pic'] = $pics;

        // 方法2、使用join关联查询
        /*$res = db('article')->alias('a')
            ->join('pics b', 'b.aid=a.id')
            ->field('a.*,GROUP_CONCAT(b.pic) as pic') // GROUP_CONCAT()tp的一个内置函数，能获取的所有图片地址，如果不用的话只能获取到一张图片的地址
            ->where('a.id',$id)
            ->find();
        $res['pic'] = explode(",",$res['pic']);*/

        $this->assign('article',$res);
        // 栏目获取
        $cateall = CateModel::order('sort Desc,id Asc')->select(); // 获取所有的栏目
        $cates = CateModel::getcateall($cateall, 0,-1);  // 已优化
        $this->assign('cate',$cates);
        return view('article_edit');
    }

    // 内容置顶
    public function istop(){
        if (request()->isAjax()){
            $data = input('post.');
            $value = [];
            $articleModel = model('Article');
            $value['id'] = $data['id']; // id是不是置顶都要写入数据库
            $value['toptime'] = time(); // 当前时间戳是不是置顶都要写入数据库
            if ($data['istop'] === "true"){
                $value['istop'] = 1;
                if ($articleModel::update($value)){
                    return json(['code'=>1, 'msg'=> '置顶成功！']);
                }
                return json(['code'=>0, 'msg'=> '操作失败!!！']);
            }else{
                $value['istop'] = 0;
                if ($articleModel::update($value)){
                    return json(['code'=>1, 'msg'=> '取消置顶成功！']);
                }
                return json(['code'=>0, 'msg'=> '操作失败!!！']);
            }
        }
    }

    // 对应内容id为aid的内容图片列表
    public function pics($aid){
        $res = db('pics')->where('aid',$aid)->order('sort Desc,id Desc')->select();
        $this->assign('pics',$res);
        return view('article_pic');
    }

    // 内容图片列表中单张图片删除
    /**
     * @param string $id 要删除的图片id
     * @return \think\response\Json|void
     */
    public function delpic($id){
        $res = db('pics')->where('id',$id)->find();
        if ($res){
            $pic = $res['pic'];
            $result = db('pics')->delete($id);
            if ($result){
                $file = ROOT_PATH."public/".$pic;  // 要保存绝对路径，否则有可能找不到文件路径
                if (file_exists($file)){
                    if (unlink($file)){
                        $this->success('删除图片成功!');
                    }else{
                        $this->error('删除图片失败!!!');
                    }
                }
                $this->error('文件不存在!!');
            }
            $this->error('操作失败!!');
        }
        $this->error('未发现图片路径!!!');
    }

    // 内容图片排序
    public function picsort(){
        if (request()->isAjax()){
            $data = input('post.');
            $result = db('pics')->update($data);
            // dump($result);die;
            if ($result){
                return json(['code'=>1,'msg'=>'排序成功!!!']);
            }
            return json(['code'=>0,'msg'=>'排序失败!!!']);
        }
    }

    // 内容删除
    public function del($aid){
        $article = model('Article');
        if ($article::destroy($aid)){ // 内容删除成功,删除对应的内容图片
            // 删除文章对应的评论
            $delres = db('comment')->where('aid',$aid)->field('id')->select();
            db('comment')->where('aid',$aid)->delete();
            // 删除评论后，清除数据表中对应的点赞数据
            $arr_cid = $this->changeArray($delres);
            if ($arr_cid){
                foreach ($arr_cid as $v){
                    db('fabullog')->where('cid',$v)->delete();
                }
            }
            // 删除文章对应的点赞信息
            db('fabullog')->where('aid',$aid)->delete();
            $this->success('文章删除成功!');
        }
        $this->error('删除失败!!!'); // 内容删除失败
    }

    // 批量删除
    public function delall(){
        if (request()->isPost()){
            $data = input('post.');
            /*if (isset($data['cid'])){
                unset($data[cid]);
            }*/
            // 排除干扰项
            //if (isset($data['istop'])){
                //  unset($data['istop']);
            // }
            if (empty($data['id'])){
                $this->error('请选择要删除的内容');
            }
            $article = model('Article');
            if ($article::destroy($data['id'])){ // 批量删除内容，参数为一个数组，$data本身是一个二维数组 内容删除成功后会自动调用模型中的一个模型事件（之前写过的）自动删除内容对应图片
                // 模型中调用模型事件自动删除对应的内容图片
                $this->success('删除成功!!!');
            }
            $this->error('删除失败!!!'); // 内容删除失败
        }
    }

    // 文章评论、我的留言
    public function views($aid=null){
        if ($aid){
            $map = ['a.aid'=>$aid];
        }else{
            $map = [];
        }
        $result = db('comment')->alias('a')
            ->join('article b','a.aid = b.id')
            ->where($map)
            ->field('a.*,b.title')
            ->paginate(5,false,['query'=>['aid'=>$aid]]);
        // 文章获取
        $article = db('article')->alias('a')
            ->join('category b','a.cid = b.id')
            ->where('b.mark',"news")
            ->field('a.*,b.mark')
            ->select(); // 获取所有的标识为news的文章
//        dump()
        $this->assign('article',$article);
        $this->assign('views',$result);
        $this->assign('aid',$aid);
        return view("article_views");
    }
    // 对应评论id为cid的评论获赞列表
    public function fabul($cid){
        $res = db('fabullog')->where('cid',$cid)->order('id Asc')->paginate(8);
        $this->assign('fabul',$res);
        return view('comment_fabul');
    }
    //删除评论
    public function fabuldel($cid){
        $comment = db('comment')->where('id',$cid)->find();
        $del_comment = db('comment')->where('id',$cid)->delete();
        if (!$del_comment){
            $this->error('评论不存在!');
        }else{
            // 如果删除评论成功对应的内容的评论数也要减1
            $article_comment = db('article')->where('id',$comment['aid'])->field('comment')->find();
            $article_comment['comment'] -= 1;
            $delres = db('article')->where('id',$comment['aid'])->setField('comment',$article_comment['comment']);
            if (!$delres){
                $this->error('删除评论失败');
            }
            // 删除评论对应的点赞
            $delres = db('fabullog')->where('cid',$cid)->select();
            if (!$delres){
                $this->success('评论删除成功');
            }
            db('fabullog')->where('cid',$cid)->delete();
            $this->success('评论删除成功');
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