// Generic functions 
function showAlert(title, texto) {
    $('#modal_generic_btn').click();
    $('.modal-title').html(title);
    $('.modal-body p').html(texto);
}

// OnLoad
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
