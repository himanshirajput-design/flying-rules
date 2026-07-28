@extends('website.layouts.app')

@section('content')
    <!-- Article Hero Section -->
    <section class="hero position-relative d-flex align-items-end pb-5"
        style="min-height: 60vh; background: url('{{ $post['image'] }}') no-repeat center center/cover;">
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(to bottom, rgba(15, 23, 42, 0.2) 0%, rgba(15, 23, 42, 0.9) 100%);"></div>
        <div class="container position-relative text-white z-index-1" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <span
                        class="badge bg-cyan text-dark-blue px-3 py-2 rounded-pill fw-bold mb-4 shadow-sm">{{ $post['category'] }}</span>
                    <h1 class="display-4 fw-bold mb-4">{{ $post['title'] }}</h1>
                    <div class="d-flex align-items-center justify-content-center text-light opacity-75 fs-6">
                        <div class="d-flex align-items-center me-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post['author']) }}&background=0ea5e9&color=fff&size=40&rounded=true"
                                alt="{{ $post['author'] }}" class="rounded-circle me-2 border border-light border-2"
                                style="width: 40px; height: 40px;">
                            <span>{{ $post['author'] }}</span>
                        </div>
                        <div class="d-flex align-items-center me-4">
                            <i class="far fa-calendar-alt text-cyan me-2"></i>
                            <span>{{ $post['date'] }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="far fa-clock text-cyan me-2"></i>
                            <span>5 min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-4 justify-content-center">
                <!-- Main Content -->
                <div class="col-lg-8" data-aos="fade-up">

                    <p class="lead text-muted lh-lg mb-5 border-start border-4 border-cyan ps-4 fs-4 fst-italic">
                        "{{ $post['excerpt'] }}"
                    </p>

                    <div class="article-content text-muted lh-lg mb-5">
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                        <h3 class="fw-bold text-dark-blue mt-5 mb-4">The Importance of Being Prepared</h3>
                        <p class="mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                            deserunt mollit anim id est laborum.</p>

                        <div class="alert bg-light-cyan border-0 text-dark-blue p-4 my-5 rounded-4 shadow-sm d-flex">
                            <i class="fas fa-lightbulb text-cyan fs-2 me-4 mt-1"></i>
                            <div>
                                <h5 class="fw-bold mb-2">Pro Tip</h5>
                                <p class="mb-0">Always double-check your airline's specific policies 24 hours before
                                    departure, as rules can change based on current events or operational requirements.</p>
                            </div>
                        </div>

                        <p class="mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo.</p>

                        <h3 class="fw-bold text-dark-blue mt-5 mb-4">Step-by-Step Guide</h3>
                        <ol class="mb-4">
                            <li class="mb-3">First, ensure you have all your booking documents ready.</li>
                            <li class="mb-3">Navigate to the airline's official management portal.</li>
                            <li class="mb-3">Enter your PNR and last name exactly as it appears on your passport.</li>
                            <li class="mb-3">Review the options provided and calculate any potential fare differences.
                            </li>
                        </ol>

                        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur
                            magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                    </div>

                    <!-- Share Section -->
                    <div class="d-flex align-items-center justify-content-between border-top border-bottom py-4 mb-5">
                        <h6 class="fw-bold text-dark-blue mb-0">Share this article:</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-secondary rounded-circle"
                                style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"
                                style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"
                                style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle"
                                style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;"><i
                                    class="fas fa-link"></i></a>
                        </div>
                    </div>

                    <!-- Author Profile -->
                    <div
                        class="author-profile d-flex flex-column flex-md-row align-items-center align-items-md-start bg-light border-0 p-5 rounded-4 shadow-sm mb-5 text-center text-md-start">
                        <div class="flex-shrink-0 mb-4 mb-md-0 me-md-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($post['author']) }}&background=0ea5e9&color=fff&size=120&rounded=true"
                                alt="{{ $post['author'] }}" class="rounded-circle shadow-sm"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fw-bold text-dark-blue mb-2">Written by {{ $post['author'] }}</h5>
                            <p class="text-muted small mb-0 lh-lg">Passionate traveler and policy expert dedicated to
                                helping you navigate the complex world of airline rules. Follow for more tips and industry
                                secrets.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts Section -->
    <section class="py-5 bg-light border-top">
        <div class="container py-4">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h3 class="fw-bold text-dark-blue mb-2">Keep Reading</h3>
                    <p class="text-muted mb-0">More articles you might find interesting</p>
                </div>
                <a href="{{ route('blog.index') }}"
                    class="btn btn-outline-primary rounded-pill px-4 hover-cyan d-none d-md-inline-block">View All Posts</a>
            </div>

            <div class="row g-4">
                @foreach ($relatedPosts as $related)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article
                            class="card premium-card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white d-flex flex-column">
                            <div class="position-relative">
                                <a href="{{ $related['link'] }}" class="d-block card-img-top-wrap"
                                    style="height: 200px; overflow: hidden;">
                                    <img src="{{ $related['image'] }}"
                                        class="w-100 h-100 object-fit-cover transition-scale"
                                        alt="{{ $related['title'] }}">
                                </a>
                                <span
                                    class="badge bg-dark-blue text-white position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill shadow-sm small">
                                    {{ $related['category'] }}
                                </span>
                            </div>
                            <div class="card-body p-4 d-flex flex-column">
                                <a href="{{ $related['link'] }}" class="text-decoration-none">
                                    <h5 class="card-title text-dark-blue fw-bold mb-3 hover-cyan transition-base">
                                        {{ $related['title'] }}</h5>
                                </a>
                                <div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3">
                                    <span class="text-muted small"><i
                                            class="far fa-calendar-alt text-cyan me-2"></i>{{ $related['date'] }}</span>
                                    <a href="{{ $related['link'] }}"
                                        class="text-cyan fw-bold small text-decoration-none">Read <i
                                            class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5 d-md-none">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary rounded-pill px-5 py-2 w-100">View All
                    Posts</a>
            </div>
        </div>
    </section>
@endsection
