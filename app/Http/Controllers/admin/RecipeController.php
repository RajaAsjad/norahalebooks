<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    use HandlesContentUploads;

    public function index()
    {
        $models = Recipe::orderByDesc('id')->paginate(15);

        return view('admin.content.index', [
            'page_title' => 'Recipes',
            'type' => 'recipe',
            'models' => $models,
            'columns' => ['title', 'prep_time', 'status'],
        ]);
    }

    public function create()
    {
        return view('admin.content.form', [
            'page_title' => 'Add Recipe',
            'type' => 'recipe',
            'model' => new Recipe(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'excerpt' => 'nullable',
            'ingredients' => 'nullable',
            'instructions' => 'nullable',
            'prep_time' => 'nullable|max:50',
            'cook_time' => 'nullable|max:50',
            'servings' => 'nullable|integer|min:1',
            'featured_image' => 'nullable|image|max:5120',
            'featured_image_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);

        $recipe = new Recipe();
        $recipe->title = $data['title'];
        $recipe->slug = $data['slug'] ?: $this->uniqueSlug(Recipe::class, $data['title']);
        $recipe->excerpt = $data['excerpt'] ?? null;
        $recipe->ingredients = $data['ingredients'] ?? null;
        $recipe->instructions = $data['instructions'] ?? null;
        $recipe->prep_time = $data['prep_time'] ?? null;
        $recipe->cook_time = $data['cook_time'] ?? null;
        $recipe->servings = $data['servings'] ?? null;
        $recipe->featured = $request->boolean('featured');
        $recipe->status = $request->boolean('status', true);
        $recipe->meta_title = $data['meta_title'] ?? null;
        $recipe->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('featured_image')) {
            $recipe->featured_image = $this->uploadImage($request->file('featured_image'), 'recipes');
        } elseif (! empty($data['featured_image_url'])) {
            $recipe->featured_image = $data['featured_image_url'];
        }

        $recipe->save();

        return redirect()->route('recipe.index')->with('message', 'Recipe created.');
    }

    public function edit(Recipe $recipe)
    {
        return view('admin.content.form', [
            'page_title' => 'Edit Recipe',
            'type' => 'recipe',
            'model' => $recipe,
        ]);
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'title' => 'required|max:200',
            'slug' => 'nullable|max:200',
            'excerpt' => 'nullable',
            'ingredients' => 'nullable',
            'instructions' => 'nullable',
            'prep_time' => 'nullable|max:50',
            'cook_time' => 'nullable|max:50',
            'servings' => 'nullable|integer|min:1',
            'featured_image' => 'nullable|image|max:5120',
            'featured_image_url' => 'nullable|url|max:500',
            'meta_title' => 'nullable|max:200',
            'meta_description' => 'nullable|max:300',
        ]);

        $recipe->title = $data['title'];
        $recipe->slug = $data['slug'] ?: $this->uniqueSlug(Recipe::class, $data['title'], $recipe->id);
        $recipe->excerpt = $data['excerpt'] ?? null;
        $recipe->ingredients = $data['ingredients'] ?? null;
        $recipe->instructions = $data['instructions'] ?? null;
        $recipe->prep_time = $data['prep_time'] ?? null;
        $recipe->cook_time = $data['cook_time'] ?? null;
        $recipe->servings = $data['servings'] ?? null;
        $recipe->featured = $request->boolean('featured');
        $recipe->status = $request->boolean('status');
        $recipe->meta_title = $data['meta_title'] ?? null;
        $recipe->meta_description = $data['meta_description'] ?? null;

        if ($request->hasFile('featured_image')) {
            $recipe->featured_image = $this->uploadImage($request->file('featured_image'), 'recipes');
        } elseif (! empty($data['featured_image_url'])) {
            $recipe->featured_image = $data['featured_image_url'];
        }

        $recipe->save();

        return redirect()->route('recipe.index')->with('message', 'Recipe updated.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipe.index')->with('message', 'Recipe deleted.');
    }
}
