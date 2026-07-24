@extends('admin.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Blog Posts</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Post</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" class="rounded me-3 object-fit-cover" width="50" height="50" alt="{{ $item->title }}">
                            @endif
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $item->title }}</h6>
                                <small class="text-muted">{{ $item->author }}</small>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-secondary">{{ $item->category }}</span></td>
                    <td>{{ $item->published_at ? $item->published_at->format('M d, Y') : 'Draft' }}</td>
                    <td class="text-end">
                        <a href="{{ route('blog.show', $item->slug) }}" target="_blank" class="btn btn-sm btn-outline-info me-1" title="View"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.posts.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No blog posts found. <a href="{{ route('admin.posts.create') }}">Create one now!</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection