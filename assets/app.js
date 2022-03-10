/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

 //@import "~bootstrap";

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
//import './bootstrap';
import $ from 'jquery';

// start the Stimulus application
import 'bootstrap';


import 'select2';                       // globally assign select2 fn to $ element
import 'select2/dist/css/select2.css';

import '@fortawesome/fontawesome-free/js/fontawesome'
import '@fortawesome/fontawesome-free/js/solid'
import '@fortawesome/fontawesome-free/js/regular'
import '@fortawesome/fontawesome-free/js/brands'


$('document').ready(function(){
    $('.select-poste').select2();

    $("input[type=file]").on('change', function(e){
        previewFile(this);
    });

});

function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
    //let input = e.currentTarget;
    $(input).parent().find('.custom-file-label').html(input.files[0].name);
}