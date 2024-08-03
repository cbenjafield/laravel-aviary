<?php

namespace Cbenjafield\Aviary;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class AviaryService
{
    /**
     * The token to consume the API with.
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * The base URL for the Aviary API.
     *
     * @var string
     */
    protected string $apiEndpoint;

    public function __construct()
    {
        $this->apiKey = config('aviary.api_key');
        $this->apiEndpoint = config('aviary.api_endpoint');
    }

    /**
     * Create a new HTTP request.
     *
     * @return PendingRequest
     */
    public function http(): PendingRequest
    {
        return Http::baseUrl($this->apiEndpoint)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'X-App-Name' => config('app.name') ?? 'Aviary Client',
            ]);
    }

    /**
     * Create a new message.
     *
     * @param string $recipient
     * @param string $body
     * @return array
     * @throws ConnectionException
     */
    public function createMessage(string $recipient, string $body): array
    {
        $response = $this->http()->post('/v1/messages', [
            'recipient' => $recipient,
            'message' => $body,
        ]);

        return $response->json();
    }
}