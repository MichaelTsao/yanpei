<form method="post">
    <div class="Re-big-box">
        <div class="Mp-main-con">
            <div class="Mp-main-con-text">
                <span><input type="password" id="old_password" name="old_password" placeholder="原密码" maxlength="32" class="OriginalPassword required"/></span>
                <strong class="OriginalPasswordError"></strong>
            </div>
            <div class="Mp-main-con-text">
                <span><input type="password" name="password" id="password" placeholder="新密码，不少于6位" maxlength="32" class="NewPassword required"/></span>
                <strong class="NewPasswordError"></strong>
            </div>
            <div class="Mp-main-con-text">
                <span><input type="password" name="password1" id="password1" placeholder="再次输入新密码" maxlength="32" class="ReNewPassword required"/></span>
                <strong class="ReNewPasswordError"></strong>
            </div>
        </div>
    </div>
    <div class="Mp-main-con-bot Complete-Password-button">
        <span><a onclick="doit()">提 交</a></span>
    </div>
</form>

<script>
    function doit(){
        var p = $('#password').val();
        var p1 = $('#password1').val();
        if (p != p1) {
            alert('两次密码输入不一致');
            return;
        }
        $.post('/m/user/change-password', {'old_password':$('#old_password').val(), 'password':$('#password').val()}, function (data) {
            if (data != 'ok') {
                alert(data);
            }else{
                window.location.href = "/m/user/info";
            }
        });
    }
</script>
<!--提交成功--弹出提示-->
<!--<div class="Suggestion-tips">-->
<!--    <p>密码修改成功！</p>-->
<!--</div>-->
