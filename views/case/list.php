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
            <h1>查看病历</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>专家团队 &gt; </li>
                <li>联系专家 &gt; </li>
                <li>查看病历</li>
            </ul>
        </div>
        <div class="medical-records-main-center clearfix">
            <!--            <a href="#n" class="M-return">返回</a>-->
            <?php if($can_create):?>
                <a href="/case/new/<?=$id?>" class="M-new-case">新建病历</a>
            <?php endif;?>
        </div>
        <?php foreach ($data as $item): ?>
            <a href="/case/info/<?= $item->case_id; ?>">
                <div class="medical-records-con clearfix">
                    <dl class="clearfix">
                        <dt <?= "style=\"background: url('{$item->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                        <dd>
                            <h1><?= $item->user->name ?></h1>
                            <p>
                                <span>创建时间：</span>
                                <span><?= $item->ctime ?></span>
                            </p>
                            <br/>
                            <p>
                                <span>创建人：</span>
                                <span><?= ($item->doctor_id) ? $item->doctor->name : '本人' ?></span>
                            </p>
                            <?php if(!Yii::$app->user->identity->doctor || $item->doctor_id == Yii::$app->user->id): ?>
                            <a href="#" class="close-btn-icon" onclick="removeCase(this.id); event.stopPropagation();"
                               id="<?= $item->case_id; ?>">
                                <img src="/res/img/close-btn.png" alt=""/>
                            </a>
                            <?php endif;?>
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

<script>
    function removeCase(id) {
        if (confirm('你确认删除此病历么?')) {
            $.get('/m/case/delete/' + id, function (data) {
                if (data != 'ok') {
                    alert(data);
                } else {
                    window.location.reload();
                }
            });
        }
    }
</script>