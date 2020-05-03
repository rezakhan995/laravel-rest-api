<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/articles", [ArticleController::class, "getAllArticles"]);
Route::get("/articles/{article}", [ArticleController::class, "getArticle"]);

Route::middleware('auth:api')->group(function () {
    Route::post("/articles", [ArticleController::class, "createArticle"]);
    Route::put("/articles/{article}", [ArticleController::class, "updateArticle"]);
    Route::delete("/articles/{article}", [ArticleController::class, "deleteArticle"]);
});

Route::post("/token", [UserController::class, 'generateToken']);


/**
 * Create dummy users
 */
Route::get("/create", function () {
    User::forceCreate([
        'name' => 'Reza Khan',
        'email' => 'rezakhan995@gmail.com',
        'password' => Hash::make("123123")
    ]);
    User::forceCreate([
        'name' => 'Tamanna Rashid',
        'email' => 'tamanna@gmail.com',
        'password' => Hash::make("123123")
    ]);
    User::forceCreate([
        'name' => 'Raufun Hawlader',
        'email' => 'raufun@gmail.com',
        'password' => Hash::make("123123")
    ]);
});

/**
 * Generate api_token for existing users
 */
Route::get("/create_token", function () {
    $user = User::find(1);
    $user->api_token =  Str::random(60);
    $user->save();

    $user = User::find(2);
    $user->api_token =  Str::random(60);
    $user->save();

    $user = User::find(3);
    $user->api_token =  Str::random(60);
    $user->save();
});
