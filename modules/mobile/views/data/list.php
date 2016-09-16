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
        <div class="kl-con" onclick="window.location.href='/m/data/info/<?= $item->id ?>'">
            <dl>
                <dt <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?> id="icon_"></dt>
                <dd>
                    <h1><?= $item->title ?></h1>
                    <h2>
                        <span></span><span><?= $item->ctime ?></span>
                    </h2>
                </dd>
            </dl>
        </div>
    <?php endforeach; ?>
    <?= ''//$this->render('/template/page', ['data' => $data]); ?>
<?php endif; ?>

