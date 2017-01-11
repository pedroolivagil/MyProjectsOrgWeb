$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true
    });
    var fixmeTop = $('.fixonscroll').offset().top;
    $(document).scroll(function () {
        var currentScroll = $(document).scrollTop() + 50;
        if (currentScroll >= fixmeTop) {
            $('.fixonscroll').css({
                position: 'fixed',
                top: '50px'
            });
        } else {
            $('.fixonscroll').css({
                position: 'static'
            });
        }
    });
});
