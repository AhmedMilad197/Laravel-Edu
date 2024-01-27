<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/factory', function () {
    return User::factory()
            ->has(Post::factory()->count(3), 'posts')
            ->create();
});
