<?php
/**
 * 自定义验证
 * Created by PhpStorm.
 * User:  pso318
 * Date: 2018/5/19
 * Time: 16:14
 */

namespace app\admin\validate;


use think\Validate;

class Article extends Validate
{
    // 验证规则
    protected $rule =   [
        'title'  => 'require',
        'views'     =>  'require|number|checkviews:0',
        '__token__'  =>  'require|token',   // 表单令牌
    ];
    // 验证提示信息
    protected $message  =   [
        'title.require' => '标题不能为空必须',
        'views.require' => '浏览次数不能为空',
        'views.number' => '浏览次数必须是数字',
        'views.checkviews' => '浏览次数必须大于等于0',
        '__token__.require' => '非法提交',
        '__token__.token' => '请不要重复提交表单',
    ];

    /**
     * 自定义验证规则
     * @param $value 要验证字段的值
     * @param $rule  验证规则传来的值
     * @return bool  true: 表示验证通过 ， false/字符串：表示验证未通过
     */
    protected function checkviews($value,$rule){
        if ($value >= $rule){
            return true;
        }
        return false;
    }
}