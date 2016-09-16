var carousel = (function(){
    function init(){
        TouchSlide({
            slideCell:"#tabBox",
            titCell:".hd ul",
            mainCell:".slider_bd ul",
            effect:"leftLoop",
            autoPage:true,
            autoPlay:true,
            delayTime:1000, /*毫秒；切换效果持续时间（执行一次效果用多少毫秒）。*/
            interTime:3000  /*毫秒；自动运行间隔（隔多少毫秒后执行下一个效果）*/
        });
    }
    return{
        init:init
    }
})();
carousel.init();