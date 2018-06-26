<?php
//
//Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
//
//});
//

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::get('vfg',function(){
        return 23232;
    });
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//Route::group(['middleware' => 'auth:api'], function () {
//    Route::get('/t', function () {
//        return 'ok';
//    });
//});


//Route::prefix('auth')->group(function($router) {
//    $router->post('login', 'AuthController@login');
////    $router->get('me', 'AuthController@me');
//    $router->post('me', 'AuthController@me');
//    $router->post('logout', 'AuthController@logout');
//
//});
//
//Route::group(['middleware' => 'jwt.auth', 'providers' => 'jwt'], function ($api) {
//    $api->get('user', 'UserController@getUserInfo');
//    $api->get('test', 'UserController@test');
//});
//
//Route::middleware('refresh.token')->group(function($router) {
//    $router->get('profile','UserController@profile');
//});
