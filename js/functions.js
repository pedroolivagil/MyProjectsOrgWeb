// Generic functions 
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

function showAlert(title, texto) {
    $('#modal_generic_btn').click();
    $('.modal-title').html(convertStringDBToHTML(title));
    $('.modal-body p').html(convertStringDBToHTML(texto));
}

function showAlertDelete(itemName, itemID, action) {
    $('#modal_delete_btn').click();
    $('#modal-delete .modal-body p > strong').html(convertStringDBToHTML(itemName));
    $('#modal-delete .modal-body input#id').val(itemID);
    $('#modal-delete .modal-body form').attr('action', action);
}

function clickElement(id) {
    $("#" + id).click();
}
function scrollBottom() {
    $("html, body").animate({scrollTop: $(document).height() - $(window).height()});
}
function scrollBottom(id) {
    $("#" + id).animate({scrollTop: $("#" + id)[0].scrollHeight});
}
function convertStringDBToHTML(string) {
    return string.replace(/{/gi, '<').replace(/}/gi, '>');
}

function validateInputFiles(id, maxfiles, title, msg) {
    var fileUpload = $("#" + id);
    if (parseInt(fileUpload.get(0).files.length) > maxfiles) {
        showAlert(title, msg.replace('[MAX]', maxfiles));
        return false;
    } else {
        return true;
    }
}
function printPreviewImage(titleAlert, msg, input, divID, title) {
    var countFiles = $(input)[0].files.length;
    var imgPath = $(input)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#" + divID);
    var maxWH = 100;
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        image_holder.empty();
        image_holder.append('<h5>' + title + '</h5>');
        if (typeof (FileReader) != "undefined") {
            //loop for each file selected for uploaded.
            for (var i = 0; i < countFiles; i++) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $("<img />", {
                        "src": e.target.result,
                        "class": "thumbnail inline mar5"
                    });
                    img.load(function () {
                        var w = $(this).width();
                        var h = $(this).height();
                        if (w > h) {
                            $(this).width(maxWH);
                            $(this).height(resizeImgWH(w, h, maxWH));
                        } else if (h > w) {
                            $(this).height(maxWH);
                            $(this).width(resizeImgWH(h, w, maxWH));
                        } else {
                            $(this).width(maxWH);
                            $(this).height(maxWH);
                        }
                        console.log($(this).width() + 'x' + $(this).height());
                    });
                    img.appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(input)[0].files[i]);
            }
        } else {
            // Navigator not suported FileReader
            $(input).val('');
            showAlert(titleAlert, msg);
        }
    } else {
        // Select images only
        $(input).val('');
        showAlert(titleAlert, msg);
    }
}

function resizeImgHW(altoOriginal, anchoOriginal, altoDeseado) {
    return (altoDeseado * anchoOriginal) / altoOriginal;
}
function resizeImgWH(anchoOriginal, altoOriginal, anchoDeseado) {
    return (anchoDeseado * altoOriginal) / anchoOriginal;
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
    $('[data-toggle="tooltip"]').tooltip({animation: true});

    loadGallery(true, 'a.preview');
});
