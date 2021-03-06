<div class="H-main-top">
    <p class="clearfix">
        <span><img src="/res/img/seach-imgs.png" alt=""/></span>
        <span>
            <input type="text" id="keyword" placeholder="搜索" value="<?= isset($keyword) ? $keyword : '' ?>"
                   onkeypress="pressEnter()"/>
        </span>
    </p>
</div>

<div class="H-main-top">
    <p class="clearfix">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        地区：<?= \yii\bootstrap\Html::dropDownList('locations', isset($location) ? $location : null,
            \app\models\Doctor::getLocations()); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        服务项目：<?= \yii\bootstrap\Html::dropDownList('services', isset($service) ? $service : null,
            \app\models\Service::getList()); ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?= \yii\bootstrap\Html::button('筛选', ['onclick' => 'search()']); ?>
    </p>
</div>

<?php foreach ($data as $item): ?>
    <div class="H-mian-con"
         onclick="window.location.href='<?= \yii\helpers\Url::to(['doctor/' . $item->uid]); ?>';return false;">
        <div>
            <dl>
                <dt>
                    <img src="<?= $item->cover ?>" alt="" class="home_pic" onload="CommonIscroll.refreshScroll();"/>
                </dt>
                <dd>
                    <h1 class="clearfix">
                        <span><?= $item->name ?></span>
                        <span><?= $item->title ?></span>
                        <?php if($item->rate): ?>
                            <span>
                                <?php for ($i=0; $i < $item->rate; $i++): ?>
                                    <img src="/images/star.png" style="width: 15px">
                                <?php endfor;?>
                            </span>
                        <?php endif ?>
                    </h1>
                    <ul class="clearfix">
                        <?php if (!empty($item->service)): ?>
                            <?php foreach ($item->service as $s): ?>
                                <li>
                                    <?= \app\models\Service::findOne($s->service_id) ?
                                        \app\models\Service::findOne($s->service_id)->name : '' ?>
                                </li>
                            <?php endforeach ?>
                        <?php endif ?>
                    </ul>
                    <div class="H-mian-con-bot clearfix">
                        <a href="#n">
                            <span><?= \app\models\Fav::getCount($item->uid); ?>人收藏</span>
                            <span>已接订单数<?= \app\models\Orders::getCount($item->uid); ?></span>
                        </a>
                        <a href="#n">咨询预约</a>
                    </div>
                </dd>
            </dl>
        </div>
    </div>
<?php endforeach; ?>

<script>

    function search() {
        var url = '';
        var word = $('#keyword').val();
        var location = $('select[name=locations]').val();
        var service = $('select[name=services]').val();

        if (word != '' || location != '' || service != '') {
            url = 'http://' + window.location.host + '/m/doctor/search/?keyword=' + word;
            if (typeof location != "undefined") {
                url += '&location=' + location;
            }
            if (typeof service != "undefined") {
                url += '&service=' + service;
            }
        } else {
            url = 'http://' + window.location.host + '/m';
        }
        window.location.href = url;
        return false;
    }

    function pressEnter() {
        if (window.event.keyCode == 13) {
            search();
            return false;
        }
    }

</script>

<!--<div class="H-mian-con-btn">-->
<!--    <a href="#n">查看更多</a>-->
<!--</div>-->

<!--<form onsubmit="return false;">-->
<!--    <div class="H-nav-search">-->
<!--        <p><span><img src="/res/logo.png" alt=""/></span></p>-->
<!--        <p>-->
<!--            <span onclick="search()"><img src="/res/img/search_icons.png" alt=""/></span>-->
<!--        <span>-->
<!--            <input type="search" placeholder="更多验配师" id="keyword" onkeypress="pressEnter()"/>-->
<!--        </span>-->
<!--        </p>-->
<!--    </div>-->
<!--</form>-->

