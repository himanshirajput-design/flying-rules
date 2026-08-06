<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flying Rules - Airlines Policies</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        /* Additional custom styles for layout tweaks not in style.css */
        .hero-section {
            padding: 60px 0;
            background-color: var(--bg-color);
        }
        .hero-title {
            font-weight: 900;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 30px;
        }
        .feature-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 30px;
        }
        .feature-list li {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1.1rem;
            color: #333;
            font-weight: 500;
        }
        .feature-list img {
            width: 40px;
            height: 40px;
            margin-right: 15px;
        }
        .hero-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .section-title {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 40px;
            text-align: center;
            position: relative;
        }
        .section-title::after {
            content: '';
            width: 60px;
            height: 3px;
            background-color: var(--accent-color);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .policy-card {
            display: block;
            text-decoration: none;
            color: inherit;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            text-align: center;
            padding: 20px;
        }
        .policy-card img {
            max-width: 100px;
            height: auto;
            margin-bottom: 15px;
        }
        .policy-card h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0;
            transition: color 0.3s ease;
        }
        .policy-card:hover h4 {
            color: var(--accent-color);
        }
        .navbar-brand img {
            height: 50px;
        }
        .contact-number {
            font-weight: 700;
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg custom-header sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="/">
                <!-- Placeholder logo using hotlinked asset or standard text -->
                <img src="https://www.flyingrules.com/assets/images/logo.png" alt="Flying Rules Logo" onerror="this.src='https://via.placeholder.com/150x50?text=FlyingRules'">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cancelPolicyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cancellation Policy <i class="fa fa-angle-down ms-1"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cancelPolicyDropdown">
                            <li><a class="dropdown-item" href="#">United Airlines</a></li>
                            <li><a class="dropdown-item" href="#">Alaska Airlines</a></li>
                            <li><a class="dropdown-item" href="#">Delta Airlines</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="flightChangeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Flight Change <i class="fa fa-angle-down ms-1"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="flightChangeDropdown">
                            <li><a class="dropdown-item" href="#">Alaska Airlines</a></li>
                            <li><a class="dropdown-item" href="#">Delta Airlines</a></li>
                            <li><a class="dropdown-item" href="#">JetBlue Airlines</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="nameChangeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Name Change <i class="fa fa-angle-down ms-1"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="nameChangeDropdown">
                            <li><a class="dropdown-item" href="#">Southwest Airlines</a></li>
                            <li><a class="dropdown-item" href="#">United Airlines</a></li>
                            <li><a class="dropdown-item" href="#">Spirit Airlines</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reservationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reservation Policy <i class="fa fa-angle-down ms-1"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="reservationDropdown">
                            <li><a class="dropdown-item" href="#">Delta Airlines</a></li>
                            <li><a class="dropdown-item" href="#">JetBlue Airlines</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/admin/dashboard') }}" class="nav-link">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in</a>
                            </li>
                        @endauth
                    @endif
                </ul>
                <div class="d-flex align-items-center">
                    <a href="tel:+18008631892" class="btn btn-premium contact-number text-decoration-none">
                        <i class="fa fa-phone-alt me-2"></i>+1-800-863-1892
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center flex-column-reverse flex-lg-row">
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <h1 class="hero-title">Know Each Airline Policy and Travel Stress-Free</h1>
                    <ul class="feature-list">
                        <li>
                            <i class="fa fa-check-circle text-cyan fs-3 me-3"></i> Get to Know Travel Policies
                        </li>
                        <li>
                            <i class="fa fa-shield-alt text-cyan fs-3 me-3"></i> Travel Trouble-free
                        </li>
                        <li>
                            <i class="fa fa-headset text-cyan fs-3 me-3"></i> Receive 24*7 Support
                        </li>
                        <li>
                            <i class="fa fa-user-tie text-cyan fs-3 me-3"></i> Connect with Expert Professionals
                        </li>
                    </ul>
                    <a href="tel:+18005067805" class="btn btn-premium px-5 py-3 fs-5 mt-3 fw-bold rounded-pill shadow">
                        Call Now: +1-800-506-7805
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://www.flyingrules.com/assets/image/hero-banner.webp" alt="Flying Airplane" class="hero-image" onerror="this.src='https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80'">
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section (One-Stop) -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 pe-lg-5">
                    <h2 class="section-title text-start mb-4">One-Stop for Collective Name Change Policy of Multiple Airlines.</h2>
                    <p class="text-secondary fs-5 lh-lg">
                        Flying Rules directs passengers about the updated and latest name change policies of numerous airlines across the USA, Europe, Canada, and more.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="https://www.flyingrules.com/assets/image/one-stop.webp" alt="Airliner Boarding" class="img-fluid rounded-3 shadow-sm" onerror="this.src='https://images.unsplash.com/photo-1542296332-2e4473faf563?auto=format&fit=crop&w=800&q=80'">
                </div>
            </div>
        </div>
    </section>

    <!-- Flight Change Policy Section -->
    <section class="py-5 bg-light-cyan">
        <div class="container">
            <h2 class="section-title">Flight Change Policy</h2>
            <div class="row mt-5">
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/334369.webp" alt="Alaska Airlines" onerror="this.src='https://via.placeholder.com/100?text=Alaska'">
                        <h4>Alaska Airlines Flight Change Policy</h4>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/453986.webp" alt="United Airlines" onerror="this.src='https://via.placeholder.com/100?text=United'">
                        <h4>United Airlines Flight Change Policy</h4>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/751136.webp" alt="Delta Airlines" onerror="this.src='https://via.placeholder.com/100?text=Delta'">
                        <h4>Delta Airlines Flight Change Policy</h4>
                    </a>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">View More</a>
            </div>
        </div>
    </section>

    <!-- Name Change Policy Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-title">Name Change Policy</h2>
            <div class="row mt-5">
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/381470.webp" alt="Southwest Airlines" onerror="this.src='https://via.placeholder.com/100?text=Southwest'">
                        <h4>Southwest Airlines Name Change Policy</h4>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/380492.webp" alt="Alaska Airlines" onerror="this.src='https://via.placeholder.com/100?text=Alaska'">
                        <h4>Alaska Airlines Name Change Policy</h4>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/967859.webp" alt="Delta Airlines" onerror="this.src='https://via.placeholder.com/100?text=Delta'">
                        <h4>Delta Airlines Name Change Policy</h4>
                    </a>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">View More</a>
            </div>
        </div>
    </section>

    <!-- Cancellation Policy Section -->
    <section class="py-5 bg-light-cyan">
        <div class="container">
            <h2 class="section-title">Cancellation Policy</h2>
            <div class="row mt-5">
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/582945.webp" alt="United Airlines" onerror="this.src='https://via.placeholder.com/100?text=United'">
                        <h4>United Airlines Cancellation Policy</h4>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/190726.webp" alt="Alaska Airlines" onerror="this.src='https://via.placeholder.com/100?text=Alaska'">
                        <h4>Alaska Airlines Cancellation Policy</h4>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="#" class="policy-card premium-card">
                        <img src="https://www.flyingrules.com/post_image/508950.webp" alt="Delta Airlines" onerror="this.src='https://via.placeholder.com/100?text=Delta'">
                        <h4>Delta Airlines Cancellation Policy</h4>
                    </a>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">View More</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="custom-footer text-white py-5 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="https://www.flyingrules.com/assets/images/logo.png" alt="Flying Rules" class="mb-3 bg-white p-2 rounded" style="max-height: 50px;" onerror="this.src='https://via.placeholder.com/150x50?text=Logo'">
                    <p class="text-white-50">Your one-stop guide to collective airline policies for a stress-free travel experience.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title mb-4">Quick Links</h5>
                    <div class="footer-links">
                        <a href="#" class="mb-2">Cancellation Policy</a>
                        <a href="#" class="mb-2">Flight Change Policy</a>
                        <a href="#" class="mb-2">Name Change Policy</a>
                        <a href="#" class="mb-2">Reservation Policy</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="footer-title mb-4">Contact Us</h5>
                    <p class="text-white-50"><i class="fa fa-phone-alt me-2 text-cyan"></i> +1-800-863-1892</p>
                    <p class="text-white-50"><i class="fa fa-envelope me-2 text-cyan"></i> support@flyingrules.com</p>
                </div>
            </div>
            <hr class="border-secondary mt-4 mb-4">
            <div class="text-center text-white-50">
                <small>&copy; {{ date('Y') }} Flying Rules. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
