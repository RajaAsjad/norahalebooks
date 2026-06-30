<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    use HandlesContentUploads;

    public function index()
    {
        $models = BlogPost::orderByDesc('published_at')->orderByDesc('id')->paginate(15);

        return view('admin.content.index', [
            'page_title' => 'Blog Posts',
            'type' => 'blog',
            'models' => $models,
            'columns' => ['title', 'published_at', 'status'],
        ]);
    }

    public function create()
    {
        return view('admin.content.form', [
            'page_title' => 'Add Blog Post',
            'type' => 'blog',
            'model' => new BlogPost(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'author' => 'nullable|max:100',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'featured_image_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);

        $post = new BlogPost();
        $post->title = $data['title'];
        $post->slug = $data['slug'] ?: $this->uniqueSlug(BlogPost::class, $data['title']);
        $post->excerpt = $data['excerpt'] ?? null;
        $post->body = $data['body'] ?? null;
        $post->author = $data['author'] ?? 'Nora Hale';
        $post->published_at = $data['published_at'] ?? now();
        $post->featured = $request->boolean('featured');
        $post->status = $request->boolean('status', true);
        $post->meta_title = $data['meta_title'] ?? null;
        $post->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('featured_image')) {
            $post->featured_image = $this->uploadImage($request->file('featured_image'), 'blog');
        } elseif (! empty($data['featured_image_url'])) {
            $post->featured_image = $data['featured_image_url'];
        }

        $post->save();

        return redirect()->route('blog-post.index')->with('message', 'Blog post created.');
    }

    public function edit(BlogPost $blog_post)
    {
        return view('admin.content.form', [
            'page_title' => 'Edit Blog Post',
            'type' => 'blog',
            'model' => $blog_post,
        ]);
    }

    public function update(Request $request, BlogPost $blog_post)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'author' => 'nullable|max:100',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'featured_image_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);

        $blog_post->title = $data['title'];
        $blog_post->slug = $data['slug'] ?: $this->uniqueSlug(BlogPost::class, $data['title'], $blog_post->id);
        $blog_post->excerpt = $data['excerpt'] ?? null;
        $blog_post->body = $data['body'] ?? null;
        $blog_post->author = $data['author'] ?? 'Nora Hale';
        $blog_post->published_at = $data['published_at'] ?? $blog_post->published_at;
        $blog_post->featured = $request->boolean('featured');
        $blog_post->status = $request->boolean('status');
        $blog_post->meta_title = $data['meta_title'] ?? null;
        $blog_post->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('featured_image')) {
            $blog_post->featured_image = $this->uploadImage($request->file('featured_image'), 'blog');
        } elseif (! empty($data['featured_image_url'])) {
            $blog_post->featured_image = $data['featured_image_url'];
        }

        $blog_post->save();

        return redirect()->route('blog-post.index')->with('message', 'Blog post updated.');
    }

    public function destroy(BlogPost $blog_post)
    {
        $blog_post->delete();

        return redirect()->route('blog-post.index')->with('message', 'Blog post deleted.');
    }
}
