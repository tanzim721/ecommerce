@extends('admin.layouts.index')

@section('title', 'Category')

@section('name', 'Category')

@section('content')
    <div class="container-fluid">
        <div class="block bg-dark text-white p-4 rounded">
            <div class="block-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-white">All Categories</h3>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                            <i class="fa fa-plus"></i> Add New Category
                        </button>
                    </div>
                </div>
            </div>
            <div class="block-body mt-3">
                @if (session('success'))
                    <div class="alert alert-success text-dark">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover text-white">
                        <thead>
                            <tr>
                                <th class="text-white">#</th>
                                <th class="text-white">Name</th>
                                <th class="text-white">Created At</th>
                                <th class="text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                            <tr>
                                <td class="text-white">{{ $key + 1 }}</td>
                                <td class="text-white">{{ $category->name }}</td>
                                <td class="text-white">{{ $category->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-info rounded-circle" 
                                    style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <!-- Direct delete link without JavaScript -->
                                    <a href="{{ route('category.delete', $category->id) }}" class="btn btn-sm btn-danger rounded-circle delete-btn" 
                                    style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-dark text-white">
                <form action="{{ route('category.add') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this script at the bottom of your file -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // Check if SweetAlert is already defined
        if (typeof swal === 'undefined') {
            document.write('<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"><\/script>');
        }
        
        // Add the confirmation function if not already defined
        if (typeof confirmation !== 'function') {
            function confirmation(ev) {
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this category",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = urlToRedirect;
                    }
                });
            }
            
            // Add event listeners to all delete buttons
            document.addEventListener('DOMContentLoaded', function() {
                var deleteButtons = document.querySelectorAll('.delete-btn');
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', confirmation);
                });
            });
        }
    </script>
@endsection