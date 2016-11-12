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

<div class="doctor-introduction-banner">
    <img src="<?= $info->cover ?>" alt=""/>
    <span id="fav"<?php if ($hasFav) echo ' class="active"'?> onclick="fav()"></span>
</div>
<div class="doctor-introduction-con clearfix">
    <div>
        <h1 class="clearfix">
            <span><?= $info->name ?></span>
            <span><?= $info->work_location ?></span>
        </h1>
        <p><?= $info->title ?></p>
        <p><?= $info->school ?> <?= $info->education ?></p>
    </div>
</div>
<div class="doctor-service-items">
    <div>
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>医师服务项目</span>
        </h1>
        <ul class="clearfix">
            <?php foreach ($info->service as $item): ?>
                <li><?= \app\models\Service::findOne($item->service_id)->name ?></li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
<div class="doctor-detailed-introduction">
    <div>
        <h1 class="clearfix">
            <span><img src="/res/img/h1-left-border.png" alt=""/></span>
            <span>医师详细介绍</span>
        </h1>
        <div class="doctor-detailed-introduction-text">
            <p>
                <?= nl2br($info->intro) ?>
            </p>
        </div>
    </div>
</div>

<script>
    function fav() {
        var hasFav = $('#fav').hasClass('active');
        var url = '';
        if (hasFav == true) {
            url = '/m/doctor/fav/<?= $info->uid ?>-0';
        }else{
            url = '/m/doctor/fav/<?= $info->uid ?>-1';
        }
        $.get(url, function (data){
            if(data == 1){
                $('#fav').addClass('active');
            }else{
                $('#fav').removeClass('active');
            }
        });
    }
</script>