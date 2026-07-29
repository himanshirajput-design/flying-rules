@extends('website.layouts.app')

@section('content')
<section class="hero position-relative d-flex align-items-center" style="min-height: 40vh; background: url('{{ asset('images/new_hero_banner_1783530882696.png') }}') no-repeat center center/cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.7);"></div>
    <div class="container position-relative text-white" data-aos="fade-up">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-3">{{ $airlineModel->name }}</h1>
            <div class="breadcrumb text-light fs-5 opacity-75">
                <a href="{{ route('home') }}" class="text-white text-decoration-none hover-cyan">FlightRules</a>
                &nbsp;&gt;&nbsp; <span>{{ $airlineModel->name }} Policies</span>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            @if($airlineModel->image)
                <img src="{{ asset($airlineModel->image) }}" alt="{{ $airlineModel->name }}" class="rounded-4 shadow-sm mb-4 object-fit-cover" width="120" height="120">
            @endif
            <h2 class="display-6 fw-bold text-dark-blue">Available Policies</h2>
            <p class="text-muted">View all policies currently published for {{ $airlineModel->name }}.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($policies as $policy)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ $policy['link'] }}" class="text-decoration-none">
                        <div class="card premium-card h-100 border-0 shadow-sm rounded-4">
                            <div class="card-body p-4 text-center">
                                <i class="fas fa-file-alt text-cyan fs-1 mb-3"></i>
                                <h3 class="h5 text-dark-blue fw-bold mb-2">{{ $policy['title'] }}</h3>
                                <span class="text-primary fw-medium">View Policy <i class="fas fa-arrow-right ms-1"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-lg-7">
                    <div class="alert alert-info text-center mb-0">No policies have been created for this airline yet.</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
