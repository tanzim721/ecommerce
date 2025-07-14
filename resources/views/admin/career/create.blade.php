@extends('admin.layouts.index')

@section('title', 'Create New Job')

@section('name', 'Create New Job')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Create New Job</h3>
                <a href="{{ route('career.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Jobs
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Job Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employment_type">Employment Type <span class="text-danger">*</span></label>
                            <select name="employment_type" id="employment_type" class="form-control @error('employment_type') is-invalid @enderror" required>
                                <option value="">Select Employment Type</option>
                                @foreach(\App\Enums\EmploymentType::cases() as $employmentType)
                                    <option value="{{ $employmentType->value }}" {{ old('employment_type') == $employmentType->value ? 'selected' : '' }}>
                                        {{ $employmentType->getLabel() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employment_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_name">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <input type="text" name="role" id="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}" required>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apply_url">Application URL <span class="text-danger">*</span></label>
                            <input type="url" name="apply_url" id="apply_url" class="form-control @error('apply_url') is-invalid @enderror" value="{{ old('apply_url') }}" required>
                            @error('apply_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="company_logo">Company Logo</label>
                    <div class="custom-file">
                        <input type="file" name="company_logo" id="company_logo" class="custom-file-input @error('company_logo') is-invalid @enderror" accept="image/*">
                        <label class="custom-file-label" for="company_logo">Choose file</label>
                        @error('company_logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">Recommended size: 200x200 pixels. Maximum file size: 2MB.</small>
                </div>
                
                <div class="form-group">
                    <label for="description">Job Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="6" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Job
                    </button>
                    <a href="{{ route('career.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Initialize file input display
    $(document).ready(function() {
        bsCustomFileInput.init();
        
        // Optional: Add WYSIWYG editor for description
        // If you're using CKEditor or TinyMCE, initialize it here
        // For example:
        // CKEDITOR.replace('description');
    });
</script>
@endpush