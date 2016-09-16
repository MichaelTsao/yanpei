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
        <div class="kl-con-type" onclick="window.location.href='/m/data/list/<?= $item->id ?>'">
            <dl>
                <dd style="align-content: center">
                    <h3><?= $item->name ?></h3>
                </dd>
            </dl>
        </div>
    <?php endforeach; ?>
    <?= ''//$this->render('/template/page', ['data' => $data]); ?>
<?php endif; ?>

