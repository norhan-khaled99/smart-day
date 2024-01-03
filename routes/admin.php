<?php

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
//Admin
Route::prefix("admin-auth")->group(function () {
    Route::post("login", "AuthController@login");
    Route::get("veriy-token", "AuthController@verifyToken");
    Route::get("logout", "AuthController@logout");
});

Route::prefix("categories")->group(function () {
    Route::post("", "CategoryController@store");
    Route::post("update", "CategoryController@update");
    Route::delete("{id}", "CategoryController@delete");
    Route::get("", "CategoryController@index");
    Route::get("brands", "CategoryController@getBrands");
    Route::get("base-categories", "CategoryController@getBaseCategories");
    Route::get("{id}", "CategoryController@find");
});


Route::prefix("brands")->group(function () {
    Route::post("", "BrandController@store");
    Route::post("update", "BrandController@update");
    Route::delete("{id}", "BrandController@delete");
    Route::get("", "BrandController@index");
    Route::get("toggle-status/{id}", "BrandController@toggleStatus");
    Route::get("{id}", "BrandController@find");
});

Route::prefix("base-categories")->group(function () {
    Route::post("", "BaseCategoryController@store");
    Route::post("update", "BaseCategoryController@update");
    Route::delete("{id}", "BaseCategoryController@delete");
    Route::get("", "BaseCategoryController@index");
    Route::get("toggle-status/{id}", "BaseCategoryController@toggleStatus");
    Route::get("{id}", "BaseCategoryController@find");
});


Route::prefix("products")->group(function () {
    Route::post("", "ProductController@store");
    Route::post("update", "ProductController@update");
    Route::delete("{id}", "ProductController@delete");
    Route::get("categories", "ProductController@getCategories");
    Route::get("", "ProductController@index");
    Route::get("{id}", "ProductController@find");
});


Route::prefix("contacts")->group(function () {
    Route::delete("{id}", "ContactController@delete");
    Route::get("", "ContactController@index");
    Route::get("{id}", "ContactController@find");
});

Route::prefix("recruitments")->group(function () {
    Route::delete("{id}", "RecruitmentController@delete");
    Route::get("", "RecruitmentController@index");
    Route::get("{id}", "RecruitmentController@find");
});

Route::prefix("notification-services")->group(function () {
    Route::delete("{id}", "NotificationServiceController@delete");
    Route::get("", "NotificationServiceController@index");
});


Route::prefix("installs")->group(function () {
    Route::delete("{id}", "InstallController@delete");
    Route::get("", "InstallController@index");
    Route::post("send-email", "InstallController@sendEmail");
});

Route::prefix("business-contracts")->group(function () {
    Route::delete("{id}", "BusinessContractController@delete");
    Route::get("", "BusinessContractController@index");
});


Route::prefix("media-manager")->group(function () {
    Route::post("", "MediaManagerController@store");
    Route::get("", "MediaManagerController@getAllMedia");
    Route::delete("{id}", "MediaManagerController@deleteMedia");
});
Route::prefix("questions")->group(function(){
Route::post("store", "QuestionController@store");
Route::get("", "QuestionController@getAllQuestions");
Route::delete("{id}", "QuestionController@deleteQuestion");
});
