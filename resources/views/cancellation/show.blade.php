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
                <a href="{{ route('cancellation.index') }}" class="text-white text-decoration-none hover-cyan">Cancellation Policy</a> &nbsp;&gt;&nbsp; 
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
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $airlineData['image'] }}" alt="Logo" class="rounded-circle shadow-sm me-3 object-fit-cover" style="width: 70px; height: 70px;">
                    <h2 class="fw-bold text-dark-blue m-0">What is the 24-Hour Cancellation Policy?</h2>
                </div>
                
                <p class="text-muted lh-lg mb-4">
                    Most airlines offer a 24-hour cancellation policy, allowing passengers to cancel their booking within 24 hours of purchase without incurring any cancellation fees, provided the ticket was booked at least seven days before the flight's departure. This rule is mandated by the U.S. Department of Transportation for flights operating to, from, or within the United States.
                </p>

                <div class="alert bg-light-cyan border-0 border-start border-4 border-cyan text-dark-blue p-4 mb-5 rounded-end-4 shadow-sm">
                    <h5 class="fw-bold"><i class="fas fa-info-circle text-cyan me-2"></i> Important Note</h5>
                    <p class="mb-0">If you booked through a third-party travel agency, you must contact them directly to process your cancellation. The airline's direct 24-hour rule may not apply to agency bookings depending on their specific terms.</p>
                </div>

                <h3 class="fw-bold text-dark-blue mb-4">Fare Types & Cancellation Rules</h3>
                
                <h5 class="fw-bold text-cyan mt-4">Basic Economy Tickets</h5>
                <p class="text-muted lh-lg">Basic Economy tickets are generally strictly non-refundable and non-changeable after the 24-hour grace period. If you cancel, you will not receive a refund or travel credit.</p>
                
                <h5 class="fw-bold text-cyan mt-4">Main Cabin / Standard Tickets</h5>
                <p class="text-muted lh-lg">Standard tickets can often be cancelled prior to departure. While they may not be fully refundable to your original form of payment, the value of the ticket (minus any applicable cancellation fees) is typically issued as an eCredit for future travel.</p>

                <h5 class="fw-bold text-cyan mt-4">Refundable / First Class Tickets</h5>
                <p class="text-muted lh-lg mb-5">Fully refundable tickets allow you to cancel at any time before departure and receive a full refund to your original payment method without any penalty fees.</p>

                <h3 class="fw-bold text-dark-blue mb-4">How To Cancel Your Flight Online</h3>
                <ul class="list-unstyled text-muted lh-lg mb-5">
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Visit the airline's official website and navigate to "Manage Booking" or "My Trips".</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Enter your confirmation number (PNR) and the passenger's last name.</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Select the flight you wish to cancel and click on the "Cancel Flight" option.</li>
                    <li class="mb-3"><i class="fas fa-check-circle text-cyan me-2"></i> Review the estimated refund or eCredit amount, and confirm the cancellation.</li>
                </ul>
            </div>

            <!-- Sidebar (Table of Contents) -->
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-header bg-dark-blue text-white p-4 rounded-top-4 border-0">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2 text-cyan"></i> Table of Contents</h5>
                    </div>
                    <div class="card-body p-4 bg-light rounded-bottom-4">
                        <ul class="list-unstyled mb-0 toc-list">
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> 24-Hour Cancellation Policy</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Fare Types & Rules</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Basic Economy Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Standard Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Refundable Tickets</a></li>
                            <li class="mb-3"><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> How To Cancel Online</a></li>
                            <li><a href="#" class="text-decoration-none text-muted hover-cyan"><i class="fas fa-angle-right me-2 small"></i> Refund Process & Timing</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
