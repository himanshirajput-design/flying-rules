@extends('website.layouts.app')

@section('content')
<!-- Detail Hero Section -->
<section class="hero position-relative d-flex align-items-center" style="min-height: 50vh; background: url('{{ asset('images/cancellation_hero_1783541787247.png') }}') no-repeat center center/cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.75);"></div>
    <div class="container position-relative text-white" data-aos="fade-up">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-3">{{ $airlineData['name'] }}</h1>
            <div class="breadcrumb text-light fs-5 opacity-75">
                <a href="/" class="text-white text-decoration-none hover-cyan">FlightRules</a> &nbsp;&gt;&nbsp; 
                <a href="{{ route($policyMeta['index_route']) }}" class="text-white text-decoration-none hover-cyan">{{ $policyMeta['title'] }}</a> &nbsp;&gt;&nbsp;
                <span>{{ explode(' ', $airlineData['name'])[0] }}</span>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Main Content -->
            <div class="col-md-8" data-aos="fade-up">
                
                <div class="mb-5 rounded-4 overflow-hidden shadow-sm" style="height: 400px;">
                    <img src="{{ $airlineData['image'] }}" alt="{{ $airlineData['name'] }}" class="w-100 h-100 object-fit-cover transition-scale">
                </div>


                <div class="dynamic-policy-content">
                    {!! $airlineData['policy_content'] !!}
                </div>

                <!-- FAQ Section -->
                <h3 class="fw-bold text-dark-blue mb-4" id="faq">Frequently Asked Questions</h3>
                <div class="accordion mb-5 shadow-sm" id="policyFaq">
                    @foreach($policyMeta['faqs'] as $faq)
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="faqHeading{{ $loop->iteration }}">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }} bg-light fw-bold text-dark-blue" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $loop->iteration }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faqCollapse{{ $loop->iteration }}">
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="faqCollapse{{ $loop->iteration }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="faqHeading{{ $loop->iteration }}" data-bs-parent="#policyFaq">
                            <div class="accordion-body text-muted lh-lg">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Author Profile -->
                <div class="author-profile d-flex flex-column flex-md-row align-items-center align-items-md-start bg-white border p-4 rounded-4 shadow-sm mb-5">
                    <div class="flex-shrink-0 mb-3 mb-md-0 me-md-4">
                        <img src="https://ui-avatars.com/api/?name=Emma+Watson&background=0ea5e9&color=fff&size=120&rounded=true" alt="Emma Watson" class="rounded-circle shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1 text-center text-md-start">
                        <h5 class="fw-bold text-dark-blue mb-1">Emma Watson</h5>
                        <p class="text-cyan small fw-bold mb-2">Senior Travel Policy Expert</p>
                        <p class="text-muted small mb-0 lh-lg">Emma is a seasoned travel blogger and policy expert with over 10 years of experience navigating the complexities of airline rules. She helps travelers save money and avoid headaches.</p>
                    </div>
                </div>

                <!-- Leave a Reply Form -->
                <h3 class="fw-bold text-dark-blue mb-4">Leave a Reply</h3>
                <div class="bg-light p-4 rounded-4 shadow-sm mb-5">
                    <p class="text-muted mb-4">Any thoughts or questions? Comment below!</p>
                    <form>
                        <div class="mb-3">
                            <label class="form-label text-dark-blue fw-bold">Comment</label>
                            <textarea class="form-control" rows="4" placeholder="Write your comment..."></textarea>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label text-dark-blue fw-bold">Name</label>
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark-blue fw-bold">Email</label>
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-premium px-5 py-2 fw-bold w-100">Post Comment</button>
                    </form>
                </div>
            </div>

            <!-- Sidebar (Table of Contents) -->
            <div class="col-md-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-header bg-dark-blue text-white p-4 rounded-top-4 border-0">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2 text-cyan"></i> Table of Contents</h5>
                    </div>
                    <div class="card-body p-4 bg-light rounded-bottom-4">
                        <ul class="list-unstyled mb-0 toc-list">
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> {{ $policyMeta['toc'] }}</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Fare Types & Rules</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Basic Economy Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Standard Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Refundable Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> {{ $policyMeta['action'] }}</a></li>
                            <li><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> {{ $policyMeta['timing'] }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts Section -->
<section class="py-5 bg-light">
    <div class="container pb-4">
        <h3 class="fw-bold text-dark-blue mb-5">Related {{ $policyMeta['title'] }}</h3>
        <div class="row g-4">
            @foreach($relatedAirlines as $related)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <a href="{{ $related['link'] }}" class="text-decoration-none">
                    <div class="card premium-card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <div class="card-img-top-wrap" style="height: 180px; overflow: hidden;">
                            <img src="{{ $related['image'] }}" class="w-100 h-100 object-fit-cover transition-scale" alt="{{ $related['name'] }}">
                        </div>
                        <div class="card-body p-4">
                            <h6 class="card-title text-dark-blue fw-bold mb-2">{{ $related['name'] }}</h6>
                            <p class="small text-muted mb-0">Learn more about the specific terms and conditions for this airline.</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Airline Policies Accordion -->
<section class="airline-policies-section py-5 bg-white">
    <div class="container py-3">
        <div class="accordion airline-policies-accordion" id="airlinePoliciesAccordion">
            @foreach($policyAirlines as $airline)
                @php
                    $headingId = 'airlinePoliciesHeading'.$loop->iteration;
                    $collapseId = 'airlinePoliciesCollapse'.$loop->iteration;
                @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="{{ $headingId }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="{{ $collapseId }}">
                            Policies of {{ $airline['name'] }}
                        </button>
                    </h2>
                    <div id="{{ $collapseId }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="{{ $headingId }}" data-bs-parent="#airlinePoliciesAccordion">
                        <div class="accordion-body">
                            @forelse($airline['policies'] as $policy)
                                <a href="{{ $policy['link'] }}" class="airline-policy-link">{{ $policy['title'] }}</a>
                            @empty
                                <p class="text-muted mb-0">No other policies are available for this airline yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
