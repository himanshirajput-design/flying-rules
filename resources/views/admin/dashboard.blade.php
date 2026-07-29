@extends('admin.layout')
@section('page_title', 'Dashboard Overview')

@section('content')
<!-- Welcome Banner -->
<div class="card border-0 mb-5 text-white overflow-hidden" style="border-radius: 20px; background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">
    <div class="position-absolute top-0 end-0 h-100 w-50" style="background: url('https://www.transparenttextures.com/patterns/cubes.png'); opacity: 0.1;"></div>
    <div class="card-body p-5 position-relative z-index-1">
        <h2 class="fw-bold mb-2">Welcome back, Admin! 👋</h2>
        <p class="lead mb-4 opacity-75">Here is what is happening with your travel policies today.</p>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-light text-primary fw-bold px-4 rounded-pill shadow-sm">Write a new post</a>
    </div>
</div>

<!-- Quick Stats -->
<h5 class="fw-bold text-muted mb-4">Quick Statistics</h5>
<div class="row g-4 mb-5">
    <!-- Airlines Stat -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px;">
                    <i class="fas fa-plane-departure fs-4"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 fw-medium text-uppercase text-xs" style="letter-spacing: 1px; font-size: 0.8rem;">Total Airlines</p>
                    <h3 class="fw-bold mb-0 text-dark">{{\App\Models\Airline::count()}}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4">
                <a href="{{ route('admin.airlines.index') }}" class="text-primary text-decoration-none fw-medium small d-flex align-items-center group">
                    Manage Airlines <i class="fas fa-arrow-right ms-2 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Policies Stat -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px;">
                    <i class="fas fa-file-contract fs-4"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 fw-medium text-uppercase text-xs" style="letter-spacing: 1px; font-size: 0.8rem;">Total Policies</p>
                    <h3 class="fw-bold mb-0 text-dark">{{\App\Models\Policy::count()}}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4">
                <a href="{{ route('admin.policies.index') }}" class="text-success text-decoration-none fw-medium small d-flex align-items-center group">
                    Manage Policies <i class="fas fa-arrow-right ms-2 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Policy Types Stat -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px;">
                    <i class="fas fa-tags fs-4"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 fw-medium text-uppercase text-xs" style="letter-spacing: 1px; font-size: 0.8rem;">Policy Types</p>
                    <h3 class="fw-bold mb-0 text-dark">{{ \App\Models\PolicyType::count() }}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4">
                <a href="{{ route('admin.policy-types.index') }}" class="text-info text-decoration-none fw-medium small d-flex align-items-center group">
                    Manage Types <i class="fas fa-arrow-right ms-2 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Posts Stat -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center me-4" style="width: 60px; height: 60px;">
                    <i class="fas fa-blog fs-4"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 fw-medium text-uppercase text-xs" style="letter-spacing: 1px; font-size: 0.8rem;">Published Posts</p>
                    <h3 class="fw-bold mb-0 text-dark">{{\App\Models\Post::count()}}</h3>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4">
                <a href="{{ route('admin.posts.index') }}" class="text-warning text-decoration-none fw-medium small d-flex align-items-center group">
                    Manage Blog <i class="fas fa-arrow-right ms-2 transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold text-dark">Recently Added Policies</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Airline</th>
                                <th>Policy Type</th>
                                <th class="text-end pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Policy::with('airline')->latest()->take(5)->get() as $policy)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($policy->airline->image)
                                            <img src="{{ asset($policy->airline->image) }}" class="rounded me-3 object-fit-cover" width="30" height="30">
                                        @endif
                                        <span class="fw-medium">{{ $policy->airline->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border text-capitalize px-3 py-2 rounded-pill">{{ str_replace('-', ' ', $policy->type) }}</span>
                                </td>
                                <td class="text-end pe-4 text-muted small">{{ $policy->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold text-dark">Latest Blog Posts</h5>
            </div>
            <div class="card-body p-4">
                @forelse(\App\Models\Post::latest()->take(3)->get() as $post)
                    <div class="d-flex align-items-center mb-4 {{ $loop->last ? 'mb-0' : '' }}">
                        <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-primary fw-bold me-3" style="width: 50px; height: 50px;">
                            {{ $post->published_at ? $post->published_at->format('d') : 'D' }}
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark text-truncate" style="max-width: 200px;">{{ $post->title }}</h6>
                            <small class="text-muted d-block">{{ $post->category }}</small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No posts found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
