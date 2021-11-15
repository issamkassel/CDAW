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

    return 'Bonjour'.request('nom').request('prenom');
})-> whereAlpha;
Route::get('/{nom}/{prenom}', function ($nom,$prenom) {
    echo 'Bonjour',$nom,$prenom;
    return view('welcome');
});
