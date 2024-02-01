<?php

use App\Models\Post;
use App\Models\User;
use App\Notifications\TestEnrollment;
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

Route::get('/notify/{user}', function (User $user) {
    $user->notify(new TestEnrollment([
        'body' => 'This is the body',
        'enrollment_text' => 'This is the enrollment text', 
        'url' => 'This is the url', 
        'thank_you' => 'This is thank you'
    ]));
    return 'Sent email.';
});