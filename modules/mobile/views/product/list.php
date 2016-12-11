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

<div class="H-main-top">
    <p class="clearfix">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        品牌：<?= \yii\bootstrap\Html::dropDownList('brand', isset($brand) ? $brand : null,
            [0 => '全部'] + \app\models\Brand::getList(), ['id' => 'brand']); ?>
        &nbsp;
        电池：<?= \yii\bootstrap\Html::dropDownList('battery', isset($battery) ? $battery : null,
            [0 => '全部'] + \app\models\Product::getBattery(), ['id' => 'battery']); ?>
        &nbsp;
        价格：<?= \yii\bootstrap\Html::dropDownList('price', isset($price) ? $price : null,
            [0 => '全部'] + \app\models\Product::$priceSection, ['id' => 'price']); ?>
        &nbsp;
        <?= \yii\bootstrap\Html::button('筛选', ['onclick' => 'search()']); ?>
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
<?php endif; ?>

<script>
    function search() {
        var word = $('#keyword').val();
        var brand = $('#brand').val();
        var battery = $('#battery').val();
        var price = $('#price').val();
        var url = 'http://' + window.location.host + '/m/product/list';
        var param = [];

        if (word != '') {
            param.push('keyword=' + word);
        }
        if (brand != 0) {
            param.push('brand=' + brand);
        }
        if (battery != 0) {
            param.push('battery=' + battery);
        }
        if (price != 0) {
            param.push('price=' + price);
        }

        if (param.length > 0) {
            url += '?' + param.join('&');
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
