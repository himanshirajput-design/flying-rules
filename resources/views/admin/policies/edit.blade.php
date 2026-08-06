@extends('admin.layout')



@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Policy: {{ $policy->airline->name }} ({{ ucwords(str_replace('-', ' ', $policy->type)) }})</h2>
    <a href="{{ route('admin.policies.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Policies</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.policies.update', $policy->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Airline *</label>
                        <select name="airline_id" class="form-select" required>
                            <option value="">Select Airline...</option>
                            @foreach($airlines as $airline)
                                <option value="{{ $airline->id }}" {{ old('airline_id', $policy->airline_id) == $airline->id ? 'selected' : '' }}>{{ $airline->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Policy Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="">Select Type...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->slug }}" {{ old('type', $policy->type) == $type->slug ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Update Policy</button>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Policy Content *</label>
                        <textarea name="content" id="editor" required>{!! old('content', $policy->content) !!}</textarea>
                    </div>
                </div>
            </div>
            @include('admin.policies.partials.faqs')
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace('editor', {
            height: 400
        });
    });
</script>
@endsection
