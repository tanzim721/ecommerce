@extends('admin.layouts.index')

@section('title', 'Edit Category')

@section('name', 'Category')

@section('content')
    <div class="container-fluid">
        <div class="block">
            <div class="block-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Edit Category</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('category.view') }}" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i> Back to Categories
                        </a>
                    </div>
                </div>
            </div>
            <div class="block-body mt-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endSection

