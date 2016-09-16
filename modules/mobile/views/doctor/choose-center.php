<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/6/29
 * Time: 上午12:08
 */
?>

<?php foreach ($center as $item): ?>
<div class="kl-con selection-center-con" onclick="select(this.id)" id="<?= $item->hospital_id; ?>">
    <dl>
        <dt <?= "style=\"background: url('{$item->icon}')no-repeat center center; background-size: cover\"" ?>></dt>
        <dd>
            <h1><?= $item->name ?></h1>
            <h2>
                <span><?= $item->location ?></span>
            </h2>
        </dd>
    </dl>
</div>
<?php endforeach;?>

<script>
    function select(id) {
        $.get('/m/orders/set-hospital?user_id=<?= $user_id; ?>&hospital_id='+id, function (data) {
            window.location.href = "/m/doctor/choose-office/<?= $user_id; ?>";
        });
    }
</script>