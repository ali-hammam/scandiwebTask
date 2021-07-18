<?php
include "./config.php";
include ROOT.'/vendor/autoload.php';
use Nesc\Router\Route;

Route::get('/displayProducts' , 'productController@display');

Route::view('/addProduct' , 'pages/addProducts.html');

Route::view('/' , 'pages/listProducts.html');

Route::post('/displayProducts' , 'productController@add');

Route::post('/deleteProducts' , 'productController@delete');

