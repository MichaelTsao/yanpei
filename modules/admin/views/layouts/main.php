<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['site_name'] . ' 后台') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['site_name'] . ' 后台',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->account->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/admin/default/login']];
    } else {
        $menuItems = [
            ['label' => '订单', 'url' => ['/admin/orders']],
            ['label' => '验配师', 'url' => ['/admin/doctor']],
            ['label' => '用户', 'url' => ['/admin/user']],
            ['label' => '会话', 'url' => ['/admin/chat']],
            ['label' => '服务项目', 'url' => ['/admin/service']],
            [
                'label' => '验配中心',
                'items' => [
                    ['label' => '验配中心', 'url' => ['/admin/hospital']],
                    ['label' => '验配室', 'url' => ['/admin/office']],
                    ['label' => '库存', 'url' => ['/admin/store']],
                ]
            ],
            [
                'label' => '产品',
                'items' => [
                    ['label' => '产品列表', 'url' => ['/admin/product']],
                    ['label' => '功能点设置', 'url' => ['/admin/feature']],
                    ['label' => '品牌设置', 'url' => ['/admin/brand']],
                ]
            ],
            [
                'label' => '病历',
                'items' => [
                    ['label' => '病历列表', 'url' => ['/admin/cases']],
                    ['label' => '疾病设置', 'url' => ['/admin/ill']],
                ]
            ],
            [
                'label' => '文章',
                'items' => [
                    ['label' => '文章', 'url' => ['/admin/article']],
                    ['label' => '分类', 'url' => ['/admin/article-type']],
                ]
            ],
            ['label' => '首页通栏', 'url' => ['/admin/marquee']],
            ['label' => '常规配置', 'url' => ['/admin/config']],
        ];
        if (Yii::$app->account->can('write')) {
            $menuItems[] = ['label' => '系统账号', 'url' => ['/admin/account']];
        }
        $menuItems[] = [
            'label' => '登出 (' . Yii::$app->account->identity->username . ')',
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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => '首页',
                'url' => '/admin',
            ],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['site_name'] ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
