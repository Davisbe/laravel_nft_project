<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\NftController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\AdminController;


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
Route::group(['middleware'=>['GlobalCheck']], function () {

    Route::get('/', [HomeController::class, 'index']);

    Route::post('/auth/save', [UserAuth::class, 'save'])->name('auth.save');
    Route::post('/auth/check', [UserAuth::class, 'check'])->name('auth.check');

    Route::resource('nft_resource', NftController::class, ['except' => ['show', 'index']]);
    Route::get('nft/show/{id}', [NftController::class, 'show']);
    Route::get('nft/index', [NftController::class, 'index'])->name('nft.index');

    Route::get('nft/listing/store/{id}', [ListingController::class, 'new_listing']);
    Route::get('nft/listing/update/{id}', [ListingController::class, 'update_listing']);
    Route::get('nft/listing/remove/{id}', [ListingController::class, 'remove']);


    Route::group(['middleware'=>['AuthCheck']], function () {
        Route::get('/auth/login', [UserAuth::class, 'login']);
        Route::get('/auth/register', [UserAuth::class, 'register']);
        Route::get('/auth/logout', [UserAuth::class, 'logout'])->name('auth.logout');
        Route::get('nft/listing/transaction/{id}', [ListingController::class, 'transaction']);
        Route::get('collection/view/new/purchace/{id}', [CollectionController::class, 'buy_new']);
    });

    Route::group(['middleware'=>['EnsureIfAdmin']], function () {
        Route::get('admin/user/manage/user/destroy/{id}', [AdminController::class, 'user_destroy'])->name('user.destroy');
        Route::get('admin/user/manage/user/update/{id}', [AdminController::class, 'user_update'])->name('user_update');
        Route::get('admin/user/manage/users/{id}', [AdminController::class, 'show_user'])->name('admin.user.show');
        Route::get('admin/user/manage/users', [AdminController::class, 'index_users']);
        Route::resource('admin_res', NftController::class, ['except' => ['index']]);
        Route::get('admin/user/dash', [AdminController::class, 'index']);
    });

    Route::get('collection/view/new/{id}', [CollectionController::class, 'show_new']);
    Route::resource('collections', CollectionController::class);

    Route::resource('profile', UserProfile::class, ['except' => ['show']]);
    Route::get('profile/user/{id}', [UserProfile::class, 'show'])->name('user.profile');

});