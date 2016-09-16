// 5 图片接口
// 5.1 拍照、本地选图
var images = {
    localId: [],
    serverId: []
};

wx.ready(function () {
    document.querySelector('#chooseImage').onclick = function () {
        var num = 3 - images.serverId.length;
        if (num == 0) {
            alert('最多选择3张图片');
            return;
        }
        // 选择张片
        wx.chooseImage({
            count: num, // 默认3
            sizeType: ['compressed'],
            sourceType: ['album', 'camera'],
            success: function(res) {
                images.localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                wxupload();
            }
        });

    };

    // 5.3 上传图片
    function wxupload() {
        if (images.localId.length == 0) {
            alert('请先选择图片');
            return;
        }
        var i = 0, length = images.localId.length;
       // images.serverId = [];
        if(3 == (length + images.serverId.length)) $('#chooseImage').hide();
        function upload() {
            wx.uploadImage({
                localId: images.localId[i],
                success: function (res) {
                    $('#upload-photo').prepend('<div class="upload-photo-con" ><span><img src="'+images.localId[i]+'" /></span><span class="del-upload-photo" ><img src="/res/img/del-upload-photo.png"  onclick="dell(this,\''+res.serverId+'\')"/></span></div>');
                    i++;
                    images.serverId.push(res.serverId);
                    if (i < length) {
                        upload();
                    }
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        }
        upload();
    };

});

function dell(obj,serverid){
   images.serverId.splice($.inArray(serverid,images.serverId),1);
   $(obj).parent().parent().remove();
   $('#chooseImage').show();
}