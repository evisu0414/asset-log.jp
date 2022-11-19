<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Exceptions\SquidException;
use App\Gateways\SquidGateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * TODO:SquidとのAPI連携の動作確認用に作成したサンプルのため、本実装時に削除します。
 */
class SampleErrorSquidApiController extends Controller
{
    /**
     * @param SquidGateway $squidGateway
     */
    public function __construct(private readonly SquidGateway $squidGateway)
    {
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse|Collection
     */
    public function __invoke(Request $request): JsonResponse|Collection
    {
        try {
            return $this->squidGateway->get('/sample/error', $request->query());
        } catch (SquidException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
