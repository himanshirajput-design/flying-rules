@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Policy Type</h2>
    <a href="{{ route('admin.policy-types.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Back to Policy Types</a>
</div>
<div class="card shadow-sm border-0"><div class="card-body p-4">
    <form action="{{ route('admin.policy-types.store') }}" method="POST">
        @csrf
        @include('admin.policy-types.form')
        <button class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Policy Type</button>
    </form>
</div></div>
@endsection
