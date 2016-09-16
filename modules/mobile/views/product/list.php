<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/10
 * Time: 下午8:37
 */
?>

<?php if (isset($data)): ?>
    <?php foreach ($data as $item): ?>
        <a href="/m/product/info/<?= $item->product_id ?>">
            <div class="product-con">
                <dl>
                    <dt style="background: url('<?= $item->icon ?>') no-repeat center center; background-size: cover;"></dt>
                    <dd>
                        <h1><?= $item->name ?></h1>
                        <h2>
                            <span>价格：</span>
                            <span><b>￥</b><b><?= $item->price ?></b></span>
                        </h2>
                    </dd>
                </dl>
            </div>
        </a>
    <?php endforeach; ?>
    <?= ''//$this->render('/template/page', ['data' => $data]);  ?>
<?php endif; ?>

