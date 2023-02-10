<?php

namespace RCerljenko\LaravelOpenAIModeration\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class OpenAIHandler
{
	public const API_URL = 'https://api.openai.com/v1/';

	protected PendingRequest $client;

	public function __construct(?string $apiKey = null)
	{
		$this->client = Http::acceptJson()
			->withToken($apiKey ?? config('openai.api_key'))
			->baseUrl(self::API_URL);
	}

	public function moderations(string|array $input): ?array
	{
		$data = $this->client->post('moderations', [
			'input' => $input,
		]);

		return $this->returnResponse($data);
	}

	protected function returnResponse(Response $data, ?array $default = null): ?array
	{
		return $data->successful() ? $data->json() : $default;
	}
}
