<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午11:53
 *
 * @var array $service
 * @var int $order_id
 */
?>

<div class="H-main-top selection-device-top">
    <p class="clearfix">
        <span><img src="/res/img/seach-imgs.png" alt=""/></span>
        <span>
            <input type="text" placeholder="搜索"/>
        </span>
    </p>
</div>
<div class="select-service-con clearfix">
    <?php foreach ($service as $id => $name): ?>
        <a href="#" onclick="select(this)" id="<?= $id; ?>"><?= $name ?></a>
    <?php endforeach; ?>
</div>

<div class="Mp-main-con-bot  Complete-PhoneNumber-button">
    <span><a href="#" onclick="doit()">提 交</a></span>
</div>

<script>
    function select(obj) {
        var item = $(obj);
        if (item.hasClass('active')) {
            item.removeClass('active');
        } else {
            item.addClass('active');
        }
    }

    function doit() {
        var s = [];
        $.each($("a.active"), function (i, one) {
            s.push(parseInt(one.id));
        });
        var id = JSON.stringify(s);
        $.get('<?= \yii\helpers\Url::to(['orders/set-order-service', 'order_id' => $order_id])?>&service_id=' + id,
            function (data) {
                window.location.href = "<?= \yii\helpers\Url::to(['orders/change', 'id' => $order_id]); ?>";
            });
    }
</script>
