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

Route::get('/api/admin/property-status', 'PropertyStatusController@getPropertyStatus')->name('get_property_status')->middleware('admin');
Route::delete('/api/admin/property-status', 'PropertyStatusController@deletePropertyStatus')->name('delete_property_status')->middleware('admin');
Route::post('api/admin/property-status', 'PropertyStatusController@savePropertyStatus')->name('save_property_status')->middleware('admin');

// Admin Routes:
Route::get('/admin/property-status', 'PropertyStatusController@listPropertyStatus')->name('list_property_status')->middleware('admin');
Route::get('/admin/property-status/new', 'PropertyStatusController@newPropertyStatus')->name('new_property_status')->middleware('admin');
Route::get('/admin/property-status/edit/{id}', 'PropertyStatusController@editPropertyStatus')->name('edit_property_status')->middleware('admin');