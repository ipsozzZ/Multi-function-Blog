<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"/home/ftp/1/1975386453/ipso/public/../application/index/view/news/show.html";i:1541252774;s:67:"/home/ftp/1/1975386453/ipso/application/index/view/common/menu.html";i:1541252774;s:69:"/home/ftp/1/1975386453/ipso/application/index/view/common/footer.html";i:1544256018;}*/ ?>
<!DOCTYPE html>
<head id="Head">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="<?php echo $config['author']; ?>"/>
    <title>ipso</title>
    <meta name="description" content="<?php echo $config['desc']; ?>"/>
    <meta name="keywords" content="<?php echo $config['keyword']; ?>"/>
    <meta http-equiv="page-enter" content="RevealTrans(Duration=0,Transition=1)"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/qhdcontent.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/content.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/menu.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/jquery.fancybox-1.3.4.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/pgwslideshow.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/style-orange.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/news_content.css">
    <style>

        html {
            background-image: url(/static/index/images/bg-rep-03.png);
        }

    </style>
    <!--[if lt IE 9]>

    <script src="js/html5.js"></script>

    <![endif]--><!--[if IE 6]>

    <script type="text/javascript" src="js/ie7.js"></script>

    <script type="text/javascript" src="js/dd_belatedpng.js"></script>

    <script type="text/javascript">

        DD_belatedPNG.fix('.top img, .footer img, .bottom img, .form-btn, .module-icon-default');

    </script>

    <![endif]-->
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
</head>

