<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Contracts\JsonPlaceholderContract;
use App\Models\{User, Post, Comment};

class ParseJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-json';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse base data from service';
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Comment::truncate();
        Post::truncate();
        User::truncate();

        $jsonPlaceholderService = app(JsonPlaceholderContract::class);

        $users = $jsonPlaceholderService->getUsers()->collect();
        $posts = $jsonPlaceholderService->getPosts()->collect();
        $comments = $jsonPlaceholderService->getComments()->collect();

        DB::transaction(fn() =>
            $users->map(function (array $item) use ($posts, $comments) {
                $user = User::create($item);
                $savedPosts = $user->posts()->createMany($posts->where('userId', $user->id));
                $savedPosts->map(fn(Post $post) =>
                    $post->comments()->createMany($comments->where('postId', $post->id))
                );
            })
        );
    }
}
