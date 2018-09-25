<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/10
 * Time: 16:45
 */

namespace app\admin\model;


use think\Model;

class Category extends Model
{
    // 使用获取器取栏目类型
    public function getTypeAttr($value){
        $type = [
            1=>"<span class=\"layui-badge layui-bg-blue\">单页</span>",
            2=>"<span class=\"layui-badge layui-bg-cyan\">PICTURES</span>",
            3=>"<span class=\"layui-badge layui-bg-orange\">NEWS</span>",
            4=>"<span class=\"layui-badge layui-bg-green\">CONTACT</span>",
        ];
        return $type[$value];
    }

    /**
     *  未优化  不建议使用
     * @param int $pid
     * @param int $level
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getcategory($pid = 0, $level = -1){  // 顶级栏目前是不需要加“-”的，所以将$level赋值为-1就可以让顶级栏目没有“-”了，因为顶级栏目肯定是所有栏目的上级栏目
        $res = self::where('pid',$pid)->select(); // 查询所有栏目 ,这种方法后期数据量大很消耗服务器资源
        static $arr = array();  // 用静态变量数组来保存遍历时对我们有用的信息
        $level += 1;
        if ($level == 0){
            $str = "";
        }else{
            $str = "|";
        }
        foreach ($res as $v){
            $tmp_arr = array();  // 获取我们想要的数据
            $tmp_arr['id'] = $v['id'];
            $tmp_arr['name'] = $str.str_repeat("---",$level).$v['name']; // 多三条小短线就降一个栏目等级
            $tmp_arr['pid'] = $v['pid'];
            $arr[] = $tmp_arr;  // 将我们想要的数据存入静态数组里面防止下一次循环是想要的数据更新了，而没有保存
            self::getcategory($v['id'], $level);  // 递归查询符合条件的子栏目
        }
        return $arr;
    }

    /**
     * 获取栏目列表 实现无限极分类的核心代码 优化
     * @param $data  包含所有栏目分类的数组
     * @param int $pid  上级栏目标识
     * @param int $level  层级数
     * @return array
     */
    public static function getcateall($data, $pid = 0, $level = -1){  // 顶级栏目前是不需要加“-”的，所以将$level赋值为-1就可以让顶级栏目没有“-”了，因为顶级栏目肯定是所有栏目的上级栏目
        // $res = self::where('pid',$pid)->select(); // 查询所有栏目 ,这种方法后期数据量大很消耗服务器资源
        static $arr = array();  // 用静态变量数组来保存遍历时对我们有用的信息
        $level += 1;
        if ($level == 0){
            $str = "";
        }else{
            $str = "|";
        }
        foreach ($data as $v){
            if ($pid == $v['pid']){
                $tmp_arr = array();  // 获取我们想要的数据
                $tmp_arr['id'] = $v['id'];
                $tmp_arr['name'] = $str.str_repeat("---",$level).$v['name']; // 多三条小短线就降一个栏目等级
                $tmp_arr['pid'] = $v['pid'];
                $tmp_arr['sort'] = $v['sort'];
                $tmp_arr['type'] = $v['type'];
                $tmp_arr['typeid'] = $v->getData('type');  // 返回原始值，不返回获取器指定的值
                $arr[] = $tmp_arr;  // 将我们想要的数据存入静态数组里面防止下一次循环是想要的数据更新了，而没有保存
                self::getcateall($data, $v['id'], $level);  // 递归查询符合条件的子栏目
                unset($v); // 用完后$v无用了，删除它可以进一步优化
            }
        }
        return $arr;
    }

    /**
     * 获取栏目列表 使用引用的方法实现无限极分类的核心代码
     * @param $data  包含所有栏目分类的数组
     * @param int $pid  上级栏目标识
     * @param int $level  层级数
     * @return array
     */
    public static function getcate($data, $pid = 0, $level = -1,&$arr = []){  // 顶级栏目前是不需要加“-”的，所以将$level赋值为-1就可以让顶级栏目没有“-”了，因为顶级栏目肯定是所有栏目的上级栏目
        // static $arr = array();  // 用静态变量数组来保存遍历时对我们有用的信息
        $level += 1;
        if ($level == 0){
            $str = "";
        }else{
            $str = "|";
        }
        foreach ($data as $v){
            if ($pid == $v['pid']){
                $tmp_arr = array();  // 获取我们想要的数据
                $tmp_arr['id'] = $v['id'];
                $tmp_arr['name'] = $str.str_repeat("---",$level).$v['name']; // 多三条小短线就降一个栏目等级
                $tmp_arr['pid'] = $v['pid'];
                $arr[] = $tmp_arr;  // 将我们想要的数据存入静态数组里面防止下一次循环是想要的数据更新了，而没有保存
                self::getcate($data, $v['id'], $level, $arr);  // 递归查询符合条件的子栏目
                unset($v); // 用完后$v无用了，删除它可以进一步优化
            }
        }
        return $arr;
    }

    // 栏目排序
    public static function sort($data){
        foreach($data as $id=>$sort){
            self::where('id',$id)->update(['sort'=>$sort]);
        }
        return true;
    }

    // 获取子栏目id,包含自身id
    public static function getchildids($id){
        $res = self::where('pid',$id)->field('id')->select();
        static $arr = array(); // 用静态变量存储需要的数据
        foreach ($res as $v){
            $arr[]=$v['id'];
            self::getchildids($v['id']);  // 因为当前栏目下面可能有很多子栏目，所以采用递归的形式遍历其子栏目
        }
        return $arr;  // 将数组返回
    }
}