<body class="font-zh-CN" style="background:url(/static/index/images/bg-img-03.jpg) top center fixed;">
<div>
</div>
<script src="js/a1portalcore.js" type="text/javascript"></script>
<script src="js/a1portal.js"></script>
<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/superfish.js"></script>
<script src="js/jquery.caroufredsel.js"></script>
<script src="js/jquery.touchswipe.min.js"></script>
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.fancybox-1.3.4.pack.js"></script>
<script src="js/pgwslideshow.min.js"></script>
<script src="js/jquery.fixed.js"></script>
<script src="js/cloud-zoom.1.0.2.min.js"></script>
<script src="js/device.min.js"></script>
<script src="js/html5media-1.2.js"></script>
<script src="js/animate.min.js"></script>
<script src="js/custom.js"></script>
<div id="wrapper" class="insi-page">
    <header class="top header-v1 desktops-section default-top">
        <div class="top-main">
    <div class="page-width clearfix">
        <div class="logo" skinobjectzone="HtmlLogo_399"><a href="#"><img height="80px;"  src=" /static/index/images/logo.jpg"
                                                                         alt="ipso"/></a></div>

        <div class="top-main-content clearfix">
            <nav class="nav">
                <div class="main-nav clearfix" skinobjectzone="menu_468">
                    <ul class="sf-menu">
                        <li <?php if($currtype == '0'): ?>class="current"<?php endif; ?>><a class="first-level" href="<?php echo url('index/Index/index'); ?>" target><strong>HOME</strong></a><i></i></li>
                        <?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li <?php if($currtype == $vo['type']): ?>class="current"<?php endif; ?>><a class="first-level" href="<?php echo makeurl($vo['type'],$vo['id']); ?>" target><strong><?php echo $vo['name']; ?></strong></a><i></i>
                            <ul class>
                                <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li class><a class href="<?php echo makeurl($v['type'],$v['id']); ?>" target><strong><?php echo $v['name']; ?></strong></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

        <div class="clear"></div>
    </header>
    <!--</header>-->
    <!--banner 开始-->
    <div id="a1portalSkin_headerAreaA" class="header"><a name="31858" id="31858"></a>
        <div class="module-default">
            <div class="module-inner">
                <div id="a1portalSkin_ctr107135107135_mainArea" class="module-content">
                    <div class="slideshow slideshow-min carousel clearfix" style="height:450px; overflow:hidden;">
                        <div id="carousel-107135">
                            <div class="carousel-item">
                                <div class="carousel-img"><a href="javascript:;" target><img
                                        src="/<?php echo getbannerpic($currid); ?>"
                                        height="450"
                                        alt="news"/></a></div>
                            </div>
                        </div>
                        <div class="carousel-btn carousel-btn-fixed" id="carousel-page-107135"></div>
                    </div>
                    <script type="text/javascript">
                        $(window).bind("load resize", function () {
                            $("#carousel-107135").carouFredSel({
                                width: '100%',
                                items: {visible: 1},
                                auto: {pauseOnHover: true, timeoutDuration: 5000},
                                swipe: {onTouch: true, onMouse: true},
                                pagination: "#carousel-page-107135",
                                scroll: {fx: "crossfade"}
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--banner 结束-->
    <!--主体内容-->
    <section class="main">
        <div class="page-width clearfix">
            <section class="content float-right">
                <section class="page-title page-title-inner clearfix">
                    <div class="breadcrumbs float-right" skinobjectzone="HtmlBreadCrumb_3806"><span>当前位置：</span>
                        <a href="javascript:">HOME</a>
                        <?php echo getlocation($currid); ?>
                    </div>
                    <div class="page-name float-left">
                        <h2><?php echo $top_child['name']; ?></h2>
                    </div>
                </section>
                <div id="a1portalSkin_mainArea" class="content-wrapper"><a name="31832" id="31832"></a>
                    <div class="module-default">
                        <div class="module-inner">
                            <div id="a1portalSkin_ctr107133107133_mainArea" class="module-content">
                                <div class="news_content">
                                    <!--内容区-->
                                    <div class="item">
                                        <div class="item-box  layer-photos-demo1 layer-photos-demo">
                                            <h3><a href=""><?php echo $article['title']; ?></a></h3>
                                            <p id="aid" hidden><?php echo $article['id']; ?></p>
                                            <h5>发布于：<span><?php echo date("Y/m/d",$article['addtime']); ?></span></h5>
                                            <p><?php echo $article['content']; ?></p>
                                            <img style="width: 300px" src="/$article/pic" alt="">
                                            <div class="count layui-clear">
                                                <span style="margin-right: 10px" class="pull-left">阅读 <em><?php echo $article['views']; ?>次</em></span>|
                                                <span style="margin-right: 10px" class="pull-left">赞<img style="margin-left: 5px" id="subAPraise" src="<?php echo !empty($fabul_A)?"/static/index/images/good.png":"/static/index/images/noone.png"; ?>"> <em><?php echo $article['fabul']; ?>次</em></span>|
                                                <span class="pull-left">评论 <em><?php echo $article['comment']; ?>条</em></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--内容区结束-->
                                    <a name="comment"> </a>
                                    <!--发表评论区-->
                                    <div class="comt layui-clear" style="margin-top: 20px">
                                        <h5 class="pull-left">评论:</h5>
                                        <div class="comment layui-form-item layui-form-text">
                                            <textarea id="yourcomment"  name="comment"  style="width: 100%;height: 100px" placeholder="写点什么啊"></textarea>
                                            <button id="subComment">发表</button>
                                        </div>
                                    </div>
                                    <!--发表评论区结束-->
                                    <!--评论展示区-->
                                    <div id="LAY-msg-box" style="padding-bottom: 20px;padding-top: 20px">
                                        <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                            <div style="" class="info-item">
                                                <div class="info-text">
                                                    <p class="title count">
                                                        <span class="name"><img class="info-img" style="width: 18px" src="/static/index/images/user.png" alt=""> <?php echo $vo['uname']; ?></span>
                                                        <span style="float: right"><?php echo date("Y/m/d H:i:s",$vo['addtime']); ?></span>
                                                    </p>
                                                    <p style="margin-left: 20px" class="info-intr"><?php echo $vo['content']; ?></p>
                                                    <p hidden class="Cid" ><?php echo $vo['id']; ?></p>
                                                    <div class="dianzan" style="margin: 10px">
                                                        <button style="margin-right: 15px" type="button">
                                                            <img <?php if(in_array(($vo['id']), is_array($arr_Cid)?$arr_Cid:explode(',',$arr_Cid))): ?> hidden<?php endif; ?> class="subCPraise" src="/static/index/images/noone.png">
                                                            <img <?php if(!in_array(($vo['id']), is_array($arr_Cid)?$arr_Cid:explode(',',$arr_Cid))): ?> hidden<?php endif; ?> class="subCPraise" src="/static/index/images/good.png">
                                                        </button>被赞<?php echo $vo['views']; ?>次
                                                    </div>
                                                    <hr />
                                                </div>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <div class="m-page">
                                            <ul class="pagelist">
                                                <?php echo $comment->render(); ?>
                                            </ul>
                                        </div>
                                        <p>文章作者：<?php echo $article['author']; ?></p>
                                    </div>
                                    <!--评论展示区结束-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!---->
            <section class="sidebar float-left">
                <div id="a1portalSkin_sidebarAreaA" class="sidebar-content"><a name="31827" id="31827"></a>
                    <a name="31863" id="31863"></a>
                    <div class="module module-hlbg">
                        <div class="module-inner">
                            <div class="module-hlbg-title clearfix">
                                <h3 class style><?php echo $top_child['name']; ?></h3>
                            </div>

                            <div id="a1portalSkin_ctr107134107134_mainArea" class="module-hlbg-content">
                                <div class="category category-107134 article-category">
                                    <ul>
                                        <?php if(is_array($news_child) || $news_child instanceof \think\Collection || $news_child instanceof \think\Paginator): $i = 0; $__LIST__ = $news_child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li <?php if($vo['id'] == $currid): ?>class="current" <?php endif; ?>><a href="<?php echo makeurl($vo['type'],$vo['id']); ?>"><?php echo $vo['name']; ?></a><i></i></li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.category-107134 ul ul').find('li:last').addClass('last');

                                        $('.category-107134 > ul > li > a').click(function () {
                                            if ($(this).parent('li').find('ul')) {
                                                $(this).parent('li').find('ul').slideDown('fast');
                                                $(this).parent('li').siblings('li').find('ul').slideUp('fast');
                                                $(this).parent('li').addClass('current').siblings('li').removeClass('current');
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!---->
        </div>
    </section>
    <!--主体内容结束-->
    <footer class="footer">
    <div class="footer-main">
        <div id="a1portalSkin_footerAreaA" class="page-width clearfix"><a name="31848" id="31848"></a>
            <div class="module-default">
                <div class="module-inner">
                    <div id="a1portalSkin_ctr107119107119_mainArea" class="module-content">
                        <div class="qhd-module">
                            <div class="column marg-per2">
                                <div class="col-5-1">
                                    <div id="a1portalSkin_ctr107119107119_Column5C20A20A20A20A20_QHDCPM107119M1"
                                         class="qhd_column_contain"><a name="31849" id="31849"></a>
                                        <div class="module-default">
                                            <div class="module-inner">
                                                <div id="a1portalSkin_ctr107119107119_Column5C20A20A20A20A20_ctr107120107120_mainArea"
                                                     class="module-content">
                                                    <div class="qhd-content">
                                                        <p style="text-align: center;"><img alt src="/static/index/images/weixin.jpg" style="width: 120px; height: 120px;"/><br/>
                                                            扫描关注微信</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5-1 last">
                                    <div id="a1portalSkin_ctr107119107119_Column5C20A20A20A20A20_QHDCPM107119M5"
                                         class="qhd_column_contain"><a name="31853" id="31853"></a>
                                        <div class="module-default">
                                            <div class="module-inner">
                                                <div class="module-title module-title-default clearfix">
                                                    <div class="module-title-content clearfix">
                                                        <h3 style="font-size: 18px" class>走近博主</h3>
                                                    </div>
                                                </div>
                                                <div id="a1portalSkin_ctr107119107119_Column5C20A20A20A20A20_ctr107124107124_mainArea"
                                                     class="module-content">
                                                    <div style="width: 980px" class="qhd-content">
                                                        <p>
                                                            <a target="_blank" href="<?php echo $config['zhihu']; ?>"><img style="width: 70px;margin-right: 50px" src="/static/index/images/zhihu.png"></a>
                                                            <a target="_blank" href="<?php echo $config['weibo']; ?>"><img style="width: 70px;margin-right: 50px" src="/static/index/images/weibo.png"></a>
                                                            <a target="_blank" href="<?php echo $config['github']; ?>"><img style="width: 70px;margin-right: 50px" src="/static/index/images/github.png"></a>
                                                            <a target="_blank" href="<?php echo $config['blibli']; ?>"><img style="width: 70px" src="/static/index/images/blibli.png"></a>
                                                            </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<section class="bottom">
    <div id="a1portalSkin_bottomAreaA" class="page-width clearfix"><a name="31854" id="31854"></a>
        <div class="module-default">
            <div class="module-inner">
                <div id="a1portalSkin_ctr107125107125_mainArea" class="module-content">
                    <div class="qhd-module">
                        <div class="column">
                            <div class="col-5-3">
                                <div id="a1portalSkin_ctr107125107125_Column2C60A40_QHDCPM107125M1"
                                     class="qhd_column_contain"><a name="31855" id="31855"></a>
                                    <div class="module-default module-no-margin">
                                        <div class="module-inner">
                                            <div id="a1portalSkin_ctr107125107125_Column2C60A40_ctr107126107126_mainArea"
                                                 class="module-content">
                                                <div style="text-align: center" class="qhd-content">
                                                    <p>博主：<a href="http://www.ipso.live"> <?php echo $config['author']; ?></a></p>
                                                     <p>友情链接：<p><a href="http://www.iimt.me">iimT</a></p>
                                                            <p><a href="http://722first.club">goodtimp</a></p></p>
                                                     <p>浙ICP备18046964号</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5-2 last">
                                <div id="a1portalSkin_ctr107125107125_Column2C60A40_QHDCPM107125M2"
                                     class="qhd_column_contain"><a name="31856" id="31856"></a>
                                    <div class="module-default module-no-margin">
                                        <div class="module-inner">
                                            <div id="a1portalSkin_ctr107125107125_Column2C60A40_ctr107127107127_mainArea"
                                                 class="module-content">
                                                <div class="qhd-content">
                                                    <p style="text-align: right;"><a style="display:none" href="http://www.daxue518.com" title="ipso">ipso</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <script src="/static/index/js/jquery.js"></script>
    <script>
        $(function () {
            // 更改点赞图标的显示状态
            var subCPraise = $("#LAY-msg-box .subCPraise").attr("src");

            // Ajax异步提交评论
            $("#subComment").on('click',function () {
                var comment = $("#yourcomment").val();
                var aid = $("#aid").text();
                // alert(aid);
                // alert(comment);
                $.ajax({
                    type:"post",
                    url: "<?php echo url('news/comment'); ?>",
                    data:{'comment':comment,'aid':aid},
                    success:function (data) {
                        if (data == "ok")
                        {
                            alert("哈哈!评论发表成功!");
                            window.location.reload();
                            $("#yourcomment").val("");
                        }else{
                            alert(data);
                        }
                    }
                })
            })
            // Ajax异步提交评论点赞数量
            $("#LAY-msg-box .subCPraise").on('click',function () {
                var mark = "comment";
                var Cid = $(this).parents(".dianzan").siblings(".Cid").text();
                var Nsrc = $(this).attr("src");
                $.ajax({
                    type:"post",
                    url: "<?php echo url('news/fabulous'); ?>",
                    data:{'id':Cid,'mark':mark},
                    success:function (data) {
                        if (data == "ok") {
                            location.reload();
                        }else {
                            alert(data);
                        }
                    }
                })
            })

            $("#subAPraise").on('click',function () {
                var mark = "article";
                var Aid = $("#aid").text();
                $.ajax({
                    type:"post",
                    url: "<?php echo url('news/fabulous'); ?>",
                    data:{'id':Aid,'mark':mark},
                    success:function (data) {
                        if (data == "ok") {
                            location.reload();
                        }else {
                            alert(data);
                        }
                    }
                })
                $(this).attr("src","/static/index/images/good.png");
            })
        })
    </script>
</div>
<div class="gotop-wrapper"><a href="javascript:;" class="fixed-gotop gotop"></a></div>
</body>
</html>