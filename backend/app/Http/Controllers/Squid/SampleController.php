<?php

declare(strict_types=1);

namespace App\Http\Controllers\Squid;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/*
 * TODO:SquidとのAPI連携の動作確認用に作成したサンプルのため、本実装時に削除します。
 */
class SampleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return response()->json(['message' => 'sample response.']);
    }
}
