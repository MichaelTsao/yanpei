<div class="chat-con-top">
    <p>
        <a href="javascript:history.back()">返回</a>
        <a href="/m/case/list<?php if (!$other->doctor) {
            echo "/" . $other->uid;
        } ?>">
            <span>查看病历</span>
        </a>
        <?php if (!$order): ?>
            <?php if (Yii::$app->user->getIdentity()->doctor): ?>
                <a href="/m/doctor/buy/<?= $other->uid ?>">
                    <span>下单</span>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <a href="/m/orders/info/<?= $order->order_id ?>">
                <span>查看订单</span>
            </a>
        <?php endif; ?>
    </p>
</div>

<div id="wrapper" style="top: 50px; bottom: 51px">
    <div class="scroller">
        <div class="C-con-dialogue" id="dialog"></div>
    </div>
</div>
<footer>
    <div class="C-con-footer">
        <p>
            <span><input type="text" id="msg" placeholder="输入聊天内容"/></span>
            <span>
                图片
                <input type="file" id="img" onchange="sendImg()" class="fileInput hidden">
            </span>
            <span onclick="send()">发送</span>
        </p>
    </div>
</footer>

<!--<script src="/js/public/AV.realtime.js"></script>-->
<script src="/js/node_modules/leancloud-storage/dist/av.js"></script>
<script src="/js/node_modules/leancloud-realtime/dist/realtime.browser.js"></script>
<script src="/js/node_modules/leancloud-realtime-typed-messages/dist/typed-messages.js"></script>
<script src="/js/public/jsrender.min.js"></script>
<script src="/js/public/chat.js"></script>

<!-- 本人说话气泡模板 -->
<script id="mine" type="text/x-jsrender">
<div class="C-right-dialogue clearfix">
    <div class="C-right-dialogue-img" <?= "style=\"background: url('{$me->icon}')no-repeat center center; background-size: cover\"" ?>></div>
        <div class="C-right-dialogue-content-big">
        <div style="float: right;"><?=$me->name?></div>
        <div class="C-right-dialogue-content">
            <p>{{:msg}}</p>
        </div>
    </div>
</div>
</script>

<!-- 对方说话气泡模板 -->
<script id="other" type="text/x-jsrender">
<div class="C-left-dialogue clearfix">
    <div class="C-left-dialogue-img" <?= "style=\"background: url('{$other->icon}')no-repeat center center; background-size: cover\"" ?>></div>
    <div><?=$other->name?></div>
    <div class="C-left-dialogue-content">
        <p>{{:msg}}</p>
    </div>
</div>
</script>

<!-- 时间气泡模板 -->
<script id="date_time" type="text/x-jsrender">
<div class="C-dialogue-time">
    <span>{{:time}}</span>
</div>
</script>

