<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/16
 * Time: 上午1:17
 */
?>

<a href="<?= \yii\helpers\Url::to(['data/share', 'type' => 'article', 'id' => $id]) ?>">
    <img src="/images/share.png" style="width: 20px; float: right">
</a>

<iframe id="article-container" src="/m/data/content/<?=$id?>" width="100%" height="600px"></iframe>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
