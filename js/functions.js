/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function navigate(page, id) {
    if (id == null) {
        id = 'section#main_wrapper';
    } else {
        id = '#' + id;
    }
    $(document).ready(function () {
        $(id).load(page + '.php');
    });
}

function showAlertClosable(string, type) {
    $(document).ready(function () {
        var text = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + string + '</div>';
    });
}

///////////////////////
// onLoad()
$(document).ready(function () {
    navigate('templates/header', 'header_wrapper');
    navigate('templates/home');
    navigate('templates/footer', 'footer_wrapper');
})