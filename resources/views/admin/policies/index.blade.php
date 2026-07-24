@extends('admin.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Policies</h2>
    <a href="{{ route('admin.policies.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Policy</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Airline</th>
                    <th>Policy Type</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($policies as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($item->airline->image)
                                <img src="{{ asset($item->airline->image) }}" class="rounded me-3 object-fit-cover" width="30" height="30" alt="{{ $item->airline->name }}">
                            @endif
                            <span class="fw-bold">{{ $item->airline->name }}</span>
                        </div>
                    </td>
                    <td><span class="badge bg-secondary text-capitalize">{{ str_replace('-', ' ', $item->type) }}</span></td>
                    <td class="text-end">
                        <a href="{{ route($item->type . '.show', $item->airline->slug) }}" target="_blank" class="btn btn-sm btn-outline-info me-1" title="View on Site"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.policies.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.policies.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this policy?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No policies found. <a href="{{ route('admin.policies.create') }}">Create one now!</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection