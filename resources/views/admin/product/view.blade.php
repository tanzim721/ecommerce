@extends('admin.layouts.index')

@section('title', 'Product')

@section('name', 'Product')

@section('content')
    <div class="align-items-stretch">
        <div class="page-content container-fluid d-full">
            <div class="page-header">
                <div class="container-fluid">
                    <div class="row py-2">
                        <div class="col">
                            <h1 style="color: white; font-size: 30px;" class="text-bold">Add Product</h1>
                        </div>
                        <div class="col">
                            <div class="div_deg d-inline">
                                <div class="form-group float-right">
                                    {{-- <input type="text" name="category" id="categoryInput" placeholder="Search" required class="form-control" style="display: inline;" class="fa fa-search"> --}}
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        <a href="{{ route('admin.product.add') }}"
                                            style="color: white; text-decoration: none">Add Product</a>
                                    </button>
                                </div>
                                @if ($errors->has('product'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('admin.product.list')
                </div>
            </div>

        </div>
    </div>

@endsection
