<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('me', 'User\MeController@getMe');
    Route::get('reported-cases', 'ReportedCaseController@index');
    Route::get('reported-cases/region', 'ReportedCaseController@regionTotal');
    Route::get('reported-cases/search', 'ReportedCaseController@search');
    Route::get('daily-cases', 'DailyCase\DailyCaseController@index');
    Route::get('daily-cases/search', 'DailyCase\DailyCaseController@search');
});
