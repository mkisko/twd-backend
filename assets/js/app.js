/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('../css/global.scss');
require('bootstrap');
require('../css/all.css');
require('../css/all.min.css');
require('../css/sb-admin-2.css');
require('../css/sb-admin-2.min.css');
require('../css/dataTables.bootstrap4.css');
require('../css/dataTables.bootstrap4.min.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

global.$ = global.jQuery = $;
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
