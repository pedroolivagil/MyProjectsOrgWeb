// Generic functions 
function showAlert(title, texto) {
    $('#modal_generic_btn').click();
    $('.modal-title').html(title);
    $('.modal-body p').html(texto);
}


function showAlertDelete(itemName, itemID, action) {
    $('#modal_delete_btn').click();
    $('#modal-delete .modal-body p > strong').html(itemName);
    $('#modal-delete .modal-body input#id').val(itemID);
    $('#modal-delete .modal-body form').attr('action', action);
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


    loadGallery(true, 'a.preview');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
        $('#show-previous-image, #show-next-image').show();
        if (counter_max == counter_current) {
            $('#show-next-image').hide();
        } else if (counter_current == 1) {
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
        var current_image,
                selector,
                counter = 0;

        $('#show-next-image, #show-previous-image').click(function () {
            if ($(this).attr('id') == 'show-previous-image') {
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if (setIDs == true) {
            $('[data-image-id]').each(function () {
                counter++;
                $(this).attr('data-image-id', counter);
            });
        }
        $(setClickAttr).on('click', function () {
            updateGallery($(this));
        });
    }
});
