// Generic functions 
function showAlert(title, texto) {
    debugger;
    $('#modal_generic_btn').click();
    $('#modal_generic_btn').on('show.bs.modal', function (event) {
        var modal = $(this);
        modal.find('.modal-title').html(title);
        modal.find('.modal-body p').html(texto);
    });
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
