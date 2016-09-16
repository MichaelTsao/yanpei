<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/13
 * Time: 下午10:02
 */
?>

<div style="margin-left: 20px; margin-top: 20px;">
    <label for="date">预约时间:</label>
    <input type="text" id="appoint_date" class="laydate-icon" onclick="laydate()"/>
</div>

<div class="select-service-con clearfix">
    <?php foreach (\app\models\Office::$time_section as $id => $name): ?>
        <a href="#" onclick="select(this.id)" id="<?= $id; ?>"><?= $name ?></a>
    <?php endforeach; ?>
</div>

<script>
    function select(id) {
        var appoint_date = $('#appoint_date').val();
        if (appoint_date == '') {
            alert("请选择日期");
            return false;
        }
        $.get('/m/orders/set-order-date?order_id=<?= $order_id; ?>&section_id=' + id + '&adate=' + appoint_date, function (data) {
            window.location.href = "/m/orders/change/<?= $order_id; ?>";
        });
    }
</script>
