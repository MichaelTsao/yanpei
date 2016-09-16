<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 下午11:41
 */
?>

<div class="wrapper">
    <div class="fitting-knowledge-main">
        <?php foreach ($data as $item):?>
            <a href="/article/info/<?=$item->id?>">
        <div class="fitting-knowledge-con">
            <dl class="clearfix">
                <dt <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                <dd>
                    <h1><?=$item->title?></h1>
                    <p>
                        <span></span><span></span>
                    </p>
                </dd>
            </dl>
        </div>
            </a>
        <?php endforeach;?>
    </div>
    <!--分页-->
    <!--
    <div class="paging-con clearfix">
        <div class="paging-left-arrow"><a href="#n">&lt;</a></div>
        <div class="paging-center-con">
            <ul class="clearfix">
                <li><a href="#n">1</a></li>
                <li><a href="#n">2</a></li>
                <li><a href="#n" class="active">3</a></li>
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
