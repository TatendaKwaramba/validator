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
Route::post('test', 'ImportsController@readCSV')->name('readCSV');
Route::get('csv_results', 'ImportsController@show_results')->name('csv_results');
Route::get('importExportView', 'ImportsController@importExportView');
Route::post('import', 'ImportsController@import')->name('import');
Route::get('export', 'ImportsController@export')->name('export');

