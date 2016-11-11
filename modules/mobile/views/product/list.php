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
            <input type="text" id="keyword" placeholder="搜索" value="<?= isset($keyword) ? $keyword : '' ?>"
                   onkeypress="pressEnter()"/>
        </span>
    </p>
</div>

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
    <?= ''//$this->render('/template/page', ['data' => $data]);   ?>
<?php endif; ?>

<script>
    function search() {
        var word = $('#keyword').val();
        var url = '';
        if (word != '') {
            url = 'http://' + window.location.host + '/m/product/list?keyword=' + word;
        } else {
            url = 'http://' + window.location.host + '/m/product/list';
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
