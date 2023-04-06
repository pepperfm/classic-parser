<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Contracts\JsonPlaceholderContract;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_fetch_users(): void
    {
        $jsonPlaceholderService = app(JsonPlaceholderContract::class);
        $fakeUsersResponse = [
            'id',
            'name',
            'username',
            'email',
            'address',
            'phone',
            'website',
            'company',
        ];
        $fakeResponse = \Http::fake([
            $jsonPlaceholderService->getUrl() . '/users' => \Http::response($fakeUsersResponse), 200,
        ])
            ->asJson()
            ->get($jsonPlaceholderService->getUrl() . '/users');
        $users = $jsonPlaceholderService->getUsers()->collect();

        $this->assertJsonStringEqualsJsonString(
            json_encode($fakeResponse->json()),
            json_encode(array_keys($users->first()))
        );
    }

    public function test_fetch_posts(): void
    {
        $jsonPlaceholderService = app(JsonPlaceholderContract::class);
        $fakeUsersResponse = [
            'userId',
            'id',
            'title',
            'body',
        ];
        $fakeResponse = \Http::fake([
            $jsonPlaceholderService->getUrl() . '/posts' => \Http::response($fakeUsersResponse), 200,
        ])
            ->asJson()
            ->get($jsonPlaceholderService->getUrl() . '/posts');
        $posts = $jsonPlaceholderService->getPosts()->collect();

        $this->assertJsonStringEqualsJsonString(
            json_encode($fakeResponse->json()),
            json_encode(array_keys($posts->first()))
        );
    }

    public function test_fetch_comments(): void
    {
        $jsonPlaceholderService = app(JsonPlaceholderContract::class);
        $fakeUsersResponse = [
            'postId',
            'id',
            'name',
            'email',
            'body',
        ];
        $fakeResponse = \Http::fake([
            $jsonPlaceholderService->getUrl() . '/comments' => \Http::response($fakeUsersResponse), 200,
        ])
            ->asJson()
            ->get($jsonPlaceholderService->getUrl() . '/comments');
        $comments = $jsonPlaceholderService->getComments()->collect();

        $this->assertJsonStringEqualsJsonString(
            json_encode($fakeResponse->json()),
            json_encode(array_keys($comments->first()))
        );
    }

    public function test_users_index(): void
    {
        User::factory(10)->create();
        $response = $this->getJson('/api/users');

        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'errors',
            'data' => [
                'users' => [
                    [
                        'id',
                        'name',
                        'username',
                        'email',
                        'address' => [
                            'street',
                            'suite',
                            'city',
                            'zipcode',
                            'geo' => [
                                'lat',
                                'lng',
                            ],
                        ],
                        'phone',
                        'website',
                        'company' => [
                            'name',
                            'catchPhrase',
                            'bs',
                        ],
                    ],
                ],
            ],
        ]);
    }

    public function test_users_show(): void
    {
        $user = User::factory()->create();
        $response = $this->getJson("/api/users/$user->id");

        $response->assertOk();
        $response->assertJsonStructure([
            'message',
            'errors',
            'data' => [
                'user' => [
                    'id',
                    'name',
                    'username',
                    'email',
                    'address' => [
                        'street',
                        'suite',
                        'city',
                        'zipcode',
                        'geo' => [
                            'lat',
                            'lng',
                        ],
                    ],
                    'phone',
                    'website',
                    'company' => [
                        'name',
                        'catchPhrase',
                        'bs',
                    ],
                    'posts',
                ],
            ],
        ]);
    }
}
