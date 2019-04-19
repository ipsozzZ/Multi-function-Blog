<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:98:"E:\xampp\xampp\htdocs\TP5\Multi-function-Blog\public/../application/index\view\pictures\index.html";i:1541252774;s:85:"E:\xampp\xampp\htdocs\TP5\Multi-function-Blog\application\index\view\common\menu.html";i:1541252774;s:87:"E:\xampp\xampp\htdocs\TP5\Multi-function-Blog\application\index\view\common\footer.html";i:1544256018;}*/ ?>
<!DOCTYPE html>
<head id="Head">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="order by bbs.daxue518.com"/>
    <title>ipso</title>
    <meta name="description" content/>
    <meta name="keywords" content/>
    <meta http-equiv="page-enter" content="RevealTrans(Duration=0,Transition=1)"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/qhdcontent.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/content.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/menu.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/jquery.fancybox-1.3.4.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/pgwslideshow.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/static/index/css/style-orange.css"/>
    <style>

        html {

            background-image: url(/static/index/images/bg-rep-03.png);

        }

    </style>
    <!--[if lt IE 9]>

    <script src="/static/index/js/html5.js"></script>

    <![endif]--><!--[if IE 6]>

    <script type="text/javascript" src="/static/index/js/ie7.js"></script>

    <script type="text/javascript" src="/static/index/js/dd_belatedpng.js"></script>

    <script type="text/javascript">

        DD_belatedPNG.fix('.top img, .footer img, .bottom img, .form-btn, .module-icon-default');

    </script>

    <![endif]-->
    <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport">
</head>

<body class="font-zh-CN" style="background:url(/static/index/images/bg-img-03.jpg) top center fixed;">
<div></div>
<script src="/static/index/js/a1portalcore.js" type="text/javascript"></script>
<script src="/static/index/js/a1portal.js"></script>
<script src="/static/index/js/jquery-1.7.2.min.js"></script>
<script src="/static/index/js/superfish.js"></script>
<script src="/static/index/js/jquery.caroufredsel.js"></script>
<script src="/static/index/js/jquery.touchswipe.min.js"></script>
<script src="/static/index/js/jquery.tools.min.js"></script>
<script src="/static/index/js/jquery.fancybox-1.3.4.pack.js"></script>
<script src="/static/index/js/pgwslideshow.min.js"></script>
<script src="/static/index/js/jquery.fixed.js"></script>
<script src="/static/index/js/cloud-zoom.1.0.2.min.js"></script>
<script src="/static/index/js/device.min.js"></script>
<script src="/static/index/js/html5media-1.2.js"></script>
<script src="/static/index/js/animate.min.js"></script>
<script src="/static/index/js/custom.js"></script>
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

    <!--banner-->
    <div id="a1portalSkin_headerAreaA" class="header"><a name="31858" id="31858"></a>
        <div class="module-default">
            <div class="module-inner">
                <div id="a1portalSkin_ctr107135107135_mainArea" class="module-content">
                    <div class="slideshow slideshow-min carousel clearfix" style="height:450px; overflow:hidden;">
                        <div id="carousel-107135">
                            <div class="carousel-item">
                                <div class="carousel-img"><a href="javascript:;" target><img
                                        src="/<?php echo getbannerpic($currid); ?>" height="450" alt="banner"/></a></div>
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
    <!--banner结束-->
    <!--主体内容-->
    <section class="main">
        <div class="page-width clearfix">
            <section style="width: 910px" class="content float-right">
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
                                <div class="portfolio-list">
                                    <ul class="column marg-per2 clearfix">
                                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 4 );++$i;?>
                                        <li class="col-4-1 <?php if($mod == '3'): ?>last<?php endif; ?>" data-animate="fadeInUp">
                                            <div class="portfolio-img"><a href="<?php echo url('index/pictures/show',['id'=>$vo['id']]); ?>" target="_blank"><img
                                                    style="width: 250px; height: 150px;" src="/<?php echo $vo['pic']; ?>" alt/></a></div>
                                            <div class="portfolio-title">
                                                <h2><a href="<?php echo url('index/pictures/show',['id'=>$vo['id']]); ?>" target="_blank"><?php echo $vo['title']; ?></a></h2>
                                            </div>
                                        </li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                                <div class="m-page">
                                    <ul class="pagelist">
                                        <?php echo $list->render(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="sidebar float-left">
                <div id="a1portalSkin_sidebarAreaA" class="sidebar-content"><a name="31833" id="31833"></a>
                    <div class="module module-hlbg">
                        <div class="module-inner">
                            <div class="module-hlbg-title clearfix">
                                <h3 class style><?php echo $top_child['name']; ?></h3>
                            </div>
                            <div id="a1portalSkin_ctr107134107134_mainArea" class="module-hlbg-content">
                                <div class="category category-107134 article-category">
                                    <ul>
                                        <?php if(is_array($pictures_child) || $pictures_child instanceof \think\Collection || $pictures_child instanceof \think\Paginator): $i = 0; $__LIST__ = $pictures_child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li <?php if($vo['id'] == $currid): ?>class="current"<?php endif; ?>><a href="<?php echo makeurl($vo['type'],$vo['id']); ?>"><?php echo $vo['name']; ?></a><i></i></li>
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
</div>
<div class="gotop-wrapper"><a href="javascript:;" class="fixed-gotop gotop"></a></div>
</body>
</html>
