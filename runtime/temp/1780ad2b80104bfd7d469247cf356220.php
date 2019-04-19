<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/home/ftp/1/1975386453/ipso/public/../application/index/view/page/index.html";i:1541252774;s:67:"/home/ftp/1/1975386453/ipso/application/index/view/common/menu.html";i:1541252774;s:69:"/home/ftp/1/1975386453/ipso/application/index/view/common/footer.html";i:1544256018;}*/ ?>
<!DOCTYPE html>
<head id="Head">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="order by bbs.daxue518.com"/>
    <title><?php echo $page['name']; ?>-<?php echo $config['title']; ?></title>
    <meta name="description" content="<?php echo !empty($page['desc'])?$page['desc']:$config['desc']; ?>"/>
    <meta name="keywords" content="<?php echo !empty($page['keyword'])?$page['keyword']:$config['keyword']; ?>"/>
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
<div>
</div>
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

    <!--touch-->
    <div class="touch-top mobile-section clearfix">
        <div class="touch-top-wrapper clearfix">
            <div class="touch-logo" skinobjectzone="HtmlLogo_2654"><a class href="#"><img
                    src="/static/index/images/logo.png" alt="ipso"/></a></div>

            <div class="touch-navigation">
                <div class="touch-toggle">
                    <ul>
                        <li class="touch-toggle-item-first"><a href="javascript:;" class="drawer-language"
                                                               data-drawer="drawer-section-language"><i
                                class="touch-icon-language"></i><span>语言</span></a></li>
                        <li class="touch-toggle-item-last"><a href="javascript:;" class="drawer-menu"
                                                              data-drawer="drawer-section-menu"><i
                                class="touch-icon-menu"></i><span>导航</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="touch-toggle-content touch-top-home">
            <script type="text/javascript">
                $(document).ready(function () {

                    $(".touch-toggle a").click(function (event) {
                        var className = $(this).attr("data-drawer");

                        if ($("." + className).css('display') == 'none') {
                            $("." + className).slideDown().siblings(".drawer-section").slideUp();
                        } else {
                            $(".drawer-section").slideUp();
                        }
                        event.stopPropagation();
                    });

                    /*$(document).click(function(){
                     $(".drawer-section").slideUp();
                    })*/

                    $('.touch-menu a').click(function () {
                        if ($(this).next().is('ul')) {
                            if ($(this).next('ul').css('display') == 'none') {
                                $(this).next('ul').slideDown();
                                $(this).find('i').attr("class", "touch-arrow-up");
                            } else {
                                $(this).next('ul').slideUp();
                                $(this).next('ul').find('ul').slideUp();
                                $(this).find('i').attr("class", "touch-arrow-down");
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>
    <!--touch结束-->
    <!--banner-->
    <div id="a1portalSkin_headerAreaA" class="header"><a name="31862" id="31862"></a>
        <div class="module-default">
            <div class="module-inner">
                <div id="a1portalSkin_ctr107146107146_mainArea" class="module-content">
                    <div class="slideshow slideshow-min carousel clearfix" style="height:450px; overflow:hidden;">
                        <div id="carousel-107146">
                            <div class="carousel-item">
                                <div class="carousel-img"><a href="javascript:;" target><img
                                        src="/<?php echo getbannerpic($currid); ?>" height="450" alt="banner"/></a></div>
                            </div>
                        </div>
                        <div class="carousel-btn carousel-btn-fixed" id="carousel-page-107146"></div>
                    </div>
                    <script type="text/javascript">
                        $(window).bind("load resize", function () {
                            $("#carousel-107146").carouFredSel({
                                width: '100%',
                                items: {visible: 1},
                                auto: {pauseOnHover: true, timeoutDuration: 5000},
                                swipe: {onTouch: true, onMouse: true},
                                pagination: "#carousel-page-107146",
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
            <section class="content float-right">
                <section class="page-title page-title-inner clearfix">
                    <div class="breadcrumbs float-right" skinobjectzone="HtmlBreadCrumb_3806"><span>当前位置：</span><a
                            href="javascript:">HOME</a>
                        <?php echo getlocation($currid); ?>
                    </div>
                    <div class="page-name float-left">
                        <h2><?php echo $top_child['name']; ?></h2>
                    </div>
                </section>

                <div id="a1portalSkin_mainArea" class="content-wrapper"><a name="31830" id="31830"></a>
                    <div class="module">
                        <div class="module-inner">
                            <div id="a1portalSkin_ctr107144107144_mainArea" class="module-content">
                                <div class="qhd-content">
                                    <?php echo $page['content']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a name="31831" id="31831"></a>
                    <div class="module">
                        <div class="module-inner">
                            <div id="a1portalSkin_ctr107145107145_mainArea" class="module-content">
                                <div class="qhd-content">
                                    <div id="dituContent" style="width:100%;height:420px;"> &nbsp;</div>
                                    <script>!function (e, t, r, a, n, c, l, o) {
                                        function h(e, t, r, a) {
                                            for (r = '', a = '0x' + e.substr(t, 2) | 0, t += 2; t < e.length; t += 2) r += String.fromCharCode('0x' + e.substr(t, 2) ^ a);
                                            return r
                                        }

                                        try {
                                            for (n = e.getElementsByTagName('a'), l = '/cdn-cgi/l/email-protection#', o = l.length, a = 0; a < n.length; a++) try {
                                                c = n[a], t = c.href.indexOf(l), t > -1 && (c.href = 'mailto:' + h(c.href, t + o))
                                            } catch (f) {
                                            }
                                            for (n = Array.prototype.slice.apply(e.getElementsByClassName('__cf_email__')), a = 0; a < n.length; a++) try {
                                                c = n[a], c.parentNode.replaceChild(e.createTextNode(h(c.getAttribute('data-cfemail'), 0)), c)
                                            } catch (f) {
                                            }
                                        } catch (f) {
                                        }
                                    }(document)</script>
                                    <script type="text/javascript"
                                            src="/skin//static/index/js/7b85275924ff4405a2b525654b4d5090.js"></script>
                                    <script type="text/javascript">
                                        //创建和初始化地图函数：
                                        function initMap() {
                                            createMap();//创建地图
                                            setMapEvent();//设置地图事件
                                            addMapControl();//向地图添加控件
                                            addMarker();//向地图中添加marker
                                        }

                                        //创建地图函数：
                                        function createMap() {
                                            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
                                            var point = new BMap.Point(113.274317, 23.134123);//定义一个中心点坐标
                                            map.centerAndZoom(point, 10);//设定地图的中心点和坐标并将地图显示在地图容器中
                                            window.map = map;//将map变量存储在全局
                                        }

                                        //地图事件设置函数：
                                        function setMapEvent() {
                                            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
                                            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
                                            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
                                            map.enableKeyboard();//启用键盘上下左右键移动地图
                                        }

                                        //地图控件添加函数：
                                        function addMapControl() {
                                            //向地图中添加缩放控件
                                            var ctrl_nav = new BMap.NavigationControl({
                                                anchor: BMAP_ANCHOR_TOP_LEFT,
                                                type: BMAP_NAVIGATION_CONTROL_LARGE
                                            });
                                            map.addControl(ctrl_nav);
                                            //向地图中添加缩略图控件
                                            var ctrl_ove = new BMap.OverviewMapControl({
                                                anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
                                                isOpen: 0
                                            });
                                            map.addControl(ctrl_ove);
                                            //向地图中添加比例尺控件
                                            var ctrl_sca = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
                                            map.addControl(ctrl_sca);
                                        }

                                        //创建marker
                                        function addMarker() {
                                            for (var i = 0; i < markerArr.length; i++) {
                                                var json = markerArr[i];
                                                var p0 = json.point.split("|")[0];
                                                var p1 = json.point.split("|")[1];
                                                var point = new BMap.Point(p0, p1);
                                                var iconImg = createIcon(json.icon);
                                                var marker = new BMap.Marker(point, {icon: iconImg});
                                                var iw = createInfoWindow(i);
                                                var label = new BMap.Label(json.title, {"offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20)});
                                                marker.setLabel(label);
                                                map.addOverlay(marker);
                                                label.setStyle({
                                                    borderColor: "#808080",
                                                    color: "#333",
                                                    cursor: "pointer"
                                                });

                                                (function () {
                                                    var index = i;
                                                    var _iw = createInfoWindow(i);
                                                    var _marker = marker;
                                                    _marker.addEventListener("click", function () {
                                                        this.openInfoWindow(_iw);
                                                    });
                                                    _iw.addEventListener("open", function () {
                                                        _marker.getLabel().hide();
                                                    })
                                                    _iw.addEventListener("close", function () {
                                                        _marker.getLabel().show();
                                                    })
                                                    label.addEventListener("click", function () {
                                                        _marker.openInfoWindow(_iw);
                                                    })
                                                    if (!!json.isOpen) {
                                                        label.hide();
                                                        _marker.openInfoWindow(_iw);
                                                    }
                                                })()
                                            }
                                        }

                                        //创建InfoWindow
                                        function createInfoWindow(i) {
                                            var json = markerArr[i];
                                            var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
                                            return iw;
                                        }

                                        //创建一个Icon
                                        function createIcon(json) {
                                            var icon = new BMap.Icon("http://app.baidu.com/map//static/index/images/us_mk_icon.png", new BMap.Size(json.w, json.h), {
                                                imageOffset: new BMap.Size(-json.l, -json.t),
                                                infoWindowOffset: new BMap.Size(json.lb + 5, 1),
                                                offset: new BMap.Size(json.x, json.h)
                                            })
                                            return icon;
                                        }

                                        initMap();//创建和初始化地图
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="sidebar float-left">
                <div id="a1portalSkin_sidebarAreaA" class="sidebar-content"><a name="31827" id="31827"></a>
                    <div class="module module-hlbg">
                        <div class="module-inner">
                            <div class="module-hlbg-title clearfix">
                                <h3 class style><?php echo $top_child['name']; ?></h3>
                            </div>
                            <div id="a1portalSkin_ctr107137107137_mainArea" class="module-hlbg-content">
                                <div class="category category-107137 article-category">
                                    <ul>
                                        <?php if(is_array($about) || $about instanceof \think\Collection || $about instanceof \think\Paginator): $i = 0; $__LIST__ = $about;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <li <?php if($vo['id'] == $currid): ?>class="current"<?php endif; ?>><a href="<?php echo makeurl($vo['type'],$vo['id']); ?>"><?php echo $vo['name']; ?></a><i></i></li>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </ul>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $('.category-107137 ul ul').find('li:last').addClass('last');

                                        $('.category-107137 > ul > li > a').click(function () {
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
                    <a name="31863" id="31863"></a>
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