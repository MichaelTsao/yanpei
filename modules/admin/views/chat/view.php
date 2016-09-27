<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Chat */

$this->title = '单个会话';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'chat_id',
            [
                'attribute' => 'user.name',
                'label' => '用户',
            ],
            [
                'attribute' => 'doctor.name',
                'label' => '验配师',
            ],
            'ctime',
            'last_time',
            'last_msg:ntext',
        ],
    ]) ?>

</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            聊天内容
            &nbsp;&nbsp;
            <span class="badge"><?= count($chat); ?></span>
            &nbsp;&nbsp;
            <?= Html::a('导出', '/res/data.xlsx', ['class' => 'btn btn-default']) ?>
        </h3>
    </div>
    <div class="panel-body">
        <div class="list-group">
            <?php foreach ($chat as $item): ?>
                <li class="list-group-item list-group-item<?= $item['from'] == $model->uid ? '-info' : '-warning'; ?>">
                    <?php if ($item['from'] != $model->uid): ?>
                    <div style="text-align: right">
                        <?php endif; ?>

                        <h5 class="list-group-item-heading">
                            <?php if ($item['from'] == $model->uid): ?>
                                <img src="<?= $model->user->icon; ?>" style="width: 30px">
                                <?php ;
                            else: ?>
                                <img src="<?= $model->doctor->user->icon; ?>" style="width: 30px">
                                <?php ;endif; ?>
                            <?= $item['from'] == $model->uid ? $model->user->name : $model->doctor->name; ?>
                            <br/>
                            <?= date('Y-m-d H:i:s', $item['timestamp'] / 1000); ?>
                        </h5>

                        <p class="list-group-item-text">
                            <?php if (strstr($item['data'], '_lcfile')): ?>
                                <img src="<?= $item['info']['_lcfile']['url']; ?>" style="width: 150px">
                                <?php ;
                            else: ?>
                                <?= $item['info']['_lctext']; ?>
                                <?php ;endif; ?>

                        </p>
                        <?php if ($item['from'] != $model->uid): ?>
                    </div>
                <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </div>
    </div>
</div>