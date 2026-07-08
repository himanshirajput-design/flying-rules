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
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/download.png') }}" alt="FlyingRules Logo" style="width: 180px; object-fit: contain;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cancellationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cancellation Policy
                        </a>
                        <ul class="dropdown-menu shadow border-0" aria-labelledby="cancellationDropdown">
                            <li><a class="dropdown-item" href="{{ route('cancellation.index') }}">All Cancellation Policies</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('cancellation.show', 'lufthansa') }}">Lufthansa</a></li>
                            <li><a class="dropdown-item" href="{{ route('cancellation.show', 'klm') }}">KLM</a></li>
                            <li><a class="dropdown-item" href="{{ route('cancellation.show', 'allegiant') }}">Allegiant</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Flight Change</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Name Change</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Refund Policy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="tel:1234567890" class="btn btn-premium rounded-pill fw-bold px-4">
                            <i class="fas fa-phone-alt me-2"></i>1234567890
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="custom-footer py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <a class="navbar-brand brand-logo" href="/">
                <img src="{{ asset('images/download.png') }}" alt="FlyingRules Logo" style="width: 180px; object-fit: contain; margin-bottom: 20px;">
            </a>
                <p class="text-light opacity-75">Your one-stop destination for all airline policies. We make understanding complex airline rules easy and accessible. Experience luxury travel without the hassle.</p>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="footer-title mb-4">Quick Links</h4>
                <ul class="list-unstyled footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Cancellation Policy</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Name Change</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Baggage Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h4 class="footer-title mb-4">Contact Us</h4>
                <ul class="list-unstyled text-light opacity-75">
                    <li class="mb-2"><i class="fas fa-phone-alt me-2"></i> +1-800-123-4567</li>
                    <li class="mb-2"><i class="fas fa-envelope me-2"></i> support@flightrules.com</li>
                    <li><i class="fas fa-map-marker-alt me-2"></i> 123 Luxury Ave, NY 10001</li>
                </ul>
            </div>
        </div>
        <hr class="border-light opacity-25 my-4">
        <div class="text-center text-light opacity-75 small">
            &copy; {{ date('Y') }} FlightRules. All rights reserved.
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
</script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
