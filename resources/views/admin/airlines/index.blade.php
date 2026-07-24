@extends('admin.layout')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Airlines</h2>
    <a href="{{ route('admin.airlines.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add New Airline</a>
</div>
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name / Image</th>
                    <th>Slug</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($airlines as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($item->image)
                                <img src="{{ asset($item->image) }}" class="rounded me-3 object-fit-cover" width="50" height="50" alt="{{ $item->name }}">
                            @else
                                <div class="rounded me-3 bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 50px; height: 50px;">
                                    <i class="fas fa-plane"></i>
                                </div>
                            @endif
                            <h6 class="mb-0 fw-bold">{{ $item->name }}</h6>
                        </div>
                    </td>
                    <td><span class="badge bg-light text-dark border">{{ $item->slug }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('cancellation.show', $item->slug) }}" target="_blank" class="btn btn-sm btn-outline-info me-1" title="View on Site"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.airlines.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.airlines.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this airline? This will also delete ALL related policies!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No airlines found. <a href="{{ route('admin.airlines.create') }}">Create one now!</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection