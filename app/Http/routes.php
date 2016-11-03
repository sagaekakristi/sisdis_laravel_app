<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return array(
    	'code' => 1000,
    	'message' => 'Sistem Terdistribusi - Adrianus Saga Ekakristi (saga.ekakristi@gmail.com)',
    	'data' => null,
	);
});

/*
 * General group
 */
Route::group(['prefix'=>'general'], function()
{
    Route::get('/hello', 'GeneralController@hello');
    Route::get('/uptime', 'GeneralController@uptime');
    // Route::get('/demo', 'Tugas3Controller@demo');
});

/*
 * Tugas 3 group
 */
Route::group(['prefix'=>'tugas3'], function()
{
    Route::get('/klien', 'Tugas3Controller@index');
    Route::any('/server', 'Tugas3Controller@server');
    Route::any('/client', 'Tugas3Controller@client');

    Route::get('/speksaya.wsdl', function() {
        return File::get(public_path() . '/speksaya.wsdl');
    });
    
    // demo purpose only
    Route::get('/demo', 'Tugas3Controller@demo');
});

/*
 * Tugas 4 group
 */
Route::group(['prefix'=>'tugas4'], function()
{
    Route::get('/server/getImage/{filename}', 'Tugas4Controller@get_image_api');
    Route::post('/server/postImage', 'Tugas4Controller@upload_image_api');

    Route::get('/server/viewImage/{filename}', 'Tugas4Controller@view_image_direct'); // unused
    Route::get('/klien/viewImage/{filename}', 'Tugas4Controller@view_image_hit');

    Route::get('/klien/uploadImage', 'Tugas4Controller@upload_image_ui');
    Route::post('/klien/uploadImage/receiver', 'Tugas4Controller@upload_image_ui_receiver');
});

/*
 * Tugas 5 group
 */
Route::group(['prefix'=>'tugas5'], function()
{
    Route::get('/server', 'Tugas5Controller@index');
});

Route::group(['prefix'=>'ewallet'], function()
{
    Route::post('/ping', 'EWalletController@ping');
    Route::post('/register', 'EWalletController@register');
    Route::post('/getSaldo', 'EWalletController@getSaldo');
    Route::post('/getTotalSaldo', 'EWalletController@getTotalSaldo');
    Route::post('/transfer', 'EWalletController@transfer_receiver');
    Route::post('/callTransfer', 'EWalletController@transfer_caller');

    Route::group(['prefix'=>'ui'], function()
    {
        Route::get('/transfer', 'EWalletController@transfer_ui');
    });
});