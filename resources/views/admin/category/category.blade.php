@extends('admin.layouts.index')

@section('title', 'Category')

@section('name', 'Category')

@section('content')
    <div class="align-items-stretch">
        <div class="page-content container-fluid d-full">
            <div class="page-header">
                <div class="container-fluid">
                    <div class="row py-2">
                        <div class="col">
                            <h2 style="color: white;">{{ isset($category) ? 'Update' : 'Add' }} Category</h2>
                        </div>
                        <div class="col">
                            <div class="div_deg d-inline">
                                <div class="input-group">
                                    <input type="text" name="category" id="categoryInput" placeholder="Category Name"
                                        required class="form-control" style="display: inline;" value="{{ old('category', isset($category) ? $category->name : '') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-plus"></i>
                                            {{ isset($category) ? 'Update' : 'Add' }} Category
                                        </button>
                                    </div>
                                </div>
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
@endsection

