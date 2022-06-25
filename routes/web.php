<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\UserProfile;
use App\Http\Controllers\NftController;
use App\Http\Controllers\ListingController;


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
    return view('homepage');
});

Route::post('/auth/save', [UserAuth::class, 'save'])->name('auth.save');
Route::post('/auth/check', [UserAuth::class, 'check'])->name('auth.check');

Route::resource('profile', UserProfile::class, ['except' => ['show']]);
Route::get('profile/user/{id}', [UserProfile::class, 'show']);

Route::resource('nft_resource', NftController::class, ['except' => ['show']]);
Route::get('nft/show/{id}', [NftController::class, 'show']);

Route::get('nft/listing/store/{id}', [ListingController::class, 'new_listing']);
Route::get('nft/listing/update/{id}', [ListingController::class, 'update_listing']);
Route::get('nft/listing/remove/{id}', [ListingController::class, 'remove']);


Route::group(['middleware'=>['AuthCheck']], function () {
    Route::get('/auth/login', [UserAuth::class, 'login']);
    Route::get('/auth/register', [UserAuth::class, 'register']);
    Route::get('/auth/logout', [UserAuth::class, 'logout'])->name('auth.logout');
    Route::get('nft/listing/transaction/{id}', [ListingController::class, 'transaction']);
});