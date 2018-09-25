<?php
namespace app\admin\controller;

use think\Controller;

class File extends Common
{
    public function index($currdir=null)
    {
        $currdir = mb_convert_encoding($currdir,'GB2312','UTF-8'); // 这里要将UTF-8格式的$currdir重新转换为GB2312格式的路径，否则无法打开目录
        if ($currdir){
            if (file_exists($currdir)){   // file_exists() 判断是否存在
                // 在网站根目录下的文件才允许访问，其它的没有权限访问
                if (stripos($currdir,ROOT_PATH)===0 && stripos($currdir,ROOT_PATH.'..')===false){  // stripos(str1,str2)判断str1是否包含在str2中，并且是首次出现
                    chdir($currdir);  // chdir() 切换当前目录
                }
            }
        }
        // $rootdir = ROOT_PATH."public";
        $rootdir = getcwd(); // getcwd()获取站点根目录 getcwd()=ROOT_PATH."public"
        $dir = opendir($rootdir); // 打开这个目录
        $data = [];
        $num = [];
        $num["dirs"] = 0;
        $num["file"] = 0;
        while ($filename = readdir($dir)){
            if ($filename != "." && $filename != ".."){
                if (is_dir($filename)){
                    $arr["icon"] = "#icon-wenjianjia1";
                    $arr["flag"] = 1;
                    $num["dirs"]++;
                }
                else{
                    $arr["icon"] = $this->seticon($filename);
                    $arr["flag"] = 0;
                    $num["file"]++;
                }
                $arr["currdir"] = mb_convert_encoding(getcwd().DIRECTORY_SEPARATOR.$filename,'UTF-8','GB2312');// 当前路径的绝对路径,文件名有可能是中文的，为了防止得到乱码的路径要用iconv()进行编码转换
                $arr["name"] = $filename;
                $arr["size"] = filesize($filename);
                $arr["ctime"] = filectime($filename);
                $arr["mtime"] = filemtime($filename);
                $data[] = $arr;
            }
        }
        // array_multisort() 对多维数组进行排序
        // array_column() 取出多维数组中的某一列
        array_multisort(array_column($data,'flag'),SORT_DESC,$data);
        $currpage = $this->page_array($data,8,input('page'));
        $this->assign([
           'curdir' =>  $rootdir,
            'dirs' => $currpage['data'],
            'page' => $currpage['page'],
            'num' => $num,
        ]);
        return view('file_index');
    }

    // 文件前面的小图标
    private function seticon($filename){
        $exc = substr($filename,strripos($filename,'.')); // strripos()子串在字符串中最后一次出现的位置
        $exc = strtoupper($exc); // ，因为得到的后缀可能有大写又有小写，所以要将得到的后缀名统一转换成小写
        // $icon = "";
        switch ($exc){
            case ".HTML":
                $icon="#icon-html1";
                break;
            case ".HTM":
                $icon="#icon-HTML";
                break;
            case ".PHP":
                $icon="#icon-PHP";
                break;
            case ".JS":
                $icon="#icon-html";
                break;
            case ".CSS":
                $icon="#icon-css";
                break;
            case ".JSON":
                $icon="#icon-json-";
                break;
            case ".XML":
                $icon="#icon-xml";
                break;
            case ".SQL":
                $icon="#icon-SQL";
                break;
            case ".BMP":
                $icon="#icon-BMPs";
                break;
            case ".PNG":
                $icon="#icon-PNG";
                break;
            case ".JPEG":
                $icon="#icon-jpeg";
                break;
            case ".GIF":
                $icon="#icon-GIF";
                break;
            case ".JPG":
                $icon="#icon-Jpg";
                break;
            default:
                $icon="#icon-file"; //默认文件图标
                break;
        }
        return $icon;
    }

    //文件夹数组分页方法
    private function page_array($arr,$page = 10,$curr){

        $total = ceil(count($arr) / $page); // 总页数
        if ($curr <= 0) $curr = 1;
        if ($curr > $total) $curr = $total;
        $data = array_slice($arr,($curr - 1) * $page,$page);
        return [
            'data' => $data,
            'page' => [
                'count'=> count($arr),
                'limit' => $page,
                'curr' => $curr
            ]
        ];
    }

