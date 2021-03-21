<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::get('/runners', 'RunnersController@index');
    Route::post('/runners', 'RunnersController@store');

    Route::get('/races', 'RacesController@index');
    Route::post('/races', 'RacesController@store');

    Route::post('/runners-races', 'RunnersRacesController@store');

    Route::get('/runners-result', 'RunnersResultController@index');
    Route::post('/runners-result', 'RunnersResultController@store');

    Route::get('/races-listing-by-age', 'RacesListingController@racesListingByAge');
    Route::get('/races-listing-general', 'RacesListingController@racesListingGeneral');
});
