$(document).ready(function() {
    $(".slideInner").slide({
        slideContainer: $('.slideInner a'),
        /* preload: true,*/
        effect: 'easeOutCirc',
        autoRunTime: 2000,
        slideSpeed: 800,
        hoverPause: true,
        nav: true,
        autoRun: true,
        prevBtn: $('a.prev'),
        nextBtn: $('a.next')
    })
})