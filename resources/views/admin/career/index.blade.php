@extends('admin.layouts.index')

@section('title', 'Manage Job Listings')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Manage Career Jobs</h4>
                    <div class="card-tools">
                        <a href="{{ route('career.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Add New Job
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Filters Section -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="employment-type-filter" class="form-control">
                            <option value="">All Employment Types</option>
                            @if (isset($employmentTypes))
                                @foreach ($employmentTypes as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="role-filter" class="form-control">
                            <option value="">All Roles</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" id="search-input" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button id="apply-filters" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DataTable -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jobs-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Logo</th>
                                <th>Role</th>
                                <th>Employment Type</th>
                                <th>Salary</th>
                                <th>Description</th>
                                <th>Apply URL</th>
                                <th>Status</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->company_name }}</td>
                                    <td>
                                        @if ($job->company_logo)
                                            <img src="{{ asset($job->company_logo) }}" alt="Company Logo"
                                                class="img-fluid" style="max-width: 100px;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $job->role }}</td>
                                    <td>{{ $job->employment_type }}</td>
                                    <td>{{ $job->salary }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-description"
                                            data-description="{{ $job->description }}">View Description</button>
                                    </td>
                                    <td><a href="{{ $job->apply_url }}" target="_blank">Apply Now</a></td>
                                    <td>{{ $job->status ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('career.edit', $job->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <button class="btn btn-danger btn-sm delete-job"
                                            data-id="{{ $job->id }}"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Description Modal -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Job Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="descriptionModalBody">
                    <!-- Description will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this job posting? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
