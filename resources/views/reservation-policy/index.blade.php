@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero position-relative d-flex align-items-center" style="min-height: 40vh; background: url('{{ asset('images/new_hero_banner_1783530882696.png') }}') no-repeat center center/cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.7);"></div>
    <div class="container position-relative text-white" data-aos="fade-up">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-3">Reservation Policy Policies</h1>
            <div class="breadcrumb text-light fs-5 opacity-75">
                <a href="/" class="text-white text-decoration-none hover-cyan">FlightRules</a> &nbsp;&gt;&nbsp; <span>Reservation Policy Policies</span>
            </div>
        </div>
    </div>
</section>

<!-- Policies Grid Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-6 fw-bold text-dark-blue">Select an Airline</h2>
            <p class="text-muted">Find specific Reservation Policy rules, fees, and procedures for your airline.</p>
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
@endsection
