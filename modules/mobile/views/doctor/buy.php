<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午11:53
 *
 * @var array $product
 * @var string $service
 * @var string $hospital
 * @var int $price
 * @var int $uid
 */
?>

<div class="place-order-con">
    <div onclick="window.location.href='/m/doctor/choose-service/<?= $uid; ?>'">
        <span <?= $service ? 'class="active"' : ''; ?>><?= $service ? $service : '请选择服务项目'; ?></span>
        <span class="place-order-arrow"></span>
    </div>
    <?php foreach ($product as $id => $name): ?>
        <div onclick="window.location.href='/m/product/info/<?= $id ?>'">
            <span class="active"><?= $name ?></span>
            <span class="place-order-cross" onclick="deleteProduct(<?= $id ?>);event.stopPropagation();"></span>
        </div>
    <?php endforeach; ?>
    <div onclick="window.location.href='/m/doctor/choose-product/<?= $uid; ?>'">
        <span>选择产品</span>
        <span class="place-order-arrow"></span>
    </div>
    <div onclick="window.location.href='/m/doctor/choose-center/<?= $uid; ?>'">
        <span <?= $hospital ? 'class="active"' : ''; ?>><?= $hospital ? $hospital : '请选择服务中心'; ?></span>
        <span class="place-order-arrow"></span>
    </div>
</div>
<div class="place-order-center">
    <h1><span>价格：</span><span><?= $price ?></span></h1>
    <!--    <h2>2016-6-17</h2>-->
</div>
<div class="place-order-button">
    <a href="/m/orders/new/<?= $uid ?>">立即下单</a>
</div>

<script>
    function deleteProduct(id) {
        $.get('/m/orders/delete-product?user_id=<?= $uid; ?>&product_id=' + id, function (data) {
            window.location.href = "/m/doctor/buy/<?= $uid; ?>";
        });
    }
</script>