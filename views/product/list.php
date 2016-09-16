<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/26
 * Time: 下午8:57
 */
?>
<!--
<div class="H-banner">
    <div class="main_visual">
        <div class="flicking_con">
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
            <a href="#"></a>
        </div>
        <div class="main_image">
            <ul>
                <li><span class="img_1"></span></li>
                <li><span class="img_4"></span></li>
                <li><span class="img_3"></span></li>
                <li><span class="img_1"></span></li>
            </ul>
            <a href="javascript:;" id="btn_prev"></a>
            <a href="javascript:;" id="btn_next"></a>
        </div>
    </div>
</div>
-->
<div class="wrapper">
    <div class="product-display-main clearfix">
        <div class="clearfix">
            <?php foreach ($data as $i => $item): ?>
                <a href="/product/info/<?= $item->product_id ?>">
                    <div class="product-display-box<?php if ($i % 3 == 1) echo ' clearance' ?>">
                        <dl>
                            <dt <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                            <dd>
                                <p class="product-display-text"><?= $item->name ?></p>
                                <p>
                                    <span class="product-display-price">价格：</span>
                                    <span class="product-display-number">￥<?= $item->price ?></span>
                                </p>
                            </dd>
                        </dl>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <!--分页-->
    <!--
    <div class="paging-con clearfix">
        <div class="paging-left-arrow"><a href="#n">&lt;</a></div>
        <div class="paging-center-con">
            <ul class="clearfix">
                <li><a href="#n">1</a></li>
                <li><a href="#n" class="active">2</a></li>
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
