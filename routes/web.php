<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\NftController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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

    Route::group(['middleware'=>['AuthCheck', 'verified']], function () {
        Route::resource('nft_resource', NftController::class, ['except' => ['show', 'index']]);

        Route::get('nft/listing/store/{id}', [ListingController::class, 'new_listing']);
        Route::get('nft/listing/update/{id}', [ListingController::class, 'update_listing']);
        Route::get('nft/listing/remove/{id}', [ListingController::class, 'remove']);

        Route::get('/auth/logout', [UserAuth::class, 'logout'])->name('auth.logout');
        Route::get('nft/listing/transaction/{id}', [ListingController::class, 'transaction']);
        Route::get('collection/view/new/purchace/{id}', [CollectionController::class, 'buy_new']);
        Route::post('comments/{nft_id}', [CommentController::class, 'store'])->middleware('throttle:12,1');

        Route::get('collection/view/new/{id}', [CollectionController::class, 'show_new']);
        Route::resource('collections', CollectionController::class);

        Route::resource('profile', UserProfile::class, ['except' => ['show']]);
        Route::get('profile/user/{id}', [UserProfile::class, 'show'])->name('user.profile');
    });

    Route::group(['middleware'=>['EnsureIfAdmin', 'verified']], function () {
        Route::get('admin/user/manage/user/destroy/{id}', [AdminController::class, 'user_destroy'])->name('user.destroy');
        Route::get('admin/user/manage/user/update/{id}', [AdminController::class, 'user_update'])->name('user_update');
        Route::get('admin/user/manage/users/{id}', [AdminController::class, 'show_user'])->name('admin.user.show');
        Route::get('admin/user/manage/users', [AdminController::class, 'index_users']);
        Route::resource('admin_res', NftController::class, ['except' => ['index']]);
        Route::get('admin/user/dash', [AdminController::class, 'index']);
    });

    Route::get('nft/index', [NftController::class, 'index'])->name('nft.index');
    Route::get('nft/show/{id}', [NftController::class, 'show']);

    Route::get('/auth/login', [UserAuth::class, 'login'])->name('login');
    Route::get('/auth/register', [UserAuth::class, 'register'])->middleware('throttle:12,1')->name('register');
    Route::post('/auth/save', [UserAuth::class, 'save'])->name('auth.save');
    Route::post('/auth/check', [UserAuth::class, 'check'])->name('auth.check');
    
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
     
        return redirect('/');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

});