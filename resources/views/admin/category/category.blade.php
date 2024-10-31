@extends('admin.layouts.index')

@section('content')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="row py-2">
                    <div class="col">
                        <h2 style="color: white;">Add Category</h2>
                    </div>
                    <div class="col">
                        <div class="div_deg d-inline">
                            <form action="{{ route('category.add') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="category" id="categoryInput" placeholder="Category Name"
                                        required class="form-control" style="display: inline;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                        Add Category
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

        @include('admin.layouts.footer')
    </div>
@endsection
