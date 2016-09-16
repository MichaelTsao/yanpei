<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午11:53
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
        <a href="#" onclick="select(this.id)" id="<?= $id; ?>"><?= $name ?></a>
    <?php endforeach; ?>
</div>

<script>
    function select(id) {
        $.get('/m/orders/set-order-service?order_id=<?= $order_id; ?>&service_id='+id, function (data) {
            window.location.href = "/m/orders/change/<?= $order_id; ?>";
        });
    }
</script>