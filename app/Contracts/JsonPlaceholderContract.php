<?php

declare(strict_types=1);

namespace App\Contracts;

interface JsonPlaceholderContract
{
    public function getUsers(): \Illuminate\Http\Client\Response;

    public function getPosts(): \Illuminate\Http\Client\Response;

    public function getComments(): \Illuminate\Http\Client\Response;
}
