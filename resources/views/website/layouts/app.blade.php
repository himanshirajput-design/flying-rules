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
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/download.png') }}">
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
                                    $airlinesDropdown = \App\Http\Controllers\WebsiteController::getAirlines('cancellation');
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
                                    $fcDropdown = \App\Http\Controllers\WebsiteController::getAirlines('flight-change');
                                @endphp
                                @foreach($fcDropdown as $slug => $data)
                                    <li><a class="dropdown-item" href="{{ route('flight-change.show', $slug) }}">{{ $data['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle py-2 py-lg-0" href="{{ route('name-change.index') }}" id="nameChangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Name Change <i class="fas fa-angle-down ms-1 d-none d-lg-inline"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 fade-down" aria-labelledby="nameChangeDropdown">
                                @php
                                    $ncDropdown = \App\Http\Controllers\WebsiteController::getAirlines('name-change');
                                @endphp
                                @foreach($ncDropdown as $slug => $data)
                                    <li><a class="dropdown-item" href="{{ route('name-change.show', $slug) }}">{{ $data['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle py-2 py-lg-0" href="{{ route('reservation-policy.index') }}" id="reservationPolicyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Reservation Policy <i class="fas fa-angle-down ms-1 d-none d-lg-inline"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 fade-down" aria-labelledby="reservationPolicyDropdown">
                                @php
                                    $rpDropdown = \App\Http\Controllers\WebsiteController::getAirlines('reservation-policy');
                                @endphp
                                @foreach($rpDropdown as $slug => $data)
                                    <li><a class="dropdown-item" href="{{ route('reservation-policy.show', $slug) }}">{{ $data['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>                     
                        <li class="nav-item"><a class="nav-link py-2 py-lg-0" href="{{ route('blog.index') }}">Blog</a></li>
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
            <div class="col-md-3 pe-lg-3">
                <a class="navbar-brand brand-logo d-inline-block mb-4" href="/">
                    <img src="{{ asset('images/download.png') }}" alt="FlyingRules Logo" style="width: 160px; object-fit: contain;">
                </a>
                <p class="text-light opacity-75 small lh-lg mb-0">Your one-stop destination for all airline policies. We make understanding complex airline rules easy and accessible.</p>
            </div>
            
            <div class="col-md-3">
                <h5 class="footer-title text-white fw-bold mb-4 pb-2 position-relative">Quick Links</h5>
                <ul class="list-unstyled footer-links m-0">
                    <li class="mb-3"><a href="{{ route('cancellation.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Cancellation Policy</a></li>
                    <li class="mb-3"><a href="{{ route('flight-change.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Flight Change Policy</a></li>
                    <li class="mb-3"><a href="{{ route('name-change.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Name Change Policy</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5 class="footer-title text-white fw-bold mb-4 pb-2 position-relative">Our Services</h5>
                <ul class="list-unstyled footer-links m-0">
                    <li class="mb-3"><a href="{{ route('reservation-policy.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Reservation Policy</a></li>
                    <li class="mb-3"><a href="{{ route('baggage-policy.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Baggage Policy</a></li>
                    <li class="mb-3"><a href="{{ route('refund-policy.index') }}" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-chevron-right text-cyan me-3 small"></i> Refund Policy</a></li>
                </ul>
            </div>
            
            <div class="col-md-3">
                <h5 class="footer-title text-white fw-bold mb-4 pb-2 position-relative">Contact Us</h5>
                <ul class="list-unstyled footer-links m-0 small">
                    <li class="mb-3"><a href="tel:+18001234567" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-phone me-3 opacity-75"></i> +1-800-123-4567</a></li>
                    <li class="mb-3"><a href="mailto:support@flightrules.com" class="text-light opacity-75 text-decoration-none d-flex align-items-center hover-cyan"><i class="fas fa-envelope me-3 opacity-75"></i> support@flightrules.com</a></li>
                    <li class="mb-0 d-flex align-items-center text-light opacity-75"><i class="fas fa-map-marker-alt me-3 opacity-75"></i> 123 Luxury Ave, NY 10001</li>
                </ul>
            </div>
        </div>
        
        <hr class="border-light opacity-10 mt-5 mb-3">
        
        <div class="text-center text-light opacity-50 small mb-2">
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
        duration: 300,
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

<!-- Exit Intent Popup Modal -->
<div class="modal fade" id="exitIntentModal" tabindex="-1" aria-labelledby="exitIntentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden; background-color: #ffffff;">
      <div class="modal-body p-0 position-relative">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 shadow-sm bg-white rounded-circle p-2" style="z-index: 10;" data-bs-dismiss="modal" aria-label="Close"></button>
        
        <div class="row g-0">
          <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center position-relative" style="background: linear-gradient(135deg, #0b1121 0%, #1a2a4c 100%); min-height: 380px;">
              <!-- Decorative circles -->
              <div class="position-absolute rounded-circle" style="width: 150px; height: 150px; background: rgba(13, 202, 240, 0.05); top: -30px; left: -30px;"></div>
              <div class="position-absolute rounded-circle" style="width: 100px; height: 100px; background: rgba(13, 202, 240, 0.05); bottom: 30px; right: -20px;"></div>
              
              <div class="text-center position-relative z-1 p-4">
                  <div class="mb-3 d-inline-block p-3 rounded-circle" style="background: rgba(13, 202, 240, 0.1);">
                      <i class="fas fa-plane-departure text-info" style="font-size: 3.5rem;"></i>
                  </div>
                  <h3 class="text-white fw-bold mb-1" style="letter-spacing: 1px;">FlyingRules</h3>
                  <div class="badge bg-info text-dark rounded-pill px-3 py-1 mt-2 fw-bold">Exclusive Deal</div>
              </div>
          </div>
          <div class="col-md-7 d-flex align-items-center">
              <div class="p-4 p-lg-5 w-100 text-center">
                  <div class="mb-3">
                    <span class="badge bg-danger text-white rounded-pill px-3 py-2 shadow-sm" style="font-weight: 600; font-size: 0.85rem; letter-spacing: 1px;">
                        <i class="fas fa-fire me-1"></i> LIMITED TIME OFFER
                    </span>
                  </div>
                  <h2 class="fw-bold mb-3" style="color: #0b1121;">Wait! Before you go...</h2>
                  <p class="text-secondary mb-4" style="font-size: 1.05rem;">
                      Don't miss out on our special discount. Call us now and get <br>
                      <span class="text-danger fw-bold" style="font-size: 1.4rem;">20% OFF</span> on your flight booking!
                  </p>
                  
                  <div class="d-grid gap-3 px-2 px-md-4">
                      <a href="tel:1234567890" class="btn btn-premium rounded-pill fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center" style="font-size: 1.1rem; transition: all 0.3s ease;">
                          <i class="fas fa-phone-alt me-2 icon-vibrate"></i> Claim 20% Off Now
                      </a>
                      <button type="button" class="btn btn-link text-muted text-decoration-none p-0 m-0" data-bs-dismiss="modal" style="font-size: 0.9rem; transition: color 0.3s ease;">No thanks, I'll pay full price</button>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let exitModalEl = document.getElementById('exitIntentModal');
        if (!exitModalEl) return;
        
        let exitModal = new bootstrap.Modal(exitModalEl);
        let popupShown = sessionStorage.getItem('exitIntentPopupShown');
        let reopenTimeout;
        
        // Exit intent logic
        document.addEventListener('mouseleave', function(e) {
            // Check if cursor goes above the viewport
            if (e.clientY < 0 && !popupShown) {
                exitModal.show();
                // Set flag in session storage so it doesn't fire multiple times on mouse leave
                sessionStorage.setItem('exitIntentPopupShown', 'true');
                popupShown = true;
            }
        });

        // Automatically reopen after 20 seconds when closed
        exitModalEl.addEventListener('hidden.bs.modal', function () {
            clearTimeout(reopenTimeout);
            reopenTimeout = setTimeout(function() {
                exitModal.show();
            }, 10000); // 10 seconds
        });
    });
</script>
</body>
</html>
