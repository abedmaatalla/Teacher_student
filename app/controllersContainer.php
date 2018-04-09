<?php 


$container['HomeController'] = function ($c) {
    return new App\Controllers\HomeController($c);
};

$container['UserController'] = function ($c) {
    return new App\Controllers\UserController($c);
};

$container['AdminController'] = function ($c) {
    return new App\Controllers\AdminController($c);
};

$container['AuthController'] = function ($c) {
    return new App\Controllers\AuthController($c);
};

$container['DocController'] = function ($c) {
    return new App\Controllers\DocController($c);
};

$container['ContactController'] = function ($c) {
    return new App\Controllers\ContactController($c);
};

$container['SearchController'] = function ($c) {
    return new App\Controllers\SearchController($c);
};

$container['UploadController'] = function ($c) {
    return new App\Controllers\UploadController($c);
};

$container['CategoryController'] = function ($c) {
    return new App\Controllers\CategoryController($c);
};

