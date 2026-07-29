<div class="mb-3">
    <label class="form-label fw-bold">Name *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $policyType->name ?? '') }}" required>
</div>
<div class="mb-4">
    <label class="form-label fw-bold">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $policyType->slug ?? '') }}" placeholder="Generated from name if left blank">
    <small class="text-muted">Used in policy URLs. Existing policies are updated if this changes.</small>
</div>
@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif
