/**
 * Created by caoxiang on 16/1/13.
 */

Date.prototype.format = function (formatStr) {
    var str = formatStr;
    if (!formatStr) {
        str = "yyyy-MM-dd hh:mm:ss"; //默认格式
    }
    var Week = ['日', '一', '二', '三', '四', '五', '六'];

    str = str.replace(/yyyy|YYYY/, this.getFullYear());
    str = str.replace(/yy|YY/, (this.getYear() % 100) > 9 ? (this.getYear() % 100).toString() : '0' + (this.getYear() % 100));

    str = str.replace(/MM/, this.getMonth() >= 9 ? (parseInt(this.getMonth()) + 1).toString() : '0' + (parseInt(this.getMonth()) + 1));
    str = str.replace(/M/g, (parseInt(this.getMonth()) + 1));

    str = str.replace(/w|W/g, Week[this.getDay()]);

    str = str.replace(/dd|DD/, this.getDate() > 9 ? this.getDate().toString() : '0' + this.getDate());
    str = str.replace(/d|D/g, this.getDate());

    str = str.replace(/hh|HH/, this.getHours() > 9 ? this.getHours().toString() : '0' + this.getHours());
    str = str.replace(/h|H/g, this.getHours());
    str = str.replace(/mm/, this.getMinutes() > 9 ? this.getMinutes().toString() : '0' + this.getMinutes());
    str = str.replace(/m/g, this.getMinutes());

    str = str.replace(/ss|SS/, this.getSeconds() > 9 ? this.getSeconds().toString() : '0' + this.getSeconds());
    str = str.replace(/s|S/g, this.getSeconds());

    str = str.replace(/iii/g, this.getMilliseconds() < 10 ? '00' + this.getMilliseconds() : (this.getMilliseconds() < 100 ? '0' + this.getMilliseconds() : this.getMilliseconds()));

    return str;
}

function Chat(app_id, client_id, app_key) {
    this.callback = $({});
    this.room = null;
    this.msgIter = null;
    this.client_id = client_id;
    AV.initialize(app_id, app_key);
    this.rt = new AV.Realtime({
        appId: app_id,
        region: 'cn'
    });
    this.rt.register([AV.FileMessage, AV.ImageMessage, AV.AudioMessage, AV.VideoMessage, AV.LocationMessage]);
    this.rt.createIMClient(client_id);

    this.chat = function (room_id) {
        var self = this;
        this.room_id = room_id;
        Cookies.remove('unread:' + room_id);

        this.rt.createIMClient(this.client_id).then(function (me) {
            me.on('message', function (message, conversation) {
                if (conversation.id == self.room_id) {
                    self.callback.trigger('send-message', [[message]]);
                    console.log('Message received: ' + message.type);
                }
            });

            return me.getConversation(self.room_id);
        }).then(function (conversation) {
            self.room = conversation;
            self.msgIter = conversation.createMessagesIterator({
                limit: 10 // limit 取值范围 1~1000，默认 20
            });
            self.msgIter.next().then(function (result) {
                var messages = result.value;
                self.callback.trigger('new-message', [messages]);
            }).catch(console.error.bind(console));
        }).catch(console.error);
    };

    this.more = function (obj) {
        var self = this;
        self.msgIter.next().then(function (result) {
            var messages = result.value;
            self.callback.trigger('new-message', [messages]);
        }).catch(console.error.bind(console));
        $(obj).parent().hide();
    };

    this.send = function (msg) {
        if (msg == '') {
            effect.ShowError('请输入聊天内容');
            return;
        }
        if (this.room == null) {
            return;
        }
        var text = new AV.TextMessage(msg);
        this.room.send(text);
        // this.callback.trigger('send-message', [[text]]);
    };

    this.sendImg = function (name) {
        var self = this;

        if (this.room == null) {
            console.log('room is null');
            return;
        }

        var fileUploadControl = $('#' + name)[0];
        var file = new AV.File('avatar.jpg', fileUploadControl.files[0]);
        file.save().then(function () {
            var message = new AV.ImageMessage(file);
            message.from = self.client_id;
            // message.setText(msg);
            // message.setAttributes({location: '旧金山'});
            self.callback.trigger('send-message', [[message]]);
            return self.room.send(message);
        }).then(function () {
            console.log('发送成功');
        }).catch(console.error.bind(console));
    };

    this.set_unread = function () {
        var c = Cookies.get();
        for (var key in c) {
            if (key.substr(0, 7) == 'unread:') {
                var cid = key.substr(7);
                var obj = $("#icon_" + cid);
                if (obj) {
                    obj.html("<span>" + c[key] + "</span>");
                }
            }
        }
    };

    this.get_unread = function () {
        var c = Cookies.get();
        var all = 0;
        for (var key in c) {
            if (key.substr(0, 7) == 'unread:') {
                all += parseInt(c[key]);
            }
        }
        return all;
    };

    this.unread = function () {
        var self = this;
        //监听所有 Conversation 中发送的消息
        this.rt.on('message', function (data) {
            console.log(data);
            if (data.msg == 'DAKASHUO:done:$$$') {
                return;
            }
            var key = 'unread:' + data.cid;
            var count = Cookies.get(key);
            if (typeof count === "undefined") {
                count = 0;
            }
            count = parseInt(count) + 1;
            Cookies.set(key, count);
            self.callback.trigger('send-message', [data]);
        });
    };

    this.format_date = function (timestamp) {
        if (timestamp != "") {
            var now = new Date();
            var f = '';
            if (timestamp >= new Date(now.getFullYear(), now.getMonth(), now.getDate())) {
                f = "hh:mm";
            } else if (timestamp >= new Date(now.getFullYear(), 0, 1)) {
                f = "MM月dd日 hh:mm";
            } else {
                f = "yyyy年MM月dd日 hh:mm";
            }
            return new Date(timestamp).format(f);
        } else {
            return "";
        }
    };
}