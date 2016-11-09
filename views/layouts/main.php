<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>e听</title>
    <?php $this->head() ?>

    <!--    <link rel="stylesheet" href="/res/css/style.css"/>-->
    <!--    <script src="/js/public/jquery.js"></script>-->
    <!--    <script src="/js/public/js.cookie.js"></script>-->
    <!--    <script type="text/javascript" src="/js/public/jquery.touchSlider.js"></script>-->
    <!--    <script src="/js/public/placehoders.js"></script>-->
    <!--    <script src="/js/public/slide.js"></script>-->
    <!--    <script src="/js/public/slide_use.js"></script>-->
    <!--    <link rel="stylesheet" href="/js/new/laydate/need/laydate.css"/>-->
    <!--    <link rel="stylesheet" href="/css/lightbox.css"/>-->
    <!--    <script src="/js/new/laydate/laydate.js"></script>-->
    <!--    <script src="/js/public/effect.js"></script>-->

</head>
<body style="background: #f4f4f6">
<?php $this->beginBody() ?>

<div class="navbar-wrapper">
    <div class="container">

        <?php
        NavBar::begin([
            'brandLabel' => '<img src="/res/img/logo-img.png" alt=""/>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => '我要验配', 'url' => ['/']],
            ['label' => '科普知识', 'url' => ['/admin/doctor']],
            ['label' => '产品展示', 'url' => ['/admin/user']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '登录', 'url' => ['/admin/default/login']];
            $menuItems[] = ['label' => '注册', 'url' => ['/admin/default/login']];
        } else {
            $menuItems[] = [
                'label' => '登出 (' . Yii::$app->user->identity->name . ')',
                'url' => ['/admin/default/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

    </div>
</div>


<div class="H-nav clearfix">
    <div class="H-nav-con clearfix">
        <div class="H-nav-con-left clearfix">
            <a href="/"><p class="H-logo-img"><img src="/res/img/logo-img.png" alt=""/></p></a>
            <p class="H-nav-search clearfix">
                <span class="H-search-icon"><img src="/res/img/search-icon.png" alt=""/></span>
                <span class="H-search-box"><input type="text" id="keyword" placeholder="搜索"
                                                  value="<?= isset($this->params['keyword']) ? $this->params['keyword'] : '' ?>"
                                                  onkeyup="pressEnter()"/>
                </span>
            </p>
        </div>

        <div class="H-nav-con-right">
            <div class="H-nav-right-con1 clearfix">
                <ul class="H-nav-right-ul">
                    <li><a href="/"<?php if (isset($this->params['isYanpei'])) echo 'class="active"'; ?>>我要验配</a></li>
                    <li>
                        <a href="/article/list"<?php if (isset($this->params['isKnow'])) echo 'class="active"'; ?>>科普知识</a>
                    </li>
                    <li><a href="/product/list"<?php if (isset($this->params['isProduct'])) echo 'class="active"'; ?>>产品展示</a>
                    </li>
                </ul>
            </div>

            <?php if (Yii::$app->user->isGuest): ?>
                <!--首页未登录过显示的内容区域--start-->
                <div class="H-nav-not-login">
                    <a href="/user/login" class="active">登录</a>
                    <a href="/user/register" id="reg-button">注册</a>
                </div>

                <!--                <div class="H-pop-list-reg">-->
                <!--                    <div class="H-pop-list-top"></div>-->
                <!--                    <div class="H-pop-list-center clearfix">-->
                <!--                    </div>-->
                <!--                    <div class="H-pop-list-bot"></div>-->
                <!--                </div>-->
                <!--首页未登录过显示的内容区域--end-->
            <?php else: ?>
                <!--首页登录过后显示的内容区域--start-->
                <div class="H-nav-right-con2 clearfix">
                    <div class="H-nav-full-name">
                        <a href="/user/info"><?= Yii::$app->user->identity->name ?></a>
                    </div>
                    <div class="H-nav-personal-center">
                        <span
                            class="H-personal-center-head-img" <?= "style=\"background: url('" . Yii::$app->user->identity->icon . "')no-repeat center center;\"" ?>></span>
                        <!--头像-->
                        <!--首页-弹出列表-->
                        <div class="H-pop-list">
                            <div class="H-pop-list-top"></div>
                            <div class="H-pop-list-center clearfix">
                                <ul>
                                    <li><a href="/user/info">个人资料与账户设置</a></li>
                                    <li><a href="/orders/list">我的订单</a></li>
                                    <li><a href="/case/list">我的病历</a></li>
                                    <li><a href="/doctor/favorite">我收藏的验配师</a></li>
                                    <?php if (!Yii::$app->user->identity->doctor): ?>
                                        <li><a href="/doctor/apply">申请成为验配师</a></li>
                                    <?php endif; ?>
                                    <li><a href="/user/logout">退出</a></li>
                                </ul>
                            </div>
                            <div class="H-pop-list-bot"></div>
                        </div>
                    </div>
                </div>
                <!--首页登录过后显示的内容区域--end-->
            <?php endif ?>
        </div>

    </div>
</div>

<?= $content ?>

<div class="footer">
    <ul>
        <li>Copyright © 2014 - <?= date('Y'); ?> e听网</li>
        <!--        <li>地址：北京市某地</li>-->
        <!--        <li>ICP 12345ABC</li>-->
    </ul>
</div>

<script>

    function search() {
        var word = $('#keyword').val();
        if (word != '') {
            var url = 'http://' + window.location.host + '/doctor/search/' + word;
            window.location.href = url;
            return false;
        }
    }

    function pressEnter() {
        if (window.event.keyCode == 13) {
            search();
            return false;
        }
    }

</script>

<script src="/js/public/effect.js"></script>
<script src="/js/lightbox.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
