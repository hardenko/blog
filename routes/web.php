<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//use function PHPSTORM_META\map;
//use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::latest()->with('category', 'author')->get()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts
    ]);
});

