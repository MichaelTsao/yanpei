<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午4:27
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>选择服务</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>专家团队 &gt; </li>
                <li>联系专家 &gt; </li>
                <li>选择服务 &gt;</li>
            </ul>
        </div>
        <div class="clearfix big-search-box">
            <p class="big-search-box-con clearfix">
                <span class="H-search-icon search-box-icon"><img src="/res/img/search-icon.png" alt=""/></span>
                <span class="H-search-box"><input type="text" placeholder="搜索"/></span>
            </p>
        </div>
    </div>
    <div class="select-service-main clearfix">
        <ul class="select-service-ul clearfix">
            <?php foreach ($service as $id => $name): ?>
                <li><a href="#" onclick="select(this.id)" id="<?= $id; ?>"><?= $name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    function select(id) {
        $.get('/m/orders/set-service?user_id=<?= $user_id; ?>&service_id='+id, function (data) {
            window.location.href = "/doctor/buy/<?= $user_id; ?>";
        });
    }
</script>