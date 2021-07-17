<?php
include "../config.php";
include ROOT.'/vendor/autoload.php';
use Nesc\Router\Route;


Route::get('/about' , function (){
    print_r(json_encode(['aaa' => 'bbbb' , 'cccc' => 'ddd']));
});

Route::get('/ali' , function (){
    echo 'aldsavczi ';
});

Route::get('/conn' , 'example@hi');

Route::get('/eco' , 'example@display');

Route::get('/user' , 'User/UserTest@hello');

Route::get('/phones' , 'example@displayPhones');

Route::get('/hammam' , 'User/Test/Test@classFormat');

Route::post('/person/insert' , 'example@insertPerson');

Route::get('/displayProducts' , 'productController@display');

//Route::get('/addProduct' , 'productController@addProductForm');

Route::view('/addProduct' , 'pages/addProducts/addProducts.html');

Route::view('/listProducts' , 'pages/listProducts/listProducts.html');

Route::post('/displayProducts' , 'productController@add');

Route::post('/deleteProducts' , 'productController@delete');

