<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/28
 * Time: 下午5:03
 */
?>

<div class="wrapper">
    <div class="selection-device-top">
        <div class="medical-records-main-top clearfix">
            <h1>选择日期时间</h1>
            <ul class="clearfix">
                <li>您当前所在位置：</li>
                <li>首页 &gt; </li>
                <li>订单 &gt; </li>
                <li>选择日期时间</li>
            </ul>
        </div>
    </div>

    <div class="selection-center-main clearfix">
        <div class="selection-center-con clearfix" style="text-align: center">
            <label for="date">预约时间:</label>
            <input type="text" id="appoint_date" class="laydate-icon" onclick="laydate()"/>
        </div>
    </div>
    <div class="select-service-main clearfix">
        <ul class="select-service-ul clearfix">
            <?php foreach (\app\models\Office::$time_section as $id => $name): ?>
                <li><a href="#" onclick="select(this.id)" id="<?= $id; ?>"><?= $name ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
    function select(id) {
        var appoint_date = $('#appoint_date').val();
        if (appoint_date == '') {
            alert("请选择日期");
            return false;
        }
        $.get('/m/orders/set-date?user_id=<?= $user_id; ?>&section_id=' + id + '&adate=' + appoint_date, function (data) {
            window.location.href = "/doctor/buy/<?= $user_id; ?>";
        });
    }
</script>