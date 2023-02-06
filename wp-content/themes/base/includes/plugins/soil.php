<?php

/*
|--------------------------------------------------------------------------
| Soil
|--------------------------------------------------------------------------
|
| WordPress plugin which contains a collection of modules to apply
| modifications most out of WordPress development.
|
| Please see https://github.com/roots/soil
|
*/

add_theme_support('soil', [
    'clean-up',
    // 'disable-rest-api',
    // 'disable-asset-versioning',
    'disable-trackbacks',
    // 'google-analytics' => 'UA-XXXXX-Y',
    'js-to-footer',
    // 'nav-walker',
    'nice-search',
    'relative-urls'
]);
