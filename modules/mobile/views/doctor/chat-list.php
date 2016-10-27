<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/5/10
 * Time: 下午8:37
 */
?>

<div class="H-main-top">
    <p class="clearfix">
        <span><img src="/res/img/seach-imgs.png" alt=""/></span>
        <span>
            <input type="text" id="keyword" placeholder="搜索" value="<?= isset($keyword) ? $keyword : '' ?>" onkeypress="search()" />
        </span>
    </p>
</div>

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

<script>

    function search() {
        var word = $('#keyword').val();
        var url = '';
        if (word != '') {
            url = 'http://' + window.location.host + '/m/doctor/chat-list/' + word;
        }else{
            url = 'http://' + window.location.host + '/m';
        }
        window.location.href = url;
        return false;
    }

    function pressEnter() {
        if (window.event.keyCode == 13) {
            search();
            return false;
        }
    }

</script>
