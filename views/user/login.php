<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 上午10:25
 */
?>
<div class="login-big-box">
    <div class="wrapper">
        <div class="login-con">
            <h1 class="login-con-h1">e听</h1>
            <div class="login-con-text">
                <p class="clearfix">
                    <span class="login-icon"><img src="/res/img/l-icon1.png" alt=""/></span>
                    <span class="login-text-box"><input type="text" placeholder="手机号" id="phone"/></span>
                </p>
<!--                <strong>错误</strong>-->
            </div>
            <div class="login-con-text">
                <p class="clearfix">
                    <span class="login-icon"><img src="/res/img/l-icon2.png" alt=""/></span>
                    <span class="login-text-box"><input type="password" placeholder="密码" id="password"/></span>
                </p>
<!--                <strong>错误</strong>-->
                <a href="#n" class="login-forget-password">忘记密码</a>
            </div>
            <div class="login-btn">
                <a href="#" onclick="login()">登录</a>
            </div>
            <div class="login-btn-bottom">
                <p>没有账号？<a href="#n">注册</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    function login() {
        $.post('/user/login?ajax=1', {phone: $("#phone").val(), password: $("#password").val()},
            function (data) {
                if (data != 'ok') {
                    alert(data);
                } else {
                    $(location).attr('href', "/");
                    return false;
                }
            });
    }
</script>
