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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listings', 'ListingController@indexAPI')->name('listing');
Route::get('/spotify/saved-tracks', 'SpotifyController@getUserSavedTracks')->name('spotify.get-user-saved-tracks');
Route::get('/spotify/users-profile', 'SpotifyController@getUsersProfile')->name('spotify.get-user-users-profile');
