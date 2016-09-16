<form method="post" id="ch">
    <div class="Re-big-box">
        <div>
            <div class="Mp-main-con-text">
                <span><input type="text" name="info" value="<?= $realname; ?>" placeholder="修改姓名" maxlength="4"
                             class="FullName required"/></span>
<!--                <span class="FullNameError"></span>-->
            </div>
        </div>
    </div>
    <div class="Mp-main-con-bot Complete-name-button">
        <span><a onclick="$('#ch').submit()">提 交</a></span>
    </div>
</form>
<!--提交成功--弹出提示-->
<!--<div class="Suggestion-tips">-->
<!--    <p>姓名修改成功！</p>-->
<!--</div>-->