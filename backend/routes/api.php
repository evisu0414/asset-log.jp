<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\ShowAuthenticatedUserController;
use App\Http\Controllers\Api\SampleErrorSquidApiController;
use App\Http\Controllers\Api\SampleSquidApiController;
use App\Http\Controllers\Api\User\DestroyUserController;
use App\Http\Controllers\Api\User\IndexUserController;
use App\Http\Controllers\Api\User\ShowUserController;
use App\Http\Controllers\Api\User\StoreUserController;
use App\Http\Controllers\Api\User\UpdateUserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

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

Route::middleware('auth:sanctum')->get('/user', ShowAuthenticatedUserController::class);

$limiter = config('fortify.limiters.login');
Route::middleware([
        'guest:' . config('fortify.guard'),
        $limiter ? 'throttle:' . $limiter : null,
    ])->post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/users', IndexUserController::class);
    Route::post('/users', StoreUserController::class)->can('create', User::class);
    Route::get('/users/{user}', ShowUserController::class)->can('view', 'user');
    Route::put('/users/{user}', UpdateUserController::class)->can('update', 'user');
    Route::delete('/users/{user}', DestroyUserController::class)->can('delete', 'user');
});

/*
 * TODO:SquidとのAPI連携の動作確認用に作成したサンプルのため、本実装時に削除します。
 */
Route::middleware('auth:sanctum')->get('/sample', SampleSquidApiController::class);
Route::middleware('auth:sanctum')->get('/sample/error', SampleErrorSquidApiController::class);
