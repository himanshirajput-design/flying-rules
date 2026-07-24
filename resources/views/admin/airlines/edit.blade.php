@extends('admin.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Airline: {{ $airline->name }}</h2>
    <a href="{{ route('admin.airlines.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Airlines</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.airlines.update', $airline->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Airline Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $airline->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug (Optional)</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $airline->slug) }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Media</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Featured Image</label>
                                @if($airline->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($airline->image) }}" class="img-fluid rounded border" alt="Current Image">
                                    </div>
                                @endif
                                <input class="form-control" type="file" name="image" accept="image/*">
                                <small class="text-muted">Upload new to replace current.</small>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Logo (Optional)</label>
                                @if($airline->logo)
                                    <div class="mb-2">
                                        <img src="{{ asset($airline->logo) }}" class="img-fluid rounded border bg-dark" alt="Current Logo" style="max-height: 100px;">
                                    </div>
                                @endif
                                <input class="form-control" type="file" name="logo" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Update Airline</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
