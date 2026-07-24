@extends('admin.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Airline</h2>
    <a href="{{ route('admin.airlines.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Airlines</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.airlines.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Airline Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug (Optional - auto-generated from name if blank)</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                        <small class="text-muted">E.g., "american-airlines". Used in the URL.</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Media</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Featured Image</label>
                                <input class="form-control" type="file" name="image" accept="image/*">
                                <small class="text-muted">Used on the policy detail pages.</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Logo (Optional)</label>
                                <input class="form-control" type="file" name="logo" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Save Airline</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
