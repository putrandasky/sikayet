<?php

use App\Http\Controllers;
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

Route::get('/dashboard', [Controllers\Admin\DashboardController::class, 'show']);
Route::get('/users', [Controllers\Admin\UserController::class, 'index']);
Route::patch('/user/{user_id}', [Controllers\Admin\UserController::class, 'update']);
Route::get('/companies/{condition}', [Controllers\Admin\CompanyController::class, 'index']);
Route::patch('/company/{company_id}', [Controllers\Admin\CompanyController::class, 'update']);
Route::get('/reviews/{condition}', [Controllers\Admin\ReviewController::class, 'index']);
Route::patch('/review/{review_id}', [Controllers\Admin\ReviewController::class, 'update']);
Route::post('/review-orphans', [Controllers\Admin\ReviewController::class, 'registerCompanyByReviewOrphan']);
Route::get('/membership', [Controllers\Admin\MembershipPlanController::class, 'index']);
Route::post('/membership', [Controllers\Admin\MembershipPlanController::class, 'store']);
Route::patch('/membership', [Controllers\Admin\MembershipPlanController::class, 'update']);
Route::delete('/membership/{membership_id}', [Controllers\Admin\MembershipPlanController::class, 'delete']);
// Route::post('/payment', [Controllers\Company\PaymentController::class, 'pay']);
Route::get('/billings/{condition}', [Controllers\Admin\BillingController::class, 'index']);
Route::patch('/billing/{billing_id}', [Controllers\Admin\BillingController::class, 'update']);

Route::get('/compose-term-of-use', [Controllers\Admin\EditorController::class, 'getTermOfUse']);
Route::post('/compose-term-of-use', [Controllers\Admin\EditorController::class, 'composeTermOfUse']);
Route::get('/compose-privacy-policy', [Controllers\Admin\EditorController::class, 'getPrivacyPolicy']);
Route::post('/compose-privacy-policy', [Controllers\Admin\EditorController::class, 'composePrivacyPolicy']);
Route::get('/compose-agreement', [Controllers\Admin\EditorController::class, 'getAgreement']);
Route::post('/compose-agreement', [Controllers\Admin\EditorController::class, 'composeAgreement']);
Route::get('/compose-about', [Controllers\Admin\EditorController::class, 'getAbout']);
Route::post('/compose-about', [Controllers\Admin\EditorController::class, 'composeAbout']);
Route::post('/compose-faq-group', [Controllers\Admin\FaqGroupController::class, 'composeFaqGroup']);
Route::get('/compose-faq-group', [Controllers\Admin\FaqGroupController::class, 'getFaqGroup']);
Route::patch('/compose-faq-group/{faq_group_id}', [Controllers\Admin\FaqGroupController::class, 'updateFaqGroup']);
Route::delete('/compose-faq-group/{faq_group_id}', [Controllers\Admin\FaqGroupController::class, 'deleteFaqGroup']);
Route::get('/compose-faq', [Controllers\Admin\FaqController::class, 'getFaq']);
Route::post('/compose-faq', [Controllers\Admin\FaqController::class, 'composeFaq']);
Route::patch('/compose-faq/{faq_id}', [Controllers\Admin\FaqController::class, 'updateFaq']);
Route::delete('/compose-faq/{faq_id}', [Controllers\Admin\FaqController::class, 'deleteFaq']);
Route::get('/compose-membership-info', [Controllers\Admin\MembershipInfoController::class, 'getMembershipInfo']);
Route::post('/compose-membership-info', [Controllers\Admin\MembershipInfoController::class, 'composeMembershipInfo']);
Route::patch('/compose-membership-info/{memebership_info_id}', [Controllers\Admin\MembershipInfoController::class, 'updateMembershipInfo']);
Route::delete('/compose-membership-info/{memebership_info_id}', [Controllers\Admin\MembershipInfoController::class, 'deleteMembershipInfo']);
Route::get('/contact', [Controllers\Admin\ContactController::class, 'showContact']);
Route::get('/business-category', [Controllers\Admin\BusinessCategoryController::class, 'index']);
Route::post('/business-category', [Controllers\Admin\BusinessCategoryController::class, 'store']);
Route::get('/compose-social', [Controllers\Admin\EditorController::class, 'getSocial']);
Route::post('/compose-social', [Controllers\Admin\EditorController::class, 'composeSocial']);
Route::get('/compose-header', [Controllers\Admin\EditorController::class, 'getHeader']);
Route::post('/compose-header', [Controllers\Admin\EditorController::class, 'composeHeader']);
Route::patch('/business-category', [Controllers\Admin\BusinessCategoryController::class, 'update']);
Route::delete('/business-category/{category_id}', [Controllers\Admin\BusinessCategoryController::class, 'delete']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
