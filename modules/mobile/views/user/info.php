<div class="DataSetup">
    <h1>业务信息</h1>
    <ul>
        <li class="P-Full-Name">
            <a href="/m/orders/list">
                <span>我的订单</span>
                <span class="P-Ellipsis"></span>
            </a>
        </li>
        <li class="P-Full-Name">
            <a href="/m/doctor/favorite">
                <span>我收藏的验配师</span>
                <span class="P-Ellipsis"></span>
            </a>
        </li>
        <li class="P-Full-Name">
            <a href="/m/case/list">
                <span>我的病历</span>
                <span class="P-Ellipsis"></span>
            </a>
        </li>
    </ul>
</div>
<div class="AccountSetup">
    <h1>账户设置</h1>
    <ul>
        <li class="P-PhoneNumber">
            <a href="/m/user/change-phone">
                <span>手机号码</span>
                <span><?= substr_replace($user->phone, '*****', 3, 5) ?></span>
            </a>
        </li>
        <li class="P-Password">
            <a href="/m/user/change-password">
                <span>密码</span>
                <span>********</span>
            </a>
        </li>
    </ul>
</div>
<div class="DataSetup">
    <h1>个人资料设置</h1>
    <ul>
        <li class="P-change-avatar" onclick="showPic()">
            <span>修改头像</span>
            <span class="HeadPortrait P-Ellipsis">
                 <b style="background: url('<?= $user->icon ?>') no-repeat center center; background-size: cover"></b>
            </span>
        </li>
        <li class="P-Full-Name">
            <a href="/m/user/change-name">
                <span>姓名</span>
                <span class="P-Ellipsis"><?= $user->name ?></span>
            </a>
        </li>
        <li class="P-Full-Name">
            <a href="/m/user/change-gender">
                <span>性别</span>
                <span class="P-Ellipsis"><?= $user->gender == \app\models\User::GENDER_FEMALE ? '女' : '男' ?></span>
            </a>
        </li>
    </ul>
</div>

<?php if (!Yii::$app->user->getIdentity()->doctor): ?>
    <div class="personal-center-btn1">
        <a href="/m/doctor/apply">申请成为验配师</a>
    </div>
<?php endif; ?>

<div class="personal-center-btn2">
    <a href="/m/user/logout">退出登录</a>
</div>

<script>
    function showPic() {
        $(".P-upload-avatar-black").css("display", "block");
        $(".P-upload-avatar").css("display", "block");
    }

    function hidePic() {
        $(".P-upload-avatar-black").css("display", "none");
        $(".P-upload-avatar").css("display", "none");
    }
</script>

<!--上传头像-->
<div class="P-upload-avatar-black"></div>
<div class="P-upload-avatar">
    <p>
        上传
        <input type="file" id="file" class="upload_icon_button" accept="image/*"/>
    </p>
    <p class="P-cancel" onclick="hidePic()">取消</p>
</div>

<link rel="stylesheet" href="/css/tailor.css?v=2">
<div id="tailor" style="display: none">
    <!--加载资源-->
    <div class="lazy_tip" id="lazy_tip"><span>1%</span><br> 载入中......</div>
    <div class="lazy_cover"></div>
    <div class="resource_lazy hide"></div>
    <div class="pic_edit">
        <div id="clipArea"></div>
        <input type="button" id="upload2" value=" 取 消 ">
        <input type="button" id="clipBtn" value="上传图片">
    </div>

    <img src="" fileName="" id="hit" style="display:none;z-index: 9">

    <script src="/js/public/jquery-2.1.0.min.js"></script>
    <script src="/js/public/sonic.js"></script>
    <script src="/js/public/comm.js"></script>
    <script src="/js/public/hammer.js"></script>
    <script src="/js/public/iscroll-zoom.js"></script>
    <script src="/js/public/jquery.photoClip.js?v=1"></script>
    <script>
        var hammer = '';
        var currentIndex = 0;

        $("#clipArea").photoClip({
            width: 200,
            height: 200,
            file: "#file",
            view: "#hit",
            ok: "#clipBtn",
            loadStart: function () {
                $(".P-cancel").triggerHandler("click");
                $("#tailor").css("display", "block");
                console.log("照片读取中");
                $('.lazy_tip span').text('');
                $('.lazy_cover,.lazy_tip').show();
            },
            loadComplete: function () {
                console.log("照片读取完成");
                $('.lazy_cover,.lazy_tip').hide();
            },
            clipFinish: function (dataURL) {
                console.log(dataURL);
                if (dataURL == "") {
                    alert('null');
                }
                $('#loading').show();
                var img_data = dataURL.split(",");
                $.post("/m/user/change-icon", {icon: img_data[1]}, function (data) {
                    console.log(data);
                    if ('ok' == data) {
                        window.location.reload();
                    } else {
                        alert(data);
                        $('#loading').hide();
                        return false;
                    }
                });
            }
        });

        /*获取文件拓展名*/
        function getFileExt(str) {
            var d = /\.[^\.]+$/.exec(str);
            return d;
        }

        //图片上传结束
        $(function () {
            $("#upload2").click(function () {
                $("#tailor").css("display", "none");
            });
        })

    </script>
</div>
<div class="rotate" id="loading"></div>

