<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::redirect('/home', '/');
Route::get('/listings', 'ListingController@index')->name('listing');
Route::get('/donate', 'DonateController@index')->name('donate');
Route::get('/spotify', 'SpotifyController@index')->name('spotify.home');
Route::get('/spotify/connect', 'SpotifyController@connect')->name('spotify.connect');
Route::get('/spotify/callback', 'SpotifyController@callback')->name('spotify.callback');
Route::get('/spotify/logout', 'SpotifyController@logout')->name('spotify.logout');
