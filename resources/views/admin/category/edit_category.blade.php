@extends('admin.layouts.index')

@section('title', 'Edit Category')

@section('name', 'Category')

@section('content')
    <div class="align-items-stretch">
        <div class="page-content container-fluid d-full">
            <div class="page-header">
                <div class="container-fluid">
                    <div class="row py-2">
                        <div class="col">
                            <h2 style="color: white;">Update Category</h2>
                        </div>
                        <div class="col">
                            <div class="div_deg d-inline">
                                <form action="{{ route('category.update', $category->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="category" id="categoryInput"
                                            value="{{ $category->name }}" required style="display: inline;">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check"></i>
                                            Update Category
                                        </button>
                                    </div>
                                </form>
                                @if ($errors->has('category'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('admin.category.list')
                </div>
            </div>
        </div>
    </div>
@endSection
