<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 16/7/7
 * Time: 下午12:29
 */
?>

<form id="apply" method="post">
    <div class="Re-big-box">
        <div>
            <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>姓名</b>
                            <input type="text" name="name" placeholder="" value="<?= $name ?>"/>
                        </span>
                <!--            <strong class="">错误</strong>-->
            </div>
            <!--        <div class="apply-gender clearfix">-->
            <!--            <span class="active">男</span>-->
            <!--            <span>女</span>-->
            <!--            <strong>错误</strong>-->
            <!--        </div>-->
            <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>年龄</b>
                            <input type="text" name="age" placeholder="" value="<?= $age ?>"/>
                        </span>
                <!--            <strong class="">错误</strong>-->
            </div>

            <div class="apply-text clearfix" onclick="showPic()">
                        <span class="clearfix">
                            <b>照片</b>
                            <input type="text" name="cover" id="cover" value="<?= $cover ?>" readonly/>
                        </span>
                <!--            <strong class="">错误</strong>-->
            </div>

            <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>医院</b>
                            <input type="text" name="hospital" placeholder="" value="<?= $hospital ?>"/>
                        </span>
                <!--            <strong class="">错误</strong>-->
            </div>
            <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>职称</b>
                            <input type="text" name="title" placeholder="" value="<?= $title ?>"/>
                        </span>
                <!--            <strong class="">错误</strong>-->
            </div>
            <div class="apply-text clearfix">
                        <span class="clearfix">
                            <b>工作地</b>
                            <input type="text" name="location" placeholder="" value="<?= $location ?>"/>
                        </span>
                <!--            <strong class="">错误</strong>-->
            </div>
            <div class="apply-textarea">
                <div>
                    <textarea name="desc" id="" placeholder="个人简介"><?= $desc ?></textarea>
                </div>
                <!--            <strong class="">错误</strong>-->
            </div>

            <br/>服务项目:<br/>
            <div class="select-service-con clearfix">
                <?php foreach ($service as $item): ?>
                    <a href="#" onclick="doit(this)" id="<?= $item->service_id; ?>"><?= $item->name ?></a>
                    <input type="hidden" id="service<?= $item->service_id; ?>" name="service<?= $item->service_id; ?>" value="0"/>
                <?php endforeach; ?>
            </div>
</form>
<div class="apply-button">
    <a href="#" onclick="$('#apply').submit()">申请</a>
</div>
</div>
</div>

<script>
    function doit(obj) {
        $(obj).toggleClass("active");
        if ($(obj).hasClass('active')) {
            $('#service'+obj.id).val(1);
        }else{
            $('#service'+obj.id).val(0);
        }
    }
    function showPic() {
        $(".P-upload-avatar-black").css("display", "block");
        $(".P-upload-avatar").css("display", "block");
    }

    function hidePic() {
        $(".P-upload-avatar-black").css("display", "none");
        $(".P-upload-avatar").css("display", "none");
    }
    <?php if ($error):?>
    alert('<?=$error?>');
    <?php endif;?>
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
            width: 389,
            height: 268,
            file: "#file",
            view: "#hit",
            ok: "#clipBtn",
            loadStart: function () {
                $(".P-cancel").triggerHandler("click");
                $("#tailor").css("display", "block");
                //console.log("照片读取中");
                $('.lazy_tip span').text('');
                $('.lazy_cover,.lazy_tip').show();
            },
            loadComplete: function () {
                //console.log("照片读取完成");
                $('.lazy_cover,.lazy_tip').hide();
            },
            clipFinish: function (dataURL) {
                if (dataURL == "") {
                    alert('null');
                }
                $('#loading').show();
                var img_data = dataURL.split(",");
                $.post("/m/doctor/upload-cover", {cover: img_data[1]}, function (r) {
                    var data = JSON.parse(r);
                    if (0 == data['r']) {
                        $('#cover').val(data['m']);
                    } else {
                        alert(data['m']);
                    }
                    $('#loading').hide();
                    $('.lazy_cover,.lazy_tip,.pic_edit').hide();
                    return false;
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