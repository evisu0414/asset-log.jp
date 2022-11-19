<?php

declare(strict_types=1);

use App\Http\Controllers\Squid\SampleController;
use Illuminate\Support\Facades\Route;

/*
 * TODO:SquidとのAPI連携の動作確認用に作成したサンプルのため、本実装時に削除します。
 */
Route::middleware('auth:sanctum')->get('/squid-sample', SampleController::class);
