@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero position-relative d-flex align-items-center" style="min-height: 60vh; background: url('{{ asset('images/new_hero_banner_1783530882696.png') }}') no-repeat center center/cover;">
    <!-- Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.6);"></div>
    <div class="container position-relative text-white" data-aos="fade-up">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-3">Name Change Policy</h1>
            <div class="breadcrumb text-light fs-5 opacity-75">
                <a href="/" class="text-white text-decoration-none hover-cyan">FlightRules</a> &nbsp;&gt;&nbsp; <span>Name Change</span>
            </div>
        </div>
    </div>
</section>

<!-- Airline Policies Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold text-dark-blue">Explore Airline Policies</h2>
            <p class="text-muted">Select an airline below to view their specific policies.</p>
        </div>
        
        <div class="row g-4">
            @foreach($airlines as $airline)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <a href="{{ $airline['link'] }}" class="text-decoration-none">
                    <div class="card premium-card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-img-top-wrap" style="height: 220px; overflow: hidden;">
                            <img src="{{ $airline['image'] }}" class="w-100 h-100 object-fit-cover transition-scale" alt="{{ $airline['name'] }}">
                        </div>
                        <div class="card-body p-4 text-center d-flex align-items-center justify-content-center">
                            <h5 class="card-title text-dark-blue fw-bold m-0">{{ $airline['name'] }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
            <div class="custom-pagination">
                @if ($airlines->onFirstPage())
                    <span class="page-link disabled">&laquo; Previous</span>
                @else
                    <a href="{{ $airlines->previousPageUrl() }}" class="page-link">&laquo; Previous</a>
                @endif

                @foreach ($airlines->getUrlRange(1, $airlines->lastPage()) as $page => $url)
                    @if ($page == $airlines->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($airlines->hasMorePages())
                    <a href="{{ $airlines->nextPageUrl() }}" class="page-link">Next &raquo;</a>
                @else
                    <span class="page-link disabled">Next &raquo;</span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Premium Services Section -->
<section class="pb-5 bg-light">
    <div class="container pb-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold text-dark-blue">Our Premium Services</h2>
            <p class="text-muted">Experience travel policy management at its finest.</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="service-card text-center p-5 rounded-4 shadow-sm bg-white h-100">
                    <div class="icon-wrap mb-4 mx-auto bg-light-cyan text-cyan rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="{{ $service['icon'] }}"></i>
                    </div>
                    <h4 class="fw-bold mb-3 text-dark-blue">{{ $service['title'] }}</h4>
                    <p class="text-muted mb-0">{{ $service['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 bg-dark-blue text-white" style="background-image: url('{{ asset('images/service_lounge_1783532205411.png') }}'); background-size: cover; background-position: center; background-attachment: fixed; position: relative;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.85);"></div>
    <div class="container py-5 position-relative">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold">What Our Travelers Say</h2>
            <p class="text-light opacity-75">Join thousands of satisfied premium travelers.</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimonial-card bg-white text-dark p-4 rounded-4 h-100 position-relative shadow">
                    <i class="fas fa-quote-left text-cyan opacity-25 position-absolute top-0 start-0 m-3" style="font-size: 3rem;"></i>
                    <p class="fst-italic mb-4 mt-5 position-relative z-1">"{{ $testimonial['quote'] }}"</p>
                    <div class="d-flex align-items-center">
                        <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" class="rounded-circle me-3 object-fit-cover shadow-sm" style="width: 60px; height: 60px;">
                        <div>
                            <h6 class="fw-bold mb-1 text-dark-blue">{{ $testimonial['name'] }}</h6>
                            <small class="text-cyan fw-bold">{{ $testimonial['role'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
