$(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true
    });
    $("div.alert").on("click", "button.close", function () {
        $(this).parent().animate({opacity: 0}, 250).hide('fast');
    });
    $("input").attr("autocomplete", "off");
});
