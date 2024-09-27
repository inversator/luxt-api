<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->prefix('v1')->group(function () {
    Route::controller(\App\Http\Controllers\AuthController::class)
        ->middleware('throttle')
        ->prefix('auth')
        ->group(function () {
            Route::post('login', 'login');
            Route::post('register', 'register');
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
        });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(\App\Http\Controllers\PageController::class)
            ->group(function () {
                Route::get('pages', 'index');
                Route::get('pages/{id}', 'show');
                Route::post('pages', 'store');
                Route::put('pages/{id}', 'update');
                Route::delete('pages/{id}', 'destroy');
            });

        Route::get('/user', function (Request $request) {
            return response()->json(auth()->user());
        });
    });



    // Sockets test
    Route::get('/sockets', function (denis660\Centrifugo\Centrifugo $centrifugo) {
        $sentStatus = $centrifugo->publish('test', ['test']);

        $payload = [
            'sub' => 1,
            'exp' => time() + 3600
        ];

//        $centrifugoToken = $centrifugo->generateConnectionToken(1, 0, [
//            'name' => 'TestUserName'
//        ]);
//        dd($centrifugoToken);

//        $token = \Firebase\JWT\JWT::encode($payload, env('CENTRIFUGO_TOKEN_HMAC_SECRET_KEY'), 'HS256');
//        dd($token);
        return $sentStatus;
    });
});

Route::fallback(function () {
    dd('fallback');
});
