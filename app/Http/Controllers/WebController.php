<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Book;
use App\Models\Product;
use App\Models\Recipe;

class WebController extends Controller
{
    public function Index()
    {
        $books = Book::where('status', true)->orderBy('sort_order')->orderByDesc('id')->take(4)->get();
        $posts = BlogPost::published()->orderByDesc('published_at')->take(3)->get();
        $recipes = Recipe::published()->orderByDesc('id')->take(3)->get();

        return $this->renderPage('website.index', null, compact('books', 'posts', 'recipes'));
    }

    public function About()
    {
        return $this->renderPage('website.about', 'About Nora Hale');
    }

    public function Contact()
    {
        return $this->renderPage('website.contact', 'Contact');
    }

    public function Books()
    {
        $books = Book::where('status', true)->orderBy('sort_order')->orderByDesc('id')->get();

        return $this->renderPage('website.books', 'Books', compact('books'));
    }

    public function BookShow(Book $book)
    {
        if (! $book->status) {
            abort(404);
        }

        $page_title = ($book->meta_title ?: $book->title) . ' | ' . site('name');
        $meta_description = $book->meta_description ?: strip_tags(substr($book->description ?? '', 0, 160));

        return view('website.book-show', compact('book', 'page_title', 'meta_description'));
    }

    public function Blog()
    {
        $posts = BlogPost::published()->orderByDesc('published_at')->paginate(9);

        return $this->renderPage('website.blog', 'Blog', compact('posts'));
    }

    public function BlogShow(BlogPost $blogPost)
    {
        if (! $blogPost->status) {
            abort(404);
        }

        $page_title = ($blogPost->meta_title ?: $blogPost->title) . ' | ' . site('name');
        $meta_description = $blogPost->meta_description ?: strip_tags(substr($blogPost->excerpt ?? $blogPost->body ?? '', 0, 160));

        return view('website.blog-show', ['post' => $blogPost, 'page_title' => $page_title, 'meta_description' => $meta_description]);
    }

    public function Recipes()
    {
        $recipes = Recipe::published()->orderByDesc('id')->paginate(12);

        return $this->renderPage('website.recipes', 'Recipes', compact('recipes'));
    }

    public function RecipeShow(Recipe $recipe)
    {
        if (! $recipe->status) {
            abort(404);
        }

        $page_title = ($recipe->meta_title ?: $recipe->title) . ' | ' . site('name');
        $meta_description = $recipe->meta_description ?: strip_tags(substr($recipe->excerpt ?? '', 0, 160));

        return view('website.recipe-show', compact('recipe', 'page_title', 'meta_description'));
    }

    public function Favorites()
    {
        $products = Product::published()->orderBy('sort_order')->orderByDesc('id')->get();

        return $this->renderPage('website.favorites', 'Favorites', compact('products'));
    }

    public function KitLanding(string $page)
    {
        $kit = config("site.kit.{$page}");
        if (! $kit) {
            abort(404);
        }

        $page_title = ($kit['title'] ?? 'Sign Up') . ' | ' . site('name');
        $meta_description = $kit['subtitle'] ?? site('description');

        return view('website.kit-landing', compact('kit', 'page', 'page_title', 'meta_description'));
    }

    protected function renderPage(string $view, ?string $suffix = null, array $data = [])
    {
        $name = site('name', 'Website');
        $page_title = $suffix ? "{$suffix} | {$name}" : "{$name} — " . site('tagline', '');
        $meta_description = site('description', '');

        return view($view, array_merge(compact('page_title', 'meta_description'), $data));
    }
}
