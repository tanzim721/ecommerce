@extends('admin.layouts.index')

@section('title', 'Edit User')

@section('name', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="block bg-dark text-white p-4 rounded shadow">
        <div class="block-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-white mb-0"><i class="fa fa-user-edit me-2"></i>Edit User</h3>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light">
                        <i class="fa fa-arrow-left me-1"></i> Back to Users
                    </a>
                </div>
            </div>
        </div>
        
        <div class="block-body mt-4">
            @if (session('success'))
                <div class="alert alert-success text-dark">
                    {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="card bg-dark-subtle p-4 border-0 shadow-sm rounded-3">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label text-white fw-bold">
                                        <i class="fa fa-user me-1"></i> Full Name
                                    </label>
                                    <input type="text" class="form-control form-control-lg bg-dark text-white border-secondary" 
                                           id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label text-white fw-bold">
                                        <i class="fa fa-envelope me-1"></i> Email Address
                                    </label>
                                    <input type="email" class="form-control form-control-lg bg-dark text-white border-secondary" 
                                           id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label for="usertype" class="form-label text-white fw-bold">
                                        <i class="fa fa-user-shield me-1"></i> User Role
                                    </label>
                                    <select class="form-select form-select-lg bg-dark text-white border-secondary" 
                                            id="usertype" name="usertype">
                                        <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group d-flex justify-content-between mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fa fa-save me-2"></i> Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection