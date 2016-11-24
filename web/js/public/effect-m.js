var effect=(function(){
    function init(){
    }
    function other(){
        $(".apply-audi-sex a").click(function(){
            $(this).addClass("sex_active").siblings().removeClass("sex_active");
        });
        $(".select-service-ul li a").click(function(){
           $(this).addClass("active").parent().siblings().children().removeClass("active");
        });
        $(".product-display-box").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        });
        $(".H-nav-right-ul li a").click(function(){
            $(this).addClass("active").parent().siblings().children().removeClass("active");
        });
    }
    /*控制弹出框显示在屏幕中心--代码--start*/
    function showDiv(obj,obj2){
        $(obj).show();
        $(obj2).show();
        center(obj);
    }
    function center(obj){
        var windowWidth = document.documentElement.clientWidth;
        var windowHeight = document.documentElement.clientHeight;
        var popupHeight = $(obj).height();
        var popupWidth = $(obj).width();
        $(obj).css({
            "position": "fixed",
            "zIndex":"16",
            "top": (windowHeight-popupHeight)/2,
            "left": (windowWidth-popupWidth)/2
        });
    }
    /*控制弹出框显示在屏幕中心--代码--end*/
    return{
        init:init
    }
})();
effect.init();

function time(o, sec) {
    if (sec == 0) {
        o.removeAttribute("disabled");
        o.value = "获取验证码";
    } else {
        o.setAttribute("disabled", true);
        // o.style.background="#d9d9d9";
        o.value = sec + "秒后重新获取";
        sec--;
        setTimeout(function () {
            time(o, sec)
        }, 1000)
    }
}

function sendSMS(phone, type, e) {
    var url = '/m/default/send-sms?phone=' + phone + '&type=' + type;
    $.get(url, function (data) {
        if (data != 'ok') {
            alert(data);
            //effect.ShowError(data);
        } else {
            time(e, 60);
        }
    });
}
