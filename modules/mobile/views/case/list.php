<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/28
 * Time: 下午2:36
 */
?>
<?php foreach ($data as $item): ?>
    <div class="case-list-con" onclick="window.location.href='/m/case/info/<?= $item->case_id; ?>'">
        <dl>
            <dt <?= "style=\"background: url('{$item->user->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
            <dd>
                <h1><?= $item->user->name ?></h1>
                <h2>
                    <span>创建时间：</span>
                    <span><?= $item->ctime ?></span>
                </h2>
                <h2 style="margin-top: 5px;">
                    <span>创建人：</span>
                    <span><?= ($item->doctor_id) ? $item->doctor->name : '本人' ?></span>
                </h2>
            </dd>
            <?php if(!Yii::$app->user->identity->doctor || $item->doctor_id == Yii::$app->user->id): ?>
            <span class="place-order-cross" onclick="removeCase(this.id); event.stopPropagation();"
                  id="<?= $item->case_id; ?>"></span>
            <?php endif;?>
        </dl>
    </div>
<?php endforeach; ?>

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
