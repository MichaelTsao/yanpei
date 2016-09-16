<form method="post" id="ch">
    <div class="Cg-main">
        <p>
            <span <?php if ($gender == \app\models\User::GENDER_MALE) { ?> class="active" <?php } ?>
                onclick="$('#info').val(<?=\app\models\User::GENDER_MALE?>); doit(this);">男</span>
            <span <?php if ($gender == \app\models\User::GENDER_FEMALE) { ?> class="active" <?php } ?>
                onclick="$('#info').val(<?=\app\models\User::GENDER_FEMALE?>); doit(this);">女</span>
        </p>
    </div>
    <input type="hidden" name="info" id="info" value="<?= $gender ?>">
    <div class="Mp-main-con-bot Complete-gender-button">
        <span><a onclick="$('#ch').submit()">提 交</a></span>
    </div>
</form>

<script>
    function doit(obj) {
        $(obj).addClass("active").siblings().removeClass("active");
    }
</script>
<!--提交成功--弹出提示-->
<!--<div class="Suggestion-tips">-->
<!--    <p>性别修改成功！</p>-->
<!--</div>-->