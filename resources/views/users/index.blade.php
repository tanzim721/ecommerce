@extends('admin.layouts.index')

@section('title', 'User List')

@section('name', 'User List')

@section('content')
    <div class="card shadow-lg p-4 bg-dark text-white">
        <h2 class="mb-4 text-center">Users List</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered text-center" id="user-table">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
