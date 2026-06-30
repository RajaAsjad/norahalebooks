<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use HandlesContentUploads;

    public function index()
    {
        $models = Book::orderBy('sort_order')->orderByDesc('id')->paginate(15);

        return view('admin.content.index', [
            'page_title' => 'Books',
            'type' => 'book',
            'models' => $models,
            'columns' => ['title', 'featured', 'status'],
        ]);
    }

    public function create()
    {
        return view('admin.content.form', [
            'page_title' => 'Add Book',
            'type' => 'book',
            'model' => new Book(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'subtitle' => 'nullable|max:300',
            'description' => 'nullable',
            'amazon_url' => 'nullable|url|max:500',
            'other_buy_url' => 'nullable|url|max:500',
            'other_buy_label' => 'nullable|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|image|max:5120',
            'cover_image_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);

        $book = new Book();
        $book->title = $data['title'];
        $book->slug = $data['slug'] ?: $this->uniqueSlug(Book::class, $data['title']);
        $book->subtitle = $data['subtitle'] ?? null;
        $book->description = $data['description'] ?? null;
        $book->amazon_url = $data['amazon_url'] ?? null;
        $book->other_buy_url = $data['other_buy_url'] ?? null;
        $book->other_buy_label = $data['other_buy_label'] ?? null;
        $book->sort_order = $data['sort_order'] ?? 0;
        $book->featured = $request->boolean('featured');
        $book->status = $request->boolean('status', true);
        $book->meta_title = $data['meta_title'] ?? null;
        $book->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('cover_image')) {
            $book->cover_image = $this->uploadImage($request->file('cover_image'), 'books');
        } elseif (! empty($data['cover_image_url'])) {
            $book->cover_image = $data['cover_image_url'];
        }

        $book->save();

        return redirect()->route('book.index')->with('message', 'Book created.');
    }

    public function edit(Book $book)
    {
        return view('admin.content.form', [
            'page_title' => 'Edit Book',
            'type' => 'book',
            'model' => $book,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'subtitle' => 'nullable|max:300',
            'description' => 'nullable',
            'amazon_url' => 'nullable|url|max:500',
            'other_buy_url' => 'nullable|url|max:500',
            'other_buy_label' => 'nullable|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|image|max:5120',
            'cover_image_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);

        $book->title = $data['title'];
        $book->slug = $data['slug'] ?: $this->uniqueSlug(Book::class, $data['title'], $book->id);
        $book->subtitle = $data['subtitle'] ?? null;
        $book->description = $data['description'] ?? null;
        $book->amazon_url = $data['amazon_url'] ?? null;
        $book->other_buy_url = $data['other_buy_url'] ?? null;
        $book->other_buy_label = $data['other_buy_label'] ?? null;
        $book->sort_order = $data['sort_order'] ?? 0;
        $book->featured = $request->boolean('featured');
        $book->status = $request->boolean('status');
        $book->meta_title = $data['meta_title'] ?? null;
        $book->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('cover_image')) {
            $book->cover_image = $this->uploadImage($request->file('cover_image'), 'books');
        } elseif (! empty($data['cover_image_url'])) {
            $book->cover_image = $data['cover_image_url'];
        }

        $book->save();

        return redirect()->route('book.index')->with('message', 'Book updated.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('book.index')->with('message', 'Book deleted.');
    }
}
