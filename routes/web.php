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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Property related routes:
Route::get('/property/new', 'PropertyController@new')->name('new_property');

// API methods:
Route::get('/api/locations', 'LocationController@getLocations')->name('get_locations');

// Admin Routes:
Route::get('/admin/property-status', 'AdminController@listPropertyStatus')->name('list_property_status')->middleware('admin');
Route::get('/admin/property-status/new', 'AdminController@newPropertyStatus')->name('new_property_status')->middleware('admin');
Route::get('/admin/property-status/new', 'AdminController@editPropertyStatus')->name('edit_property_status')->middleware('admin');