    //文件删除处理方法
    public function del(){
        if (request()->isAjax()){
            $file = mb_convert_encoding(urldecode(input('file')),'GB2312','UTF-8');
            if (is_dir($file)){
                $arr = scandir($file); // scandir用来判断文件是否为空，如果为空的话数组中只有两个值即当前目录和上级目录，如果有两个值以上就说明文件不空
                if (count($arr) === 2){
                    rmdir($file);  // rmdir 用来删除空的文件夹，只能删除空文件夹
                    return json(['msg'=>'目录删除成功']);
                }else{
                    return json(['msg'=>'目录不为空删除失败']);
                }
            }
            if (is_file($file)){
                @unlink($file);
                return json(['msg'=>'文件删除成功']);
            }
            return json(['msg'=>'操作异常']);
        }
    }

    //文件删除处理方法
    public function delfile(){
        if (request()->isAjax()){
            //$file=iconv('UTF-8','GB2312',urldecode(input('file')));
            $file=mb_convert_encoding(urldecode(input('file')),'GB2312','UTF-8');
            //判断是目录(文件夹)的情况下
            if (is_dir($file)){
                $arr=scandir($file);
                if (count($arr)===2){
                    @rmdir($file);
                    return json(['msg'=>'目录(文件夹)删除成功',]);
                }else{
                    return json(['msg'=>'目录(文件夹)不为空,删除失败',]);
                }
            }
            //判断是文件的情况下
            if (is_file($file)){
                @unlink($file);
                return json(['msg'=>'文件删除成功',]);
            }
            return json(['msg'=>'异常操作',]);
            //dump($file);die;

        }
    }

    //重命名文件以及文件夹
    public function renames(){
        if(request()->isAjax()){
            //$file=mb_convert_encoding($currdir,'GB2312','UTF-8',urldecode(input('file')));mb_convert_encoding
            $file = mb_convert_encoding(urldecode(input('file')),'GB2312','UTF-8');
            $filename=input('filename');
            //$newfile=iconv('UTF-8','GB2312',dirname($file).DS.$filename);
            $newfile = mb_convert_encoding(dirname($file).DS.$filename,'GB2312','UTF-8');
            if(file_exists($newfile)){
                return json(['code'=>0,'msg'=>'文件已经存在']);
            }
            @rename($file,$newfile);
            return json(['code'=>1,'msg'=>'重命名成功']);

        }
    }

    //文件编辑并加载界面
    public function file_edit(){
        //$file=iconv('UTF-8','GB2312',urldecode(input('file')));
        $file = mb_convert_encoding(urldecode(input('file')),'GB2312','UTF-8');
        if (empty($file) || !file_exists($file)){
            $this->error("操作异常");
        }
        //判断文件是否可以编辑
        $arr=['.PHP', '.HTML', '.HTM', '.CSS', '.JS','.TXT', '.SQL', '.XML', '.HTACCESS','.LOG','.JSON'];//设置支持类型
        $exc=strtoupper(substr($file,strrpos($file,".")));
        if (!in_array($exc,$arr)){
            $this->error("该文件类型不支持编辑");
        }
        //接收前台发送的信息
        if (request()->isPost()){
            $content=input('code');
            //打开编辑的文件
            $fp=fopen($file,'w');
            //写入新内容
            fwrite($fp,$content);
            //关闭文件
            fclose($fp);

            $this->success("保存成功",'File/index');

        }
        $rootdir=getcwd(); //获取站点根目录,推荐使用(上级目录)
        //dump($rootdir);die;
        $dir=opendir($rootdir);//打开目录,返回资源句柄
        //获取文件内容
        $code=htmlentities(file_get_contents($file),ENT_COMPAT,"UTF-8");
        $this->assign([
           'code'=> $code,//获取当前编辑的内容
           'curr_file'=> $file,//获取当前文件路径
           'ext'=> $exc,//获取当前文件的扩展名
           'rootdir'=>$rootdir,//当前路径
        ]);

        return view();
    }

    //文件下载
    public function download($currdir=null){
        $file=urldecode($currdir);
        $file = mb_convert_encoding($file,'GB2312','UTF-8');
        if (!file_exists($file)){
            $this->error("文件不存在");
        }
        // basenamecn()这个函数可以实现在下载文件的时候如果不自定义文件名的话就默认与原文件名一致，mb_convert_encoding()与iconv()一样
        $filename=basenamecn(mb_convert_encoding($file,'UTF-8','GB2312'));
        header('Content-Disposition:attachment;filename='.$filename);  // 指定浏览器以附件的形式进行传输,filename='.$filename加上这个属性之后就可以自定义下载的文件名了
        readfile($file);  // readfile()读取下载文件
    }

}
