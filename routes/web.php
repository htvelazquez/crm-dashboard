<?php

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

// Google auth
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/forbidden', 'Auth\LoginController@forbidden')->name('forbidden');

// Directory
Route::get('/', 'DirectoryController@index')->middleware('check.permissions');
Route::get('/', 'DirectoryController@index')->middleware('check.permissions');
Route::get('/directory/status', 'DirectoryController@status');
Route::post('/directory/contacts', 'DirectoryController@contacts');
Route::post('/directory/export_contacts', 'DirectoryController@CSVcontacts');
