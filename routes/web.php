<?php

use App\Http\Controllers;
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

// Route::get('/', function () {
//     return view('pages.home');
// });
// Route::get('/user-dashboard', [Controllers\User\ProfileController::class, 'show']);

Route::get('/company-brands', function () {
    return view('pages.company-brands');
});
// Route::get('/good-company', function () {
//     return view('pages.company-detail');
// });
// Route::get('/login', function () {
//     return view('pages.user-login');
// });

Route::get('/', [Controllers\Website\HomePageController::class, 'show']);
Route::get('/search', [Controllers\Website\HomePageController::class, 'search']);
Route::get('/brands', [Controllers\Website\CategoryController::class, 'index']);
Route::get('/companies', [Controllers\Website\CompaniesController::class, 'index']);
Route::get('/brands/{firstletter}', [Controllers\Website\CategoryController::class, 'indexByFirstletter']);
Route::get('/brand/{company_name}', [Controllers\Website\CompanyController::class, 'show']);
Route::get('/brand/{company_name}/write-review', [Controllers\Website\CompanyController::class, 'showReviewForm']);
Route::post('/brand/{company_id}/write-review', [Controllers\Website\CompanyController::class, 'review']);
Route::get('user-login', [Controllers\Auth\LoginController::class, 'showLoginForm'])->name('user-login');
// Route::get('login', [Controllers\Auth\LoginController::class, 'show'])->name('login');
Route::post('user-login', [Controllers\Auth\LoginController::class, 'login'])->name('user-login');
Route::get('user-register', [Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('user-register');
Route::post('user-register', [Controllers\Auth\RegisterController::class, 'register'])->name('user-register');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/user-dashboard', [Controllers\User\ProfileController::class, 'show'])->name('home');
    Route::get('/user-dashboard/review', [Controllers\User\ReviewController::class, 'show']);
    Route::get('/user-dashboard/profile', [Controllers\User\ProfileController::class, 'showProfile']);
    Route::get('/user-logout', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');

});

Route::get('company-login', [Controllers\AuthCompany\LoginController::class, 'showLoginForm']);
// Route::get('login', [Controllers\AuthCompany\LoginController::class, 'show'])->name('login');
Route::post('company-login', [Controllers\AuthCompany\LoginController::class, 'login']);
Route::get('company-register', [Controllers\AuthCompany\RegisterController::class, 'showRegistrationForm']);
Route::post('company-register', [Controllers\AuthCompany\RegisterController::class, 'register']);

Route::group(['middleware' => 'auth:company'], function () {
    Route::get('company-dashboard', [Controllers\Company\ProfileController::class, 'show']);
    Route::get('company-logout', [Controllers\AuthCompany\LoginController::class, 'logout']);
    Route::get('company-dashboard/review', [Controllers\Company\ReviewController::class, 'show']);
    Route::post('company-dashboard/respond-review', [Controllers\Company\ReviewController::class, 'respond']);
    Route::post('company-dashboard/report-review/{review_id}', [Controllers\Company\ReviewController::class, 'report']);

});
Route::get('/user-register', function () {
    return view('pages.user-register');
});
// Route::get('/company-register', function () {
//     return view('pages.company-register');
// });
// Route::get('/company-login', function () {
//     return view('pages.company-login');
// });
// Route::get('/user-dashboard', function () {
//     return view('pages.user-dashboard');
// });
// Route::get('/company-dashboard', function () {
//     return view('pages.company-dashboard');
// });
Route::get('/user-forgot-password', function () {
    return view('pages.user-forgot-password');
});
// Route::get('/write-review', function () {
//     return view('pages.user-write-review');
// });
Route::get('/write-review-anycompany', function () {
    return view('pages.user-write-review-anycompany');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/404', function () {
    return view('pages.404');
});
Route::group(['prefix' => 'admin'], function () {

    Route::get('/{vue_capture?}', function () {
        return View::make('layouts.admin');
    })->where('vue_capture', '[\/\w\.-]*');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
