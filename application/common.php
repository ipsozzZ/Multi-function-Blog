<?php

/*********************文件管理自定义函数*********************/
/*
 * 文件大小判断函数
 * $num 要保留的小数位数
 * */
function size_format($size=0,$num=0){
    $unit=['B','KB','MB'.'GB','TB'];
    $i=0; // 默认是'B'
    while ($size>1024){
        $size/=1024;  // 相当于 $size=$size/1024
        $i++;
    }
    return round($size,$num).$unit[$i];
}
/*
 * basename支持中文自定义函数
 * */
function basenamecn($file){
    //$file=urldecode($file);
    //$file=iconv('UTF-8','GB2312',$file);
    $file=mb_convert_encoding($file,'GB2312','UTF-8');
    //$file=mb_convert_encoding($file,'UTF-8','GB2312');
    //dump(file_exists($file));die;
    if (file_exists($file)){
        $arr=explode(DS,$file);
        //return iconv('GB2312','UTF-8',end($arr));
        //return mb_convert_encoding(end($arr),'UTF-8','GB2312');
        return mb_convert_encoding(end($arr),'UTF-8','GB2312');
    }
}
/*
 * 图片预览通用函数
 * getimagesize
 * base64_encode
 * shunk_split:将字符串分割成小块
 *
 * */
function getpics($file,$height=30){
    //解码
    $file=mb_convert_encoding(urldecode($file),'GB2312','UTF-8');
    //$file=iconv('UTF-8','GB2312',urldecode($file));
    //如果不是图片的话输出为空
    if ($file_info=@getimagesize($file)){

        $filecontent=file_get_contents($file);
        $base64_file=chunk_split(base64_encode($filecontent));
        $pic="data:".$file_info['mime'].";base64,".$base64_file;
        return "<img src='".$pic."' height=".$height.">";

    }
    return "";
}

// 应用公共文件
// 生成导航地址
function makeurl($type=1,$id){
    $url='';
    switch ($type){
        case 1:
            $url=url('index/Page/index',['id'=>$id]);
            break;
        case 2:
            $url=url('index/Pictures/index',['id'=>$id]);
            break;
        case 3:
            $url=url('index/News/index',['id'=>$id]);
            break;
        case 4:
            $url=url('index/Contact/index',['id'=>$id]);
            break;
        default:
            $url=url('index/Index/index');
            break;
    }
    $result=db('Category')->where('pid',$id)->find();
    if ($result){
        $url="javascript::";
    }
    return $url;
}

/**
 * @param $id  当前栏目id
 * @return string  获取当前位置
 */
function getlocation($id){
    $cate = db('category')->where('id',$id)->field('id,name,pid')->find();
    $str = '';
    if ($cate){
        $str = ' > <a href="javascript:">'.$cate['name'].'</a>';
        if ($cate['pid'] != 0){
            $pre_cate = getlocation($cate['pid']);
            $str = $pre_cate.$str;
        }
        return $str;
    }
}

/**
 *  获取栏目图片
 *
 */
function getbannerpic($currid){
    $res = db('category')->where('id',$currid)->field('pic,pid')->find();
    // 当前栏目不存在，返回空
    if (!$res){
        return "";
    }
    // 当前栏目存在，栏目图片不存时，取用上级栏目的图片
    if ($res['pic'] == ""){
        $res['pic'] = getbannerpic($res['pid']);
    }
    return $res['pic'];
}

// 当服务器的php版本小于5.5时 要加入一下代码才可以在虚拟主机上使用array_column()函数，这个函数的作用是返回数组中指定的一列
if (!function_exists('array_column')) {
    /**
     * Returns the values from a single column of the input array, identified by
     * the $columnKey.
     *
     * Optionally, you may provide an $indexKey to index the values in the returned
     * array by the values from the $indexKey column in the input array.
     *
     * @param array $input A multi-dimensional array (record set) from which to pull
     *                     a column of values.
     * @param mixed $columnKey The column of values to return. This value may be the
     *                         integer key of the column you wish to retrieve, or it
     *                         may be the string key name for an associative array.
     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
     *                        the returned array. This value may be the integer key
     *                        of the column, or it may be the string key name.
     * @return array
     */
    function array_column($input = null, $columnKey = null, $indexKey = null)
    {
        // Using func_get_args() in order to check for proper number of
        // parameters and trigger errors exactly as the built-in array_column()
        // does in PHP 5.5.
        $argc = func_num_args();
        $params = func_get_args();
        if ($argc < 2) {
            trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }
        if (!is_array($params[0])) {
            trigger_error(
                'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
                E_USER_WARNING
            );
            return null;
        }
        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && $params[1] !== null
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_column(): The column key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        if (isset($params[2])
            && !is_int($params[2])
            && !is_float($params[2])
            && !is_string($params[2])
            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
        ) {
            trigger_error('array_column(): The index key should be either a string or an integer', E_USER_WARNING);
            return false;
        }
        $paramsInput = $params[0];
        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
        $paramsIndexKey = null;
        if (isset($params[2])) {
            if (is_float($params[2]) || is_int($params[2])) {
                $paramsIndexKey = (int) $params[2];
            } else {
                $paramsIndexKey = (string) $params[2];
            }
        }
        $resultArray = array();
        foreach ($paramsInput as $row) {
            $key = $value = null;
            $keySet = $valueSet = false;
            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
                $keySet = true;
                $key = (string) $row[$paramsIndexKey];
            }
            if ($paramsColumnKey === null) {
                $valueSet = true;
                $value = $row;
            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
                $valueSet = true;
                $value = $row[$paramsColumnKey];
            }
            if ($valueSet) {
                if ($keySet) {
                    $resultArray[$key] = $value;
                } else {
                    $resultArray[] = $value;
                }
            }
        }
        return $resultArray;
    }
}