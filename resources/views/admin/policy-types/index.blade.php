@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Policy Types</h2>
    <a href="{{ route('admin.policy-types.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Policy Type</a>
</div>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead class="table-light">
                <tr><th>ID</th><th>Name</th><th>Slug</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($policyTypes as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td class="fw-bold">{{ $item->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $item->slug }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.policy-types.edit', $item) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.policy-types.destroy', $item) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this policy type?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4 text-muted">No policy types found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
