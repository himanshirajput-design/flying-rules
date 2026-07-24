@extends('admin.layout')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Policy</h2>
    <a href="{{ route('admin.policies.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Policies</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.policies.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Airline *</label>
                        <select name="airline_id" class="form-select" required>
                            <option value="">Select Airline...</option>
                            @foreach($airlines as $airline)
                                <option value="{{ $airline->id }}" {{ old('airline_id') == $airline->id ? 'selected' : '' }}>{{ $airline->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Policy Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="">Select Type...</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ ucwords(str_replace('-', ' ', $type)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Save Policy</button>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Policy Content *</label>
                        <textarea name="content" id="summernote" required>{!! old('content', view('admin.policies.template')->render()) !!}</textarea>
                    </div>
                </div>
            </div>
            @include('admin.policies.partials.faqs')
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write the policy details here...',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('form').on('submit', function() {
            if ($('.note-editor').hasClass('codeview')) {
                $('#summernote').val($('.note-codable').val());
            }
        });
    });
</script>
@endsection
