<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

abstract class BaseService
{
    protected \Illuminate\Http\Client\PendingRequest $http;

    protected \Illuminate\Support\Collection $data;

    protected string $url;

    public function __construct()
    {
        $this->http = Http::acceptJson();
    }

    /**
     * @param \Illuminate\Support\Collection $data
     *
     * @return $this
     */
    final public function setData(\Illuminate\Support\Collection $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    final public function getData(): \Illuminate\Support\Collection
    {
        return $this->data;
    }

    /**
     * @param string $endpoint
     *
     * @return \Illuminate\Http\Client\Response
     */
    final public function getJson(string $endpoint): \Illuminate\Http\Client\Response
    {
        return $this->http
            ->asJson()
            ->get("$this->url/$endpoint");
    }

    /**
     * @param string $endpoint
     * @param array<array-key, mixed> $body
     *
     * @return \Illuminate\Http\Client\Response
     */
    final public function postJson(string $endpoint, array $body): \Illuminate\Http\Client\Response
    {
        return $this->http
            ->asForm()
            ->post("$this->url/$endpoint", $body);
    }
}
