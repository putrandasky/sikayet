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
    return view('pages.home');
});
Route::get('/company-brands', function () {
    return view('pages.company-brands');
});
Route::get('/good-company', function () {
    return view('pages.company-detail');
});
Route::get('/user-login', function () {
    return view('pages.user-login');
});
Route::get('/user-register', function () {
    return view('pages.user-register');
});
Route::get('/company-register', function () {
    return view('pages.company-register');
});
Route::get('/company-login', function () {
    return view('pages.company-login');
});
Route::get('/user-dashboard', function () {
    return view('pages.user-dashboard');
});
Route::get('/company-dashboard', function () {
    return view('pages.company-dashboard');
});
Route::get('/user-forgot-password', function () {
    return view('pages.user-forgot-password');
});
Route::get('/write-review', function () {
    return view('pages.user-write-review');
});
Route::get('/write-review-anycompany', function () {
    return view('pages.user-write-review-anycompany');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/404', function () {
    return view('pages.404');
});
