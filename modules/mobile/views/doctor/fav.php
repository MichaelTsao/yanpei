<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/29
 * Time: 上午7:38
 */
?>

<?php foreach ($data as $item): ?>
    <div class="H-mian-con" onclick="window.location.href='<?= \yii\helpers\Url::to(['doctor/' . $item->uid]); ?>';">
        <div>
            <dl>
                <dt>
                    <img src="<?= $item->cover ?>" alt="" class="home_pic"/>
                </dt>
                <dd>
                    <h1>
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

