<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\JsonPlaceholderContract;

class JsonPlaceholderService extends BaseService implements JsonPlaceholderContract
{
    protected string $url = 'https://jsonplaceholder.typicode.com';

    /**
     * @return \Illuminate\Http\Client\Response
     */
    public function getUsers(): \Illuminate\Http\Client\Response
    {
        return $this->getJson('users');
    }

    /**
     * @return \Illuminate\Http\Client\Response
     */
    public function getPosts(): \Illuminate\Http\Client\Response
    {
        return $this->getJson('posts');
    }

    /**
     * @return \Illuminate\Http\Client\Response
     */
    public function getComments(): \Illuminate\Http\Client\Response
    {
        return $this->getJson('comments');
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
