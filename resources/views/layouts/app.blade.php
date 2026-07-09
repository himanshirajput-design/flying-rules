<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Policies - Flight Booking</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- Header -->
<header class="sticky-top custom-header shadow-sm">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Column 1: Logo -->
            <a class="navbar-brand m-0" href="/">
                <img src="{{ asset('images/download.png') }}" alt="FlyingRules Logo" style="width: 250px; object-fit: contain;">
            </a>
            
            <button class="navbar-toggler border-0 px-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Modern Offcanvas Menu Wrapper -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header border-bottom p-4 d-lg-none">
                    <a class="navbar-brand m-0" href="/">
                        <img src="{{ asset('images/download.png') }}" alt="FlyingRules Logo" style="width: 150px; object-fit: contain;">
                    </a>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-4 p-lg-0">
                
                    <!-- Column 2: Center Menu -->
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-lg-3 gap-2 gap-lg-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle py-2 py-lg-0" href="{{ route('cancellation.index') }}" id="cancellationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Cancellation Policy <i class="fas fa-angle-down ms-1 d-none d-lg-inline"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 fade-down" aria-labelledby="cancellationDropdown">
            
                                @php
                                    $airlinesDropdown = \App\Http\Controllers\PolicyController::getAirlines();
                                @endphp
                                @foreach($airlinesDropdown as $slug => $data)
                                    <li><a class="dropdown-item" href="{{ route('cancellation.show', $slug) }}">{{ $data['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle py-2 py-lg-0" href="{{ route('flight-change.index') }}" id="flightChangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Flight Change <i class="fas fa-angle-down ms-1 d-none d-lg-inline"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 fade-down" aria-labelledby="flightChangeDropdown">
                                @php
                                    $fcDropdown = \App\Http\Controllers\FlightChangeController::getAirlines();
                                @endphp
                                @foreach($fcDropdown as $slug => $data)
                                    <li><a class="dropdown-item" href="{{ route('flight-change.show', $slug) }}">{{ $data['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link py-2 py-lg-0" href="#">Name Change</a></li>
                        <li class="nav-item"><a class="nav-link py-2 py-lg-0" href="#">Refund Policy</a></li>
                        <li class="nav-item"><a class="nav-link py-2 py-lg-0" href="#">Blog</a></li>
                    </ul>
                    
                    <!-- Column 3: Phone Button -->
                    <div class="d-flex align-items-center justify-content-start justify-content-lg-end mt-4 mt-lg-0">
                        <a href="tel:1234567890" class="btn btn-premium rounded-pill fw-bold px-4 py-2 w-100 w-lg-auto text-center">
                            <i class="fas fa-phone me-2 icon-vibrate"></i>1234567890
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="custom-footer py-5" style="background-color: #0b1121;">
    <div class="container pt-4 pb-2">
        <div class="row g-4 justify-content-between">
            <div class="col-lg-4 col-md-6 pe-lg-5">
                <a class="navbar-brand brand-logo d-inline-block mb-4" href="/">
                    <img src="{{ asset('images/download.png') }}" alt="FlyingRules Logo" style="width: 180px; object-fit: contain;">
                </a>
                <p class="text-light opacity-75 small lh-lg mb-0">Your one-stop destination for all airline policies. We make understanding complex airline rules easy and accessible. Experience luxury travel without the hassle.</p>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title text-white fw-bold mb-4 pb-2 position-relative">Quick Links</h5>
                <ul class="list-unstyled footer-links m-0">
                    <li class="mb-3"><a href="{{ route('cancellation.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Cancellation Policy</a></li>
                    <li class="mb-3"><a href="{{ route('flight-change.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Flight Change Policy</a></li>
                    <li class="mb-3"><a href="#" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Baggage Policy</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title text-white fw-bold mb-4 pb-2 position-relative">Contact Us</h5>
                <ul class="list-unstyled footer-links m-0 small">
                    <li class="mb-3"><a href="tel:+18001234567" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-phone me-3 opacity-75"></i> +1-800-123-4567</a></li>
                    <li class="mb-3"><a href="mailto:support@flightrules.com" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-envelope me-3 opacity-75"></i> support@flightrules.com</a></li>
                    <li class="mb-0 d-flex align-items-center text-light opacity-75"><i class="fas fa-map-marker-alt me-3 opacity-75"></i> 123 Luxury Ave, NY 10001</li>
                </ul>
            </div>
        </div>
        
        <hr class="border-light opacity-10 mt-5 mb-4">
        
        <div class="text-center text-light opacity-50 small">
            &copy; 2026 FlightRules. All rights reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS Animation JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Make dropdown links clickable on desktop
    document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.navbar .dropdown-toggle').forEach(function(element){
            element.addEventListener('click', function(e){
                if(window.innerWidth >= 992 && this.href && this.href !== '#' && !this.href.includes('javascript:void(0)')){
                    window.location.href = this.href;
                }
            });
        });
    });
</script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
