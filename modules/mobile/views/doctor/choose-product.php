<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/29
 * Time: 上午12:04
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
<?php foreach ($product as $item): ?>
<div class="selection-device-list" onclick="select(this.id)" id="<?= $item->product_id; ?>">
    <dl>
        <dt>
            <span <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?>>
            </span>
        </dt>
        <dd>
            <h1 class="clearfix">
                <a href="#n"><?= $item->name ?></a>
                <a href="#n" onclick="window.location.href='/m/product/info/<?=$item->product_id?>';event.stopPropagation();">查看</a>
            </h1>

        </dd>
    </dl>
</div>
<?php endforeach;?>

<script>
    function select(id) {
        $.get('/m/orders/add-product?user_id=<?= $user_id; ?>&product_id='+id, function (data) {
            window.location.href = "/m/doctor/buy/<?= $user_id; ?>";
        });
    }
</script>