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