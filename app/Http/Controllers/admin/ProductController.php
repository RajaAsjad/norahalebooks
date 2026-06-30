<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HandlesContentUploads;

    public function index()
    {
        $models = Product::orderBy('sort_order')->orderByDesc('id')->paginate(15);

        return view('admin.content.index', [
            'page_title' => 'Favorites / Products',
            'type' => 'product',
            'models' => $models,
            'columns' => ['title', 'category', 'status'],
        ]);
    }

    public function create()
    {
        return view('admin.content.form', [
            'page_title' => 'Add Product',
            'type' => 'product',
            'model' => new Product(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'description' => 'nullable',
            'category' => 'nullable|max:100',
            'amazon_url' => 'nullable|url|max:500',
            'other_url' => 'nullable|url|max:500',
            'other_label' => 'nullable|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
        ]);

        $product = new Product();
        $product->title = $data['title'];
        $product->slug = $data['slug'] ?: $this->uniqueSlug(Product::class, $data['title']);
        $product->description = $data['description'] ?? null;
        $product->category = $data['category'] ?? null;
        $product->amazon_url = $data['amazon_url'] ?? null;
        $product->other_url = $data['other_url'] ?? null;
        $product->other_label = $data['other_label'] ?? null;
        $product->sort_order = $data['sort_order'] ?? 0;
        $product->featured = $request->boolean('featured');
        $product->status = $request->boolean('status', true);

        if ($request->hasFile('image')) {
            $product->image = $this->uploadImage($request->file('image'), 'products');
        } elseif (! empty($data['image_url'])) {
            $product->image = $data['image_url'];
        }

        $product->save();

        return redirect()->route('product.index')->with('message', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.content.form', [
            'page_title' => 'Edit Product',
            'type' => 'product',
            'model' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'description' => 'nullable',
            'category' => 'nullable|max:100',
            'amazon_url' => 'nullable|url|max:500',
            'other_url' => 'nullable|url|max:500',
            'other_label' => 'nullable|max:100',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
        ]);

        $product->title = $data['title'];
        $product->slug = $data['slug'] ?: $this->uniqueSlug(Product::class, $data['title'], $product->id);
        $product->description = $data['description'] ?? null;
        $product->category = $data['category'] ?? null;
        $product->amazon_url = $data['amazon_url'] ?? null;
        $product->other_url = $data['other_url'] ?? null;
        $product->other_label = $data['other_label'] ?? null;
        $product->sort_order = $data['sort_order'] ?? 0;
        $product->featured = $request->boolean('featured');
        $product->status = $request->boolean('status');

        if ($request->hasFile('image')) {
            $product->image = $this->uploadImage($request->file('image'), 'products');
        } elseif (! empty($data['image_url'])) {
            $product->image = $data['image_url'];
        }

        $product->save();

        return redirect()->route('product.index')->with('message', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('message', 'Product deleted.');
    }
}