<script>
    function send() {
        var msg = $('#msg');
        var content = msg.val();
        chat.send(content);
        msg.val('');
        msg.focus();

        $.get('<?= \yii\helpers\Url::to(['/m/doctor/talk', 'chat_id' => $chat_id]);?>&msg=' + content);

        var dialog = $("#dialog");
        var date = chat.format_date($.now());
        if (date != last_date) {
            dialog.append(date_time({'time': date}));
            last_date = date;
        }
        dialog.append(mine({'msg': content}));

        myScroll.refresh();
        myScroll.scrollTo(0, myScroll.maxScrollY, 0);
    }

    function sendImg() {
        chat.sendImg('img');
        $.get('<?= \yii\helpers\Url::to(['/m/doctor/talk', 'chat_id' => $chat_id]);?>&msg=[图片]');
        myScroll.refresh();
        myScroll.scrollTo(0, myScroll.maxScrollY, 0);
    }

    // 显示消息
    var mine = $.templates('#mine');
    var other = $.templates('#other');
    var date_time = $.templates('#date_time');
    var last_date = '';
    function set_message(event, data) {
        var begin = false;
        if ($("#dialog").html() == '') {
            begin = true;
        }
        for (var i = data.length - 1; i >= 0; i--) {
            var message = data[i];
            var date = chat.format_date(message.timestamp);
            var content = '';
            if (typeof message.content === 'string') {
                content = message.content;
            } else {
                var file;
                switch (message.type) {
                    case AV.TextMessage.TYPE:
                        content = message.getText();
                        console.log('收到文本消息， text: ' + message.getText() + ', msgId: ' + message.id);
                        break;
                    case AV.FileMessage.TYPE:
                        file = message.getFile(); // file 是 AV.File 实例
                        console.log('收到文件消息，url: ' + file.url() + ', size: ' + file.metaData('size'));
                        break;
                    case AV.ImageMessage.TYPE:
                        file = message.getFile();
//                        content = "<img src='" + file.url() + "' width='200px' onload='refreshScroll()'>";
                        content = '<a href="'+ file.url() +'" data-lightbox="image-1">' +
                            '<img src="' + file.url() + '" width="200px" onload="refreshScroll()"></a>';
                        console.log('收到图片消息，url: ' + file.url() + ', width: ' + file.metaData('width'));
                        break;
                    case AV.AudioMessage.TYPE:
                        file = message.getFile();
                        console.log('收到音频消息，url: ' + file.url() + ', width: ' + file.metaData('duration'));
                        break;
                    case AV.VideoMessage.TYPE:
                        file = message.getFile();
                        console.log('收到视频消息，url: ' + file.url() + ', width: ' + file.metaData('duration'));
                        break;
                    case AV.LocationMessage.TYPE:
                        var location = message.getLocation();
                        console.log('收到位置消息，latitude: ' + location.latitude + ', longitude: ' + location.longitude);
                        break;
                    default:
                        console.warn('收到未知类型消息');
                }
            }
            if (message.from == "<?= $me->uid ?>") {
                $("#dialog").prepend(mine({'msg': content}));
            } else {
                $("#dialog").prepend(other({'msg': content}));
            }
            if (date != last_date) {
                $("#dialog").prepend(date_time({'time': date}));
                last_date = date;
            }
        }
        $("#dialog").prepend('<div>&nbsp;</div>');
        $("#dialog").prepend(date_time({'time': '<span onclick="chat.more(this)">显示更多信息</span>'}));
        refreshScroll();
        if (begin) {
            myScroll.scrollTo(0, myScroll.maxScrollY, 0);
        }
    }

    function new_message(event, data) {
        for (var i = data.length - 1; i >= 0; i--) {
            var message = data[i];
            var date = chat.format_date(message.timestamp);
            var content = '';
            if (typeof message.content === 'string') {
                content = message.content;
            } else {
                var file;
                switch (message.type) {
                    case AV.TextMessage.TYPE:
                        content = message.getText();
                        console.log('收到文本消息， text: ' + message.getText() + ', msgId: ' + message.id);
                        break;
                    case AV.FileMessage.TYPE:
                        file = message.getFile(); // file 是 AV.File 实例
                        console.log('收到文件消息，url: ' + file.url() + ', size: ' + file.metaData('size'));
                        break;
                    case AV.ImageMessage.TYPE:
                        file = message.getFile();
                        content = "<img src='" + file.url() + "' width='200px' onload='refreshScroll()'>";
                        console.log('收到图片消息，url: ' + file.url() + ', width: ' + file.metaData('width'));
                        break;
                    case AV.AudioMessage.TYPE:
                        file = message.getFile();
                        console.log('收到音频消息，url: ' + file.url() + ', width: ' + file.metaData('duration'));
                        break;
                    case AV.VideoMessage.TYPE:
                        file = message.getFile();
                        console.log('收到视频消息，url: ' + file.url() + ', width: ' + file.metaData('duration'));
                        break;
                    case AV.LocationMessage.TYPE:
                        var location = message.getLocation();
                        console.log('收到位置消息，latitude: ' + location.latitude + ', longitude: ' + location.longitude);
                        break;
                    default:
                        console.warn('收到未知类型消息');
                }
            }
            if (date != last_date) {
                $("#dialog").append(date_time({'time': date}));
                last_date = date;
            }
            if (message.from == "<?= $me->uid ?>") {
                $("#dialog").append(mine({'msg': content}));
            } else {
                $("#dialog").append(other({'msg': content}));
            }
        }
        refreshScroll();
        myScroll.scrollTo(0, myScroll.maxScrollY, 0);
    }

    function refreshScroll() {
        myScroll.refresh();
    }

    // 设置聊天类
    var chat = new Chat("<?= Yii::$app->params['lean_cloud_id'] ?>", "<?= $me->uid ?>", "<?= Yii::$app->params['lean_cloud_key'] ?>");
    chat.callback.on('new-message', set_message);
    chat.callback.on('send-message', new_message);
    chat.chat("<?= $chat_id ?>");
</script>