<?php

declare(strict_types=1);

namespace App\Http;

use Illuminate\Http\JsonResponse;
use App\Contracts\ResponseContract;

class APIBaseResponder implements ResponseContract
{
    /** @var array<array-key, string> $headers */
    private array $headers = ['Content-Type' => 'application/json; charset=UTF-8', 'charset' => 'utf-8'];

    /**
     * @inheritdoc
     */
    public function response(
        array $data,
        string $message = 'Success',
        int $httpStatusCode = JsonResponse::HTTP_OK
    ): JsonResponse {
        $response = [
            'message' => $message,
            'errors' => null,
            'data' => $data,
        ];

        return new JsonResponse($response, $httpStatusCode, $this->headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @inheritdoc
     */
    public function error(
        string $message = 'Error',
        int $httpStatusCode = JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        mixed $errors = null,
        mixed $data = null
    ): JsonResponse {
        $response = [
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
        ];

        return new JsonResponse($response, $httpStatusCode, $this->headers, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param array $data
     * @param string $message
     *
     * @return JsonResponse
     */
    public function stored(
        array $data,
        string $message = '',
    ): JsonResponse {
        return $this->response($data, $message, JsonResponse::HTTP_CREATED);
    }

    /**
     * @param array $data
     * @param string $message
     *
     * @return JsonResponse
     */
    public function deleted(
        array $data,
        string $message = '',
    ): JsonResponse {
        return $this->response($data, $message, JsonResponse::HTTP_NO_CONTENT);
    }
}
