@extends('layouts.app')

@section('content')
<!-- Detail Hero Section -->
<section class="hero position-relative d-flex align-items-center" style="min-height: 50vh; background: url('{{ asset('images/cancellation_hero_1783541787247.png') }}') no-repeat center center/cover;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(15, 23, 42, 0.75);"></div>
    <div class="container position-relative text-white" data-aos="fade-up">
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-3">{{ $airlineData['name'] }}</h1>
            <div class="breadcrumb text-light fs-5 opacity-75">
                <a href="/" class="text-white text-decoration-none hover-cyan">FlightRules</a> &nbsp;&gt;&nbsp; 
                <a href="{{ route('flight-change.index') }}" class="text-white text-decoration-none hover-cyan">Flight Change Policy</a> &nbsp;&gt;&nbsp; 
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
            <div class="col-lg-8" data-aos="fade-up">
                
                <!-- Large Featured Image -->
                <div class="mb-5 rounded-4 overflow-hidden shadow-sm" style="height: 400px;">
                    <img src="{{ $airlineData['image'] }}" alt="{{ $airlineData['name'] }}" class="w-100 h-100 object-fit-cover transition-scale">
                </div>


                <h2 class="fw-bold text-dark-blue mb-4">What is the Flight Change Policy?</h2>
                
                <p class="text-muted lh-lg mb-4">
                    Airlines have modernized their flight change policies to give passengers more flexibility. For most standard and premium tickets, you can now change your flight date, time, or destination without paying a hefty change fee. You will only be responsible for paying the fare difference if your new flight is more expensive than your original booking.
                </p>
                
                <!-- Quick Overview Section -->
                <div class="bg-light-cyan p-4 rounded-4 shadow-sm mb-5 border-start border-4 border-cyan">
                    <h4 class="fw-bold text-dark-blue mb-4"><i class="fas fa-bolt text-cyan me-2"></i> Quick Overview</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start"><i class="fas fa-check text-cyan mt-1 me-3"></i> <span class="text-muted"><strong>No Change Fees:</strong> Most standard tickets can be changed without penalty fees.</span></li>
                        <li class="mb-3 d-flex align-items-start"><i class="fas fa-check text-cyan mt-1 me-3"></i> <span class="text-muted"><strong>Fare Differences:</strong> You are responsible for any difference if the new flight is more expensive.</span></li>
                        <li class="mb-3 d-flex align-items-start"><i class="fas fa-check text-cyan mt-1 me-3"></i> <span class="text-muted"><strong>Basic Economy:</strong> Typically non-changeable after booking.</span></li>
                        <li class="mb-0 d-flex align-items-start"><i class="fas fa-check text-cyan mt-1 me-3"></i> <span class="text-muted"><strong>Travel Credits:</strong> Remaining balances are usually issued as eCredits.</span></li>
                    </ul>
                </div>

                <h3 class="fw-bold text-dark-blue mb-4">Fare Types & Change Rules</h3>
                
                <h5 class="fw-bold text-cyan mt-4">Basic Economy Tickets</h5>
                <p class="text-muted lh-lg">Basic Economy tickets are generally strictly non-changeable. You cannot modify the date or time of these flights once the 24-hour grace period has passed.</p>
                
                <h5 class="fw-bold text-cyan mt-4">Main Cabin / Standard Tickets</h5>
                <p class="text-muted lh-lg">Standard tickets can be changed with no change fees. However, you must pay any applicable fare difference. Changes can usually be made up until the time of departure.</p>

                <h5 class="fw-bold text-cyan mt-4">Refundable / First Class Tickets</h5>
                <p class="text-muted lh-lg mb-5">Fully refundable tickets offer the most flexibility, allowing unlimited changes without penalty fees, subject to fare differences.</p>

                <h3 class="fw-bold text-dark-blue mb-4">How To Change Your Flight Online</h3>
                <ul class="list-unstyled text-muted lh-lg mb-5">
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Visit the airline's official website and navigate to "Manage Booking" or "My Trips".</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Enter your confirmation number (PNR) and the passenger's last name.</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Select the flight you wish to change and click on the "Change Flight" option.</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Search for your new preferred flight, pay any fare difference, and confirm your new itinerary.</li>
                </ul>

                <!-- Change Fee Table -->
                <h3 class="fw-bold text-dark-blue mb-4">How Much Are the Change Fees?</h3>
                <div class="table-responsive mb-5">
                    <table class="table table-bordered table-striped align-middle shadow-sm">
                        <thead class="bg-dark-blue text-white">
                            <tr>
                                <th class="p-3">Ticket Type</th>
                                <th class="p-3">Change Fee</th>
                                <th class="p-3">Fare Difference</th>
                            </tr>
                        </thead>
                        <tbody class="text-muted">
                            <tr>
                                <td class="p-3 fw-bold">Basic Economy</td>
                                <td class="p-3">Changes Not Permitted</td>
                                <td class="p-3">N/A</td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">Main Cabin / Standard</td>
                                <td class="p-3">$0 (No Fee)</td>
                                <td class="p-3">Applies</td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">Refundable / First Class</td>
                                <td class="p-3">$0 (No Fee)</td>
                                <td class="p-3">Applies</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- FAQ Section -->
                <h3 class="fw-bold text-dark-blue mb-4">Frequently Asked Questions</h3>
                <div class="accordion mb-5 shadow-sm" id="policyFaq">
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button bg-light fw-bold text-dark-blue" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What happens if the airline changes my flight schedule?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#policyFaq">
                            <div class="accordion-body text-muted lh-lg">
                                If the airline makes a significant schedule change to your flight (usually more than 1-2 hours), you are entitled to change your flight to a more convenient time for free, or cancel for a full refund.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 border-bottom">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed bg-light fw-bold text-dark-blue" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Can I change my flight on the same day?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#policyFaq">
                            <div class="accordion-body text-muted lh-lg">
                                Yes, most airlines offer "Same-Day Confirmed" or "Same-Day Standby" options. These may require a nominal fee (usually around $75) unless you hold elite elite status.
                            </div>
                        </div>
                    </div>
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
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-header bg-dark-blue text-white p-4 rounded-top-4 border-0">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2 text-cyan"></i> Table of Contents</h5>
                    </div>
                    <div class="card-body p-4 bg-light rounded-bottom-4">
                        <ul class="list-unstyled mb-0 toc-list">
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Flight Change Policy</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Fare Types & Rules</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Basic Economy Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Standard Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Refundable Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> How To Change Online</a></li>
                            <li><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Schedule Changes</a></li>
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
        <h3 class="fw-bold text-dark-blue mb-5">Related Post Flight Change Policy</h3>
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
@endsection
