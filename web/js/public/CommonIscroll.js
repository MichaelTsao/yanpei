var CommonIscroll=(function(){
    setTimeout(function(){
      refreshScroll();
    },1000);
    function init(){
        myScroll = new IScroll('#wrapper',{
            //disableMouse: true,
            //disablePointer: true,
            scrollbars: 'custom',
            mouseWheel: true,
            interactiveScrollbars: true,
            shrinkScrollbars: 'scale',
            snapSpeed: 350,
            keyBindings: true,
            fadeScrollbars: true,
           /* probeType:false,*/
            click:true
        });

        document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
    }
    function refreshScroll(){
        myScroll.refresh();
    }
    return{
        init:init,
        refreshScroll:refreshScroll
    }
})();
CommonIscroll.init();

