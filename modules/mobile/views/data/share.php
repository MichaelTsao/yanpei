<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/10
 * Time: 下午8:37
 *
 * @var $users array
 * @var $type string
 * @var $id integer
 */
?>

<?php if (isset($users)): ?>
    <?php foreach ($users as $user): ?>
        <div class="case-list-con">
            <a href="<?= \yii\helpers\Url::to(['', 'type' => $type, 'id' => $id, 'uid' => $user->uid]) ?>">
                <dl>
                    <dt <?= "style=\"background: url('{$user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
                    <dd>
                        <h1><?= Yii::$app->user->identity->doctor ? $user->name : $user->doctor->name ?></h1>
                        <h2>
                        </h2>
                    </dd>
                </dl>
            </a>
        </div>
    <?php endforeach; ?>
    <?= ''//$this->render('/template/page', ['data' => $data]);     ?>
<?php endif; ?>
