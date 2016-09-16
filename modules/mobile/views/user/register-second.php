<div class="Re-next-step-content">
    <form method="post">
        <div class="Re-next-line">
            <h1>姓名</h1>
            <p><input type="text" name="name" placeholder="请输入您的真实姓名" class="ReFullName Crequired"/></p>
            <strong class="ReFullNameError"></strong>
        </div>
        <div class="Re-next-gender">
            <h1>性别</h1>
            <div class="Re-next-gender-btn">
                    <span onclick="$('#gender').val(2)">
                        <b>男</b>
                    </span>
                &nbsp;&nbsp;
                    <span onclick="$('#gender').val(1)">
                        <b>女</b>
                    </span>
            </div>
            <input type="hidden" name="gender" id="gender" value="0">
            <strong class="genderError"></strong>
        </div>
        <div class="Mp-main-con-bot Mp -main-con-bots">
            <span class="Complete-registration-button"><input type="submit" value="完成注册"></span>
        </div>
        <div class="register-btn-bot-text">
        </div>
    </form>
</div>
<!--注册第二步--注册成功后弹出提示框--start-->
<div class="Complete-registration-tips">
    <h1>注册成功<!--<span><img src="/res/img/ico-close.png" alt="" class="registration-tips-close"/></span>--></h1>
    <p>
        您在进行约见时，本平台会通过短信和微信，随时通知您约见进度，并提醒您需要进行的步骤。 <br/> <br/>
        关注微信公众服务号“<b>大咖说</b>”，可以即时收到约见进度通知。
    </p>
    <div>
        <a href="<?= Yii::$app->request->cookies->get('urlReferrer') ?>"><span class="registration-tips-btn">知道了</span>
        </a>
    </div>
</div>
<!--注册第二步--注册成功后弹出提示框--end-->