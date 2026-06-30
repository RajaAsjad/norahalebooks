@extends('layouts.admin.app')
@section('title', $page_title)
@section('content')
@php
    $routes = [
        'blog' => ['index' => 'blog-post.index', 'create' => 'blog-post.create', 'edit' => 'blog-post.edit', 'destroy' => 'blog-post.destroy'],
        'recipe' => ['index' => 'recipe.index', 'create' => 'recipe.create', 'edit' => 'recipe.edit', 'destroy' => 'recipe.destroy'],
        'product' => ['index' => 'product.index', 'create' => 'product.create', 'edit' => 'product.edit', 'destroy' => 'product.destroy'],
        'book' => ['index' => 'book.index', 'create' => 'book.create', 'edit' => 'book.edit', 'destroy' => 'book.destroy'],
    ];
    $r = $routes[$type];
@endphp

<section class="content-header">
    <div class="content-header-left"><h1>{{ $page_title }}</h1></div>
    <div class="content-header-right">
        <a href="{{ route($r['create']) }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</a>
    </div>
</section>

<section class="content">
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="box box-primary">
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach($columns as $col)
                            <th>{{ ucfirst(str_replace('_', ' ', $col)) }}</th>
                        @endforeach
                        <th width="140">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            @foreach($columns as $col)
                                <td>
                                    @if($col === 'status' || $col === 'featured')
                                        {{ $model->{$col} ? 'Yes' : 'No' }}
                                    @elseif($col === 'published_at')
                                        {{ $model->published_at ? $model->published_at->format('M j, Y') : '—' }}
                                    @else
                                        {{ $model->{$col} ?? '—' }}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <a href="{{ route($r['edit'], $model) }}" class="btn btn-primary btn-xs">Edit</a>
                                <form action="{{ route($r['destroy'], $model) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this item?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($columns) + 2 }}" class="text-center">No items yet. <a href="{{ route($r['create']) }}">Add one</a>.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $models->links() }}
        </div>
    </div>
</section>
@endsection
