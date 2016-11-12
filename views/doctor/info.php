<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 下午11:58
 *
 * @var $info app\models\Doctor
 * @var $hasFav boolean
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>专家团队</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>我要验配 &gt; </li>
                <li>专家团队 &gt; </li>
            </ul>
        </div>
    </div>
    <div class="doctor-details-main">
        <div class="doctor-details-top clearfix">
            <dl class="clearfix">
                <dt <?= "style=\"background: url('{$info->cover}')no-repeat center center; background-size: cover\"" ?>></dt>
                <dd>
                    <h1 class="clearfix">
                        <span class="doctor-details-name"><?= $info->name ?></span>
                        <span class="doctor-details-address"><?= $info->work_location ?></span>
                    </h1>
                    <h2><?= $info->title ?></h2>
                    <h2><?= $info->school?> <?= $info->education ?></h2>
                    <p class="clearfix">
                        <a href="#" class="doctor-details-collection" onclick="fav()">
                            <span class="doctor-collection-icon<?php if ($hasFav) echo ' active'; ?>" id="fav"></span>
                            <span>收藏</span>
                        </a>
                        <a href="/doctor/chat/<?= $info->uid ?>" class="doctor-details-contact">立即联系</a>
                    </p>
                </dd>
            </dl>
        </div>
        <div class="doctor-service-Items">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>医师服务项目</h1>
            <ul class="clearfix">
                <?php foreach ($info->service as $item): ?>
                    <li><?= \app\models\Service::findOne($item->service_id)->name ?></li>
                <?php endforeach ?>
            </ul>
        </div>
        <div class="doctor-details-introduction">
            <h1 class="clearfix"><span><img src="/res/img/h1-left-border.png" alt=""/></span>医师详情介绍</h1>
            <p><?= nl2br($info->intro) ?></p>
        </div>
    </div>
</div>

<script>
    function fav() {
        var hasFav = $('#fav').hasClass('active');
        var url = '';
        if (hasFav == true) {
            url = '/m/doctor/fav/<?= $info->uid ?>-0';
        } else {
            url = '/m/doctor/fav/<?= $info->uid ?>-1';
        }
        $.get(url, function (data) {
            if (data == 1) {
                $('#fav').addClass('active');
            } else {
                $('#fav').removeClass('active');
            }
        });
    }
</script>