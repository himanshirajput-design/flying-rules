@extends('admin.layout')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Create New Blog Post</h2>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Posts</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Title *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slug (Optional - auto-generated from title if blank)</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Excerpt *</label>
                        <textarea name="excerpt" class="form-control" rows="3" required>{{ old('excerpt') }}</textarea>
                        <small class="text-muted">A short summary displayed on the blog listing page.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Content *</label>
                        <textarea name="content" id="summernote" required>{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Publish Details</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Author *</label>
                                <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Category *</label>
                                <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Publish Date (Optional)</label>
                                <input type="date" name="published_at" class="form-control" value="{{ old('published_at', date('Y-m-d')) }}">
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light border-0">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">Featured Image</h5>
                            <div class="mb-3">
                                <input class="form-control" type="file" name="image" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Publish Post</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write your amazing blog post here...',
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
    });
</script>
@endsection
