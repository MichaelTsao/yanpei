<div class="H-main-top">
    <p class="clearfix">
        <span><img src="/res/img/seach-imgs.png" alt=""/></span>
        <span>
            <input type="text" id="keyword" placeholder="搜索" value="<?= isset($keyword) ? $keyword : '' ?>" onkeypress="search()" />
        </span>
    </p>
</div>

<?php foreach ($data as $item): ?>
    <div class="H-mian-con" onclick="window.location.href='<?= \yii\helpers\Url::to(['doctor/' . $item->uid]); ?>';return false;">
        <div>
            <dl>
                <dt>
                    <img src="<?= $item->cover ?>" alt="" class="home_pic" onload="CommonIscroll.refreshScroll();"/>
                </dt>
                <dd>
                    <h1 class="clearfix">
                        <span><?= $item->name ?></span>
                        <span><?= $item->title ?></span>
                    </h1>
                    <ul class="clearfix">
                        <?php if (!empty($item->service)): ?>
                            <?php foreach ($item->service as $s): ?>
                                <li><?= \app\models\Service::findOne($s->service_id)->name ?></li>
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
        var word = $('#keyword').val();
        if (word != '') {
            var url = 'http://' + window.location.host + '/m/search/' + word;
        }else{
            var url = 'http://' + window.location.host + '/m';
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

