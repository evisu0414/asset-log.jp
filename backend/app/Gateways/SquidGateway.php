<?php

declare(strict_types=1);

namespace App\Gateways;

use App\Exceptions\SquidException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SquidGateway
{
    /**
     * @var string
     */
    private readonly string $apiEndpoint;

    /**
     * @var array
     */
    private readonly array $headers;

    public function __construct()
    {
        $this->apiEndpoint = config('squid.api_endpoint');
        $this->headers = [
            'Content-Type' => 'application/json',
            'X-API-Key' => config('squid.api_key'),
        ];
    }

    /**
     * @param string $endpoint
     * @param array $query
     *
     * @throws SquidException
     *
     * @return Collection
     */
    public function get(string $endpoint, array $query = []): Collection
    {
        Log::info('GET Request to Squid API:' . $endpoint, $query);
        $response = Http::withHeaders($this->headers)->get($this->apiEndpoint . $endpoint, $query);

        if ($response->failed()) {
            Log::error('Error Response from Squid API:' . $endpoint, $response->json());
            $message = '';
            foreach ($response->json('errors') as $error) {
                $message .= $error['message'];
            }
            throw new SquidException($message, $response->status());
        }
        Log::info('Response from Squid API:' . $endpoint, $response->json());

        return $response->collect();
    }
}
