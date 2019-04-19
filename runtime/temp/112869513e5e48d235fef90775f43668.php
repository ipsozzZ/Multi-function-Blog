<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"E:\xampp\xampp\htdocs\TP5\Multi-function-Blog\public/../application/admin\view\login\index.html";i:1541252774;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ipso网站管理系统</title>
    <link rel="stylesheet" href="/static/admin/vendor/layui/css/layui.css">
    <link rel="stylesheet" href="/static/admin/custom/css/login.css">
</head>
<body>
<div class="layui-anim layui-anim-up login-main" id="form-main">
    <form class="layui-form" action="?" method="post">
        <h3>ipso网站管理系统</h3>
        <div class="ly-input">
            <input type="text" name="account" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
        </div>
        <div class="ly-input">
            <input type="password" name="password" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="ly-input" style="position:relative">
            <input type="text" name="code" required  lay-verify="required" placeholder="请输入验证码" autocomplete="off" class="layui-input" style="width: 100px">
            <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick = "this.src='<?php echo captcha_src(); ?>?' + Math.random();" style="position: absolute; left: 110px;top: 0px; height: 38px; width: 170px; cursor: pointer/*让鼠标变成手指形状*/ "/>
        </div>
        <div class="ly-input">
            <button class="layui-btn layui-btn-danger ly-submit" id="ly-submit" lay-submit lay-filter="formDemo">登录</button>
        </div>
    </form>
    <p>版权所有：<em>ipso</em></p>
</div>

<script src="/static/admin/vendor/js/jquery.js"></script>
<script src="/static/admin/vendor/layui/layui.js"></script>
<script src="/static/admin/custom/js/login.js"></script>
<script>
    //一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
        var layer = layui.layer
            ,form = layui.form;
        form.on('submit(formDemo)', function(data){
            $('#ly-submit').submit();
        });
    });
</script>
</body>
</html>