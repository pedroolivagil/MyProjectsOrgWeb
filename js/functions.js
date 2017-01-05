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

///////////////////////
// onLoad()
$(document).ready(function () {
    navigate('templates/header', 'header_wrapper');
    navigate('templates/home');
    navigate('templates/footer', 'footer_wrapper');
})