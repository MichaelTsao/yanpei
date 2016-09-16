<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/27
 * Time: 下午8:11
 */
?>

<div class="wrapper">
    <div class="medical-records-main clearfix">
        <div class="medical-records-main-top clearfix">
            <h1>我的病人</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>我的病人</li>
            </ul>
        </div>
        <div class="medical-records-main-center clearfix">
        </div>
        <?php foreach ($data as $item): ?>
            <?php $user = \app\models\User::findOne($item->uid) ?>
            <a href="/doctor/chat-user/<?= $item->uid ?>">
                <div class="medical-records-con clearfix">
                    <dl class="clearfix">
                        <dt <?= "style=\"background: url('{$item->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                        <dd>
                            <h1><?= $user->name ?></h1>
                            <p>
                                <span><?= $item->last_msg ?></span>
                                <br/>
                                <br/>
                                <span><?= $item->last_time ?></span>
                            </p>
                        </dd>
                    </dl>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <!--分页-->
    <!--
    <div class="paging-con clearfix">
        <div class="paging-left-arrow"><a href="#n">&lt;</a></div>
        <div class="paging-center-con">
            <ul class="clearfix">
                <li><a href="#n">1</a></li>
                <li><a href="#n">2</a></li>
                <li><a href="#n">3</a></li>
                <li><a href="#n">4</a></li>
                <li><a href="#n">5</a></li>
                <li><a href="#n" class="paging-no-background">....</a></li>
                <li><a href="#n">15</a></li>
                <li><a href="#n">30</a></li>
                <li><a href="#n">45</a></li>
            </ul>
        </div>
        <div class="paging-right-arrow"><a href="#n">&gt;</a></div>
    </div>
    -->
</div>
