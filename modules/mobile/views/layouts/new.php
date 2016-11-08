<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>e听</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" href="/res/new-css/style.css"/>
    <link rel="stylesheet" href="/js/new/laydate/need/laydate.css"/>
    <script src="/js/public/effect.js"></script>
</head>
<body>

<?php $style = ""; ?>
<?php if (Yii::$app->controller->id == 'case' && Yii::$app->controller->action->id == 'list'): ?>
    <div class="case-list-top">
        <p>
            <a href="javascript:history.back()">返回</a>
            <?php if ($this->params['can_create']): ?>
                <a href="/m/case/new/<?= isset($this->params['new_id']) ? $this->params['new_id'] : '' ?>">新建病历</a>
            <?php endif; ?>
        </p>
    </div>
    <?php $style = " style=\"top: 50px\""; ?>
<?php endif; ?>

<?php if (!isset($this->params['noScroll'])): ?>
<div id="wrapper"<?= $style ?>>
    <div class="scroller">
        <?php endif; ?>

        <?= $content ?>

        <?php if (!isset($this->params['noScroll'])): ?>
    </div>
</div>
<?php endif; ?>

<?php if (Yii::$app->controller->id == 'doctor' && Yii::$app->controller->action->id == 'info'): ?>
    <div class="doctor-introduction-button">
        <a href="/m/doctor/chat/<?= $this->params['doctor_info']->uid ?>">咨询预约</a>
    </div>
<?php else: ?>
    <footer>
        <div class="footer">
            <ul>
                <li class="H-footer-home">
                    <a href="/m" class="footer-li-a">
                        <span
                            class="icon1<?php if (isset($this->params['isHome'])) echo ' active' ?>"><span></span></span>
                        <span class="name<?php if (isset($this->params['isHome'])) echo ' high' ?>">我要验配</span>
                    </a>
                </li>
                <li class="H-footer-find">
                    <a href="/m/data/type" class="footer-li-a">
                    <span
                        class="icon2<?php if (isset($this->params['isDataList'])) echo ' active' ?>"><span></span></span>
                        <span class="name<?php if (isset($this->params['isDataList'])) echo ' high' ?>">验配知识</span>
                    </a>
                </li>
                <li class="footer-consultation">
                    <a href="/m/product/list" class="footer-li-a">
                    <span
                        class="icon3<?php if (isset($this->params['isProduct'])) echo ' active' ?>"><span></span></span>
                        <span class="name<?php if (isset($this->params['isProduct'])) echo ' high' ?>">产品展示</span>
                    </a>
                </li>
                <li class="footer-individual-center">
                    <a href="/m/user/info" class="footer-li-a">
                    <span
                        class="icon4<?php if (isset($this->params['isUserInfo'])) echo ' active' ?>"><span></span></span>
                        <span class="name<?php if (isset($this->params['isUserInfo'])) echo ' high' ?>">个人中心</span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
<?php endif; ?>

<script src="/js/new/jquery.js"></script>
<script src="/js/new/iscroll5.js"></script>
<script src="/js/new/laydate/laydate.js"></script>
<script src="/js/new/CommonIscroll.js"></script>
</body>
</html>
