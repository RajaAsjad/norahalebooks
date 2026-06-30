@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@php
    $routes = [
        'blog' => ['store' => 'blog-post.store', 'update' => 'blog-post.update', 'index' => 'blog-post.index'],
        'recipe' => ['store' => 'recipe.store', 'update' => 'recipe.update', 'index' => 'recipe.index'],
        'product' => ['store' => 'product.store', 'update' => 'product.update', 'index' => 'product.index'],
        'book' => ['store' => 'book.store', 'update' => 'book.update', 'index' => 'book.index'],
    ];
    $r = $routes[$type];
    $isEdit = $model->exists;
    $action = $isEdit ? route($r['update'], $model) : route($r['store']);
    $imageField = in_array($type, ['blog', 'recipe']) ? 'featured_image' : ($type === 'book' ? 'cover_image' : 'image');
    $imageUrlField = $imageField . '_url';
@endphp

<section class="content-header">
    <div class="content-header-left"><h1>{{ $page_title }}</h1></div>
    <div class="content-header-right">
        <a href="{{ route($r['index']) }}" class="btn btn-default btn-sm">Back to List</a>
    </div>
</section>

<section class="content">
    <div class="box box-primary">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Title *</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{ old('title', $model->title) }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">URL Slug</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $model->slug) }}" placeholder="auto-generated from title">
                    </div>
                </div>

                @if($type === 'book')
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subtitle</label>
                        <div class="col-sm-10"><input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $model->subtitle) }}"></div>
                    </div>
                @endif

                @if(in_array($type, ['blog', 'recipe', 'book']))
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ $type === 'book' ? 'Description' : ($type === 'blog' ? 'Excerpt' : 'Excerpt') }}</label>
                        <div class="col-sm-10">
                            @if($type === 'book')
                                <textarea name="description" class="form-control" rows="6">{{ old('description', $model->description) }}</textarea>
                            @elseif($type === 'blog')
                                <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $model->excerpt) }}</textarea>
                                <label class="control-label" style="margin-top:12px">Body (HTML allowed)</label>
                                <textarea name="body" class="form-control" rows="12">{{ old('body', $model->body) }}</textarea>
                            @else
                                <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $model->excerpt) }}</textarea>
                            @endif
                        </div>
                    </div>
                @endif

                @if($type === 'recipe')
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Ingredients</label>
                        <div class="col-sm-10"><textarea name="ingredients" class="form-control" rows="6" placeholder="One per line">{{ old('ingredients', $model->ingredients) }}</textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Instructions</label>
                        <div class="col-sm-10"><textarea name="instructions" class="form-control" rows="8">{{ old('instructions', $model->instructions) }}</textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Prep / Cook / Servings</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-4"><input type="text" name="prep_time" class="form-control" placeholder="Prep time" value="{{ old('prep_time', $model->prep_time) }}"></div>
                                <div class="col-sm-4"><input type="text" name="cook_time" class="form-control" placeholder="Cook time" value="{{ old('cook_time', $model->cook_time) }}"></div>
                                <div class="col-sm-4"><input type="number" name="servings" class="form-control" placeholder="Servings" value="{{ old('servings', $model->servings) }}"></div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($type === 'product')
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10"><textarea name="description" class="form-control" rows="4">{{ old('description', $model->description) }}</textarea></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10"><input type="text" name="category" class="form-control" value="{{ old('category', $model->category) }}" placeholder="e.g. Kitchen, Wellness"></div>
                    </div>
                @endif

                @if(in_array($type, ['book', 'product']))
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Amazon Buy URL</label>
                        <div class="col-sm-10"><input type="url" name="amazon_url" class="form-control" value="{{ old('amazon_url', $model->amazon_url) }}" placeholder="https://amazon.com/..."></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Other Buy URL / Label</label>
                        <div class="col-sm-10">
                            <input type="url" name="{{ $type === 'book' ? 'other_buy_url' : 'other_url' }}" class="form-control" value="{{ old($type === 'book' ? 'other_buy_url' : 'other_url', $type === 'book' ? $model->other_buy_url : $model->other_url) }}" placeholder="Optional second marketplace">
                            <input type="text" name="{{ $type === 'book' ? 'other_buy_label' : 'other_label' }}" class="form-control" style="margin-top:8px" value="{{ old($type === 'book' ? 'other_buy_label' : 'other_label', $type === 'book' ? $model->other_buy_label : $model->other_label) }}" placeholder="Button label e.g. Buy on Barnes & Noble">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Sort Order</label>
                        <div class="col-sm-10"><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $model->sort_order ?? 0) }}"></div>
                    </div>
                @endif

                @if($type === 'blog')
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Author / Published</label>
                        <div class="col-sm-10">
                            <input type="text" name="author" class="form-control" value="{{ old('author', $model->author ?: 'Nora Hale') }}" style="margin-bottom:8px">
                            <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $model->published_at ? $model->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" name="{{ $imageField }}" class="form-control" accept="image/*">
                        <input type="url" name="{{ $imageUrlField }}" class="form-control" style="margin-top:8px" placeholder="Or paste image URL" value="{{ old($imageUrlField, str_starts_with($model->{$imageField} ?? '', 'http') ? $model->{$imageField} : '') }}">
                        @if($model->{$imageField})
                            @php $imgUrl = method_exists($model, 'coverUrl') ? $model->coverUrl() : (method_exists($model, 'imageUrl') ? $model->imageUrl() : null); @endphp
                            @if($imgUrl)<img src="{{ $imgUrl }}" alt="" style="max-height:80px;margin-top:8px;border-radius:6px">@endif
                        @endif
                    </div>
                </div>

                @if(in_array($type, ['blog', 'recipe', 'book']))
                    <div class="form-group">
                        <label class="col-sm-2 control-label">SEO</label>
                        <div class="col-sm-10">
                            <input type="text" name="meta_title" class="form-control" placeholder="Meta title" value="{{ old('meta_title', $model->meta_title) }}" style="margin-bottom:8px">
                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Meta description">{{ old('meta_description', $model->meta_description) }}</textarea>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label">Options</label>
                    <div class="col-sm-10">
                        <label><input type="checkbox" name="featured" value="1" {{ old('featured', $model->featured) ? 'checked' : '' }}> Featured</label>
                        &nbsp;&nbsp;
                        <label><input type="checkbox" name="status" value="1" {{ old('status', $model->exists ? $model->status : true) ? 'checked' : '' }}> Published / Active</label>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
</section>
@endsection
