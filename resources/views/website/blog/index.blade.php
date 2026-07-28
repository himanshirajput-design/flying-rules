@extends('website.layouts.app')

@section('content')
    <!-- Blog Hero Section -->
    <section class="hero position-relative d-flex align-items-center"
        style="min-height: 40vh; background: linear-gradient(135deg, #0b1121 0%, #1a2942 100%);">
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: url('{{ asset('images/flight_photo_3_1783531118314.png') }}') no-repeat center center/cover; opacity: 0.2; mix-blend-mode: overlay;">
        </div>
        <div class="container position-relative text-white text-center" data-aos="fade-up">
            <span class="badge bg-cyan text-dark-blue px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm"
                style="letter-spacing: 1px;">OUR JOURNAL</span>
            <h1 class="display-4 fw-bold mb-3">Travel Blog & Insights</h1>
            <p class="lead opacity-75 mx-auto mb-0" style="max-width: 600px;">
                Expert advice, travel hacks, and everything you need to know to fly smarter.
            </p>
        </div>
    </section>

    <!-- Blog Grid Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">

            <!-- Search and Filter Bar -->
            <div class="row mb-5 pb-3 border-bottom g-3 align-items-center" data-aos="fade-up">
                <div class="col-md-6">
                    <h4 class="fw-bold text-dark-blue mb-0">Latest Articles</h4>
                </div>
                <div class="col-md-6">
                    <form class="d-flex position-relative">
                        <input class="form-control rounded-pill pe-5 shadow-sm border-0 py-2" type="search"
                            placeholder="Search articles..." aria-label="Search">
                        <button
                            class="btn position-absolute end-0 top-0 h-100 px-4 rounded-pill border-0 text-cyan hover-cyan bg-transparent shadow-none"
                            type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Posts Grid -->
            <div class="row g-4">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article
                            class="card premium-card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white d-flex flex-column">
                            <div class="position-relative">
                                <a href="{{ $post['link'] }}" class="d-block card-img-top-wrap"
                                    style="height: 240px; overflow: hidden;">
                                    <img src="{{ $post['image'] }}" class="w-100 h-100 object-fit-cover transition-scale"
                                        alt="{{ $post['title'] }}">
                                </a>
                                <span
                                    class="badge bg-white text-cyan position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill shadow-sm fw-bold">
                                    {{ $post['category'] }}
                                </span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex align-items-center text-muted small mb-3">
                                    <span class="me-3"><i
                                            class="far fa-calendar-alt me-2 text-cyan"></i>{{ $post['date'] }}</span>
                                    <span><i class="far fa-user me-2 text-cyan"></i>{{ $post['author'] }}</span>
                                </div>
                                <a href="{{ $post['link'] }}" class="text-decoration-none">
                                    <h4 class="card-title text-dark-blue fw-bold mb-3 hover-cyan transition-base">
                                        {{ $post['title'] }}</h4>
                                </a>
                                <p class="card-text text-muted mb-4 flex-grow-1">{{ $post['excerpt'] }}</p>

                                <div class="mt-auto pt-3 border-top">
                                    <a href="{{ $post['link'] }}"
                                        class="text-cyan fw-bold text-decoration-none d-inline-flex align-items-center group">
                                        Read Article <i
                                            class="fas fa-arrow-right ms-2 transition-transform group-hover:translate-x-2"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5 pt-4" data-aos="fade-up">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
