<?php
/**
 * 栏目数据接收
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/10
 * Time: 16:51
 */

namespace app\admin\controller;
use app\admin\model\Category as CateModel;

class Category extends Common
{
    // 栏目列表
    public function index(){
        $cateall = CateModel::order('sort Desc,id Asc')->select();
        $cate = CateModel::getcateall($cateall,0,-1);
        $this->assign('cate',$cate);
        return view();
    }

    // 栏目添加
    public function add(){
        if (request()->isPost()){
            $data = input('post.');
            // imgfile是图片文件，图片我们是不存到数据库的，我们只是把图片在服务器的一个地址存入数据库，所以在存入数据库前需要把提交来的图片删除
            if (isset($data['imgfile'])){
                unset($data['imgfile']);
            }
            $result = CateModel::create($data);
            if ($result){
                $this->success('栏目添加成功');
            }
        }

        /*测试优化前后代码*/
        // 静态方法获取栏目列表
        /*没有经过优化的无限极栏目分类*/
        /* $t1 = microtime(true);  // 执行前的时间 测试性能用
        $res1 = CateModel::getcategory(); // 未优化
        $t2 = microtime(true);  //执行后的时间  测试性能用*/
        /*经过优化的无限极栏目分类*/
        // $t3 = microtime(true);  // 执行前的时间
        // $cateall = CateModel::all(); // 获取所有的栏目
        // $res = collection(CateModel::all())->toArray(); // 将对象转换成数组，不用之前的方法了，tp提供了collection($res)->toArray()直接转换 不转换也行，不影响
        // $res = CateModel::getcateall($cateall, 0);  // 已优化
        // $t4 = microtime(true);   // 执行后的时间
        /*dump(($t2-$t1)*1000);
        dump(($t4-$t3)*1000);*/ // 测试优化前后性能用

        // 静态方法获取栏目列表
        $cateall = CateModel::order('sort Desc,id Asc')->select(); // 获取所有的栏目
        $res = CateModel::getcateall($cateall, 0);  // 已优化
        $this->assign('Cate',$res);

        // 引用方法获取栏目列表
       /* $cateall = CateModel::all(); // 获取所有的栏目
        CateModel::getcate($cateall, 0,-1,$res);
        $this->assign('Cate',$res);*/

        return view();
    }

    // 栏目排序
    public function sort(){
        if (request()->isPost()){
            $data = input('post.');
            if (CateModel::sort($data)){
                $this->success('排序成功!');
            }
            $this->error('操作异常!!!'); // 一般不会运行到这里
        }
        return view();
    }

    // 栏目编辑
    public function edit($id){
        if (request()->isPost()){
            $data = input('post.');
            // imgfile是图片文件，图片我们是不存到数据库的，我们只是把图片在服务器的一个地址存入数据库，所以在存入数据库前需要把提交来的图片删除
            if (isset($data['imgfile'])){
                unset($data['imgfile']);
            }
            $cateids = CateModel::getchildids($id);
            $cateids[] = $id; // 因为上面得到的数组中只是包含了当前栏目的子栏目，并不包含本身，而我们需要包含本身的，所以把当前栏目id也插入数组中
            if (in_array($data['pid'],$cateids)){
                $this->error('上级栏目选择错误!!!');
            }
            // 栏目数据更新
            if (CateModel::where('id', $id)->update($data)){
                $this->success('数据更新成功!','category/index');
            }
            $this->error('栏目更新失败!!!');

        }

        // 静态方法获取栏目列表
        $cateall = CateModel::order('sort Desc,id Asc')->select();
        $res = CateModel::getcateall($cateall, 0);  // 已优化
        // 获取当前栏目信息
        $result = CateModel::get($id);
        // $result中的pic由字符串类型的图片地址拆分成数组数组类型的图片地址
        $result->pics=explode(",",$result->pic);
        $this->assign([
            'Cate'  =>  $res,
            'curcate' => $result,
        ]);
        return view();
    }

    // 栏目删除
    public function del($id){
        // 先判断是否有下级栏目
        $res = CateModel::Where('pid',$id)->select();
        if ($res){
            $this->error('有下级栏目不能删除栏目！');
        }

        // 1.获取栏目图片地址
        $pics = CateModel::where('id',$id)->field('pic')->find();
        if(CateModel::destroy($id)){
            // 删除栏目图片
            // 栏目图片地址可能是多张，每张之间用“,”隔开的
            // 将本来是字符串的图片地址拆分成数组类型
            $arr_pic = explode(',',$pics->pic);
            foreach ($arr_pic as $v){
                $this->delimg($v);
            }

            $this->success('删除栏目成功!','category/index');
        }
        $this->error('删除失败!!!');
    }

}