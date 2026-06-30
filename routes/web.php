<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BlogPostController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\HomeSliderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RecipeController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\admin\AudioController;
use App\Http\Controllers\admin\PhotoGalleryController;
use App\Http\Controllers\admin\ShopContactController;

/*
|--------------------------------------------------------------------------
| Web Routes — Revamp Template
|--------------------------------------------------------------------------
| Public pages are defined in config/site.php → pages array.
| Add new routes here when adding pages during a revamp.
*/

Route::get('admin/login', 'admin\AdminController@login')->name('admin.login');
Route::post('admin/authenticate', 'admin\AdminController@authenticate')->name('admin.authenticate');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/admin/profile/edit', 'admin\AdminController@editProfile')->name('admin.profile.edit');
Route::post('/admin/profile/update', 'admin\AdminController@updateProfile')->name('admin.profile.update');
Route::post('admin/logout', 'admin\AdminController@logOut')->name('admin.logout');

// Frontend — pages configured in config/site.php
Route::get('/', [WebController::class, 'Index'])->name('index');
Route::get('about', [WebController::class, 'About'])->name('about');
Route::get('contact', [WebController::class, 'Contact'])->name('contact');
Route::get('books', [WebController::class, 'Books'])->name('books');
Route::get('books/{book}', [WebController::class, 'BookShow'])->name('books.show');
Route::get('blog', [WebController::class, 'Blog'])->name('blog');
Route::get('blog/{blogPost}', [WebController::class, 'BlogShow'])->name('blog.show');
Route::get('recipes', [WebController::class, 'Recipes'])->name('recipes');
Route::get('recipes/{recipe}', [WebController::class, 'RecipeShow'])->name('recipes.show');
Route::get('favorites', [WebController::class, 'Favorites'])->name('favorites');

// Kit landing pages — preserve existing URLs
Route::get('connect', fn () => app(WebController::class)->KitLanding('connect'))->name('connect');
Route::get('bonusrecipes', fn () => app(WebController::class)->KitLanding('bonusrecipes'))->name('bonusrecipes');
Route::get('ARCreaders', fn () => app(WebController::class)->KitLanding('arcreaders'))->name('arcreaders');
Route::get('arcreaders', fn () => redirect()->route('arcreaders', [], 301));

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('contactus', ContactUsController::class);
Route::resource('shopcontact', ShopContactController::class);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('role', 'admin\RoleController');
    Route::resource('permission', 'admin\PermissionController');
    Route::resource('page', 'admin\PageController');
    Route::resource('page_setting', 'admin\PageSettingController');
    Route::resource('banner', BannerController::class);
    Route::resource('homeslider', HomeSliderController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('video', VideoController::class);
    Route::resource('audio', AudioController::class);
    Route::resource('photogallery', PhotoGalleryController::class);
    Route::resource('blog-post', BlogPostController::class);
    Route::resource('recipe', RecipeController::class);
    Route::resource('product', ProductController::class);
    Route::resource('book', BookController::class);
});
