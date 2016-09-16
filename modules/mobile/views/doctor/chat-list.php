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
        <?php $user = \app\models\User::findOne($item->uid) ?>
        <div class="case-list-con">
            <a href="/m/doctor/chat-user/<?= $item->uid ?>">
                <dl>
                    <dt <?= "style=\"background: url('{$user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                    <dd>
                        <h1><?= $user->name ?></h1>
                        <h2>
                            <span><?= $item->last_msg ?></span>
                            <span style="float: right"><?= $item->last_time ?></span>
                        </h2>
                    </dd>
                </dl>
            </a>
        </div>
    <?php endforeach; ?>
    <?= ''//$this->render('/template/page', ['data' => $data]); ?>
<?php endif; ?>

