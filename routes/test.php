<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * 
 *  getting handy with laravel factory.
 */
Route::get('/factory', function () {
    return User::factory()
        ->has(Post::factory()->count(3), 'posts')
        ->create();
});

/**
 * 
 * use spatie query builder for filtering data.
 */
Route::get('/spatie/query-builder', function () {
    return QueryBuilder::for(User::class)
        ->allowedFilters(['name', 'email'])
        ->get();
});

/**
 * 
 * Use the laravel query scopes.
 */
Route::get('/local-scopes', function () {
    return User::Admin()->get();
});
