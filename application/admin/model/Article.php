<?php
/**
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/17
 * Time: 19:08
 */

namespace app\admin\model;


use think\Model;

class Article extends Model
{
    // 模型事件
    protected static function init()
    {
        // 添加之后
        /**
         * 在model中实现内容图片信息的写入数据表
         */
        Self::afterInsert(function ($data) {
            if ($data['pic'] != ''){  // 如果内容中有图片的上传才将图片信息写入数据表
                $arr_tmp = explode(',',$data['pic']); // 将string类型的图片地址拆分为数组类型
                $aid = model('Article')->id; // 对应图片所在内容的id
                $thum = [];
                foreach ($arr_tmp as $v){
                    $thum[] = ['aid'=>$aid, 'pic'=>$v];
                }
                db('pics')->insertAll($thum); // tp中不采用模型的方式往数据库批量写人数据，pics用来存储图片信息的数据表
            }
        });

        // 更新之后
        Self::afterUpdate(function ($data) {
            if ($data['pic'] != ''){  // 如果内容中有图片的上传才将图片信息写入数据表
                $arr_tmp = explode(',',$data['pic']); // 将string类型的图片地址拆分为数组类型
                $aid = input('id'); // 对应图片所在内容的id
                $thum = [];
                foreach ($arr_tmp as $v){
                    $thum[] = ['aid'=>$aid, 'pic'=>$v];
                }
                db('pics')->insertAll($thum); // tp中不采用模型的方式往数据库批量写人数据，pics用来存储图片信息的数据表
            }
        });

        // 删除之后
        self::afterDelete(function ($data) {
            $aid = $data['id'];
            $res = db('pics')->where('aid',$aid)->select();
            if ($res){ // 如果有对应图片，就删除对应图片
                foreach ($res as $v){
                    $file = ROOT_PATH."\\public\\".$v['pic'];
                    if (file_exists($file)){
                        @unlink($file); // '@'抑制错误信息的输出，如果出错了，不会输出错误信息
                    }
                }
                db('pics')->where('aid',$aid)->delete();
            }
        });
    }
}