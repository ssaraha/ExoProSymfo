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

$('document').ready(function(){
    $('.select-poste').select2();
});
