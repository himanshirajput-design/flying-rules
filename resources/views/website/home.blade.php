@extends('website.layouts.app')

@section('styles')
    <style>
        :root {
            --primary-color: #0f172a;
            --secondary-color: #3b82f6;
            --accent-color: #0ea5e9;
            --bg-color: #f8fafc;
            --highlight: var(--accent-color); /* Strictly using theme colors only */
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.4)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1920&q=80') center/cover;
            padding: 80px 0;
            color: white;
        }
        
        .search-widget {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .search-widget h5 {
            font-weight: 700;
            margin-bottom: 20px;
        }
        .search-widget .nav-pills .nav-link {
            color: white;
            background: var(--primary-color);
            margin-right: 5px;
            border-radius: 5px;
            padding: 5px 15px;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }
        .search-widget .nav-pills .nav-link.active {
            background: var(--secondary-color);
        }
        .search-widget .form-control {
            border-radius: 5px;
            padding: 12px;
            border: none;
        }
        .btn-search {
            background-color: var(--highlight);
            color: white;
            font-weight: bold;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            margin-top: 5px;
        }

        .hero-text h1 {
            font-weight: 900;
            margin-bottom: 20px;
            font-size: 2.5rem;
        }
        .hero-text p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Call Banner */
        .call-banner {
            background-color: var(--highlight);
            color: white;
            text-align: center;
            padding: 15px 0;
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* Section Titles */
        .section-title {
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 25px;
        }
        
        /* Popular Locations */
        .location-card {
            border-radius: 10px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .location-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .location-card .card-body {
            padding: 0;
            text-align: center;
            display: flex;
            flex-direction: column;
        }
        .location-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
        }
        .location-header span.badge {
            background-color: var(--secondary-color);
            padding: 5px 10px;
        }
        .location-header h6 {
            margin: 0;
            font-weight: 700;
        }
        .location-card .btn-book {
            background-color: var(--primary-color);
            color: white;
            width: 100%;
            border-radius: 0;
            font-weight: 500;
            padding: 10px;
            margin-top: auto;
        }

        /* Why Book With Us */
        .feature-card {
            border-radius: 10px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            height: 100%;
            text-align: center;
        }
        .feature-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .feature-card .card-body {
            padding: 20px;
        }
        .feature-card h6 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        .feature-card p {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0;
        }
        .form-control:focus {
    box-shadow: none;
}

        /* Why Pick Us */
        .pick-us-list {
            list-style: none;
            padding: 0;
        }
        .pick-us-list li {
            display: flex;
            margin-bottom: 30px;
        }
        .pick-us-list .icon {
            width: 50px;
            height: 50px;
            background: rgba(14, 165, 233, 0.1);
            color: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
        }
        .pick-us-list h6 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        .pick-us-list p {
            color: #666;
            font-size: 0.85rem;
        }
        
        /* Collage */
        .collage {
            position: relative;
            height: 400px;
        }
        .collage img {
            border-radius: 10px;
            position: absolute;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .collage img:nth-child(1) { width: 55%; top: 0; left: 0; z-index: 2; border: 4px solid white; }
        .collage img:nth-child(2) { width: 50%; top: 20%; right: 0; z-index: 1; border: 4px solid white; }
        .collage img:nth-child(3) { width: 50%; bottom: 0; left: 15%; z-index: 3; border: 4px solid white; }

        /* Testimonials */
        .testimonial-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            height: 100%;
        }
        .testimonial-card img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 15px;
            object-fit: cover;
        }
        .testimonial-card .stars {
            color: var(--highlight);
            margin-bottom: 15px;
            font-size: 0.8rem;
        }
        .testimonial-card p {
            font-size: 0.85rem;
            color: #666;
            font-style: italic;
        }

        /* SEO Text */
        .seo-section {
            padding: 40px 0;
        }
        .seo-section h5 {
            font-weight: 700;
        }
        .seo-section span {
            color: var(--accent-color);
        }
        .seo-section p {
            font-size: 0.85rem;
            color: #777;
        }

        /* Newsletter */
        .newsletter {
            background: #e2e8f0;
            padding: 60px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .newsletter .input-group {
            max-width: 500px;
            margin: 0 auto;
        }
        .newsletter input {
            border-radius: 30px 0 0 30px !important;
            padding: 12px 25px;
            border: 1px solid #ccc;
        }
        .newsletter button {
            border-radius: 0 30px 30px 0 !important;
            padding: 12px 30px;
            background: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
        }
        /* Loading & Quote Overlays */
        .loading-overlay, .quote-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: rgba(15, 23, 42, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }
        
        /* Helicopter Animation */
        @keyframes flyRight {
            0% { left: 0%; transform: translateY(0) scaleX(1); }
            50% { transform: translateY(-10px) scaleX(1); }
            100% { left: 80%; transform: translateY(0) scaleX(1); }
        }
        .flying-vehicle {
            animation: flyRight 3s linear forwards;
            bottom: 0;
        }

        .quote-overlay {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            overflow-y: auto;
            align-items: flex-start;
        }
        .quote-overlay .container {
            margin-top: 5vh;
            margin-bottom: 5vh;
        }

        /* Quote Form Tweaks */
        .class-option.active-class {
            background-color: rgba(13, 110, 253, 0.1) !important;
            border-color: #0d6efd !important;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="search-widget">
                        <h5>Search Flights</h5>
                        <ul class="nav nav-pills d-none">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">One Way</a>
                            </li>
                        </ul>
                        <form class="mt-3">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="searchFrom" placeholder="From" value="New York">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="searchTo" placeholder="To" value="Miami">
                                </div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="searchDep" value="2026-09-25">
                                </div>
                                <div class="col-md-6">
                                    <input type="date" class="form-control" id="searchRet" value="2026-12-25">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-search" id="triggerSearchBtn">Search Flights</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1 hero-text">
                    <h1>Your Journey Begins Here Fly with Ease, Book with Confidence</h1>
                    <p>Start your adventure with us. Our seamless booking process ensures your travel is simple, allowing you to focus on your journey. We are here to make your travel dreams a reality, with great deals.</p>
                    <a href="tel:+18008631892" class="btn btn-outline-light px-4 py-2 fw-bold mt-2">
                        +1-800-863-1892
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call Banner -->
    <div class="call-banner">
        <div class="container">
            <i class="fa fa-phone-alt me-2"></i> Call us 24/7 at +1-800-863-1892 to get great deals!
        </div>
    </div>

    <!-- Popular Locations -->
    <section class="py-5">
        <div class="container">
            <h4 class="section-title">Popular Locations</h4>
            <div class="row g-4 mt-1">
                <div class="col-md-4">
                    <div class="location-card">
                        <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?auto=format&fit=crop&w=800&q=80" alt="New York">
                        <div class="card-body">
                            <div class="location-header">
                                <span class="badge text-white">NYC</span>
                                <h6>New York</h6>
                            </div>
                            <button class="btn btn-book">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="location-card">
                        <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=800&q=80" alt="London">
                        <div class="card-body">
                            <div class="location-header">
                                <span class="badge text-white">LON</span>
                                <h6>London</h6>
                            </div>
                            <button class="btn btn-book">Book Now</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="location-card">
                        <img src="https://images.unsplash.com/photo-1498307833015-e7b400441eb8?auto=format&fit=crop&w=800&q=80" alt="Italy">
                        <div class="card-body">
                            <div class="location-header">
                                <span class="badge text-white">ITA</span>
                                <h6>Italy</h6>
                            </div>
                            <button class="btn btn-book">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why to Book with Us -->
    <section class="py-5 bg-white">
        <div class="container">
            <h4 class="section-title">Why to Book with Us?</h4>
            <div class="row g-4 mt-1">
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=800&q=80" alt="Personalized Travel">
                        <div class="card-body">
                            <h6>Personalized Travel Experience</h6>
                            <p>We understand that every traveler is unique. Our team works closely with you to curate travel packages that fit your preferences, ensuring your trip is exactly what you dreamed of.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=800&q=80" alt="Best Price">
                        <div class="card-body">
                            <h6>Best Price Guarantee</h6>
                            <p>We believe in offering the best value for your money. Our pricing is transparent, competitive and designed to give you the most cost-effective options without compromising on quality.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?auto=format&fit=crop&w=800&q=80" alt="Support">
                        <div class="card-body">
                            <h6>24/7 Support</h6>
                            <p>Whether making plans for your trip or already on your journey, knowing you can call for help. Our dedicated customer support team is always ready to assist you with any questions or concerns.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why you pick us? -->
    <section class="py-5">
        <div class="container">
            <h4 class="section-title">Why you pick us?</h4>
            <div class="row align-items-center mt-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <ul class="pick-us-list">
                        <li>
                            <div class="icon"><i class="fa fa-ticket-alt"></i></div>
                            <div>
                                <h6>Easy Ticket Booking</h6>
                                <p>Effortless ticket booking at your fingertips. A seamless and user-friendly platform ensures a hassle-free experience for all your travel reservations.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon"><i class="fa fa-clock"></i></div>
                            <div>
                                <h6>Save Your Time</h6>
                                <p>Time is precious, and we value yours. Our streamlined processes are designed to quickly get you on your way, reducing the time spent on travel logistics.</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon"><i class="fa fa-headset"></i></div>
                            <div>
                                <h6>24/7 Customer Support</h6>
                                <p>Experience peace of mind with our 24/7 customer support, ensuring assistance at any hour.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="collage">
                        <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?auto=format&fit=crop&w=600&q=80" alt="Beach 1">
                        <img src="https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?auto=format&fit=crop&w=600&q=80" alt="Beach 2">
                        <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=600&q=80" alt="Beach 3">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What our travelers say -->
    <section class="py-5 bg-white">
        <div class="container">
            <h4 class="section-title">What our travelers say</h4>
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=150&q=80" alt="User 1">
                        <h6>Robert James</h6>
                        <div class="stars">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        </div>
                        <p>"Booking was incredibly easy! In just a few steps, I got my flight sorted. The user-friendly interface is amazing and the booking was fast and smooth. I'll definitely use this site again for my future travels."</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&q=80" alt="User 2">
                        <h6>Anna Williams</h6>
                        <div class="stars">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        </div>
                        <p>"The customer service was absolutely fantastic. They quickly resolved my flight issue and their 24/7 support really put my mind at ease. I highly recommend them to anyone."</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=150&q=80" alt="User 3">
                        <h6>Amanda Torres</h6>
                        <div class="stars">
                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                        </div>
                        <p>"I simply could not find cheaper fares compared to other sites. Booking was incredibly simple, with no hidden fees and a smooth flow. I'm absolutely delighted with my experience here."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEO Text -->
    <section class="seo-section">
        <div class="container">
            <h5>Book <span>Cheap Flights</span> on Flying rules</h5>
            <p>
                To save fully on your overall trip, whether it is a business or leisure journey. Flying rules offers you incredibly cheap flights. With our user-friendly interface, you can easily compare fares across numerous airlines to find the most suitable option. Our advanced search engine quickly pulls in the best flight options based on your preferences and dates. Book your cheap flights today and explore the world with confidence.
            </p>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <h5 class="fw-bold mb-2">Newsletter</h5>
            <p class="text-secondary mb-4">Sign up for our newsletter to get latest updates.</p>
            <div class="input-group mb-3">
                <input type="text" class="form-control border-0" placeholder="Email Address">
                <button class="btn" type="button">Subscribe</button>
            </div>
        </div>
    </section>

    <!-- Flight Search Loading Overlay -->
    <div id="flightSearchLoading" class="loading-overlay d-none" style="background-color: #f8f9fa; z-index: 9999; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; height: 100vh; position: fixed; width: 100%; top: 0; left: 0;">
        <div style="position: relative; width: 100%; max-width: 600px; padding: 20px;">
            <!-- Huge Background Percentage -->
            <div id="loadingPercentage" style="font-size: 10rem; font-weight: 800; color: rgba(15, 23, 42, 0.1); line-height: 1; z-index: 1;">0%</div>
            
            <!-- Airplane Image -->
            <img src="{{ asset('images/plane.png') }}" id="flyingVehicle" alt="Plane" style="width: 320px; position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%) rotate(0deg); z-index: 2; filter: drop-shadow(0 15px 20px rgba(0,0,0,0.15)); transition: transform 0.2s;">
            
            <!-- Progress Line -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 80px; position: relative;">
                <span id="loadingFrom" style="font-weight: 800; font-size: 1.2rem; color: #0f172a; max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">JFK</span>
                
                <div style="flex-grow: 1; margin: 0 15px; position: relative; height: 3px; background-color: #d1d5db; display: flex; align-items: center;">
                    <div id="loadingProgressBar" style="height: 3px; background-color: #0dcaf0; width: 0%; transition: width 0.3s;"></div>
                    <div id="loadingDot" style="width: 14px; height: 14px; border-radius: 50%; background-color: #0dcaf0; position: absolute; left: 0%; transform: translateX(-50%); box-shadow: 0 0 0 6px rgba(13, 202, 240, 0.2); transition: left 0.3s;"></div>
                </div>
                
                <span id="loadingTo" style="font-weight: 800; font-size: 1.2rem; color: #0f172a; max-width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">DEL</span>
            </div>
            
            <!-- Text below -->
            <div style="margin-top: 50px;">
                <h2 style="font-weight: 700; color: #0f172a; font-size: 2.2rem; margin-bottom: 10px;">Helping people travel smart</h2>
                <p style="color: #6c757d; font-size: 1.1rem;">We search for the best fare that meets your schedule</p>
            </div>
        </div>
    </div>

    <!-- Quote Form Overlay -->
    <div id="quoteFormOverlay" class="quote-overlay d-none">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="card w-100 border-0 shadow-lg rounded-4 overflow-hidden position-relative" style="max-width: 600px;">
                <!-- Close Button -->
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" id="closeQuoteForm" aria-label="Close" style="z-index: 10;"></button>
                
                <div class="row g-0 bg-white">


                    <!-- Right Side: Flight Details & Form -->
                    <div class="col-lg-12 p-4 p-lg-5 bg-white">

                        <!-- Readonly Flight Info -->
                        <div class="bg-white rounded p-3 mb-3 d-flex align-items-center shadow-sm">
                            <i class="fas fa-plane-departure ms-2 me-3 text-muted"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">FROM</small>
                                <input type="text" class="form-control border-0 fw-bold text-dark p-0 bg-transparent" id="qFromDetail" value="John F. Kennedy International Airport (JFK)" style="box-shadow: none;">
                            </div>
                            <i class="fas fa-pen text-muted bg-light p-2 rounded-circle" style="font-size: 0.8rem; cursor: pointer;" onclick="document.getElementById('qFromDetail').focus();"></i>
                        </div>

                        <div class="bg-white rounded p-3 mb-3 d-flex align-items-center shadow-sm">
                            <i class="fas fa-building ms-2 me-3 text-muted"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">TO</small>
                                <input type="text" class="form-control border-0 fw-bold text-dark p-0 bg-transparent" id="qToDetail" value="Delhi (DEL)" style="box-shadow: none;">
                            </div>
                            <i class="fas fa-pen text-muted bg-light p-2 rounded-circle" style="font-size: 0.8rem; cursor: pointer;" onclick="document.getElementById('qToDetail').focus();"></i>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="bg-white rounded p-3 shadow-sm d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                                    <div>
                                        <small class="text-muted d-block fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">DEPARTURE</small>
                                        <span class="fw-bold text-dark" id="qDep">25 Sept 2026</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-white rounded p-3 shadow-sm d-flex align-items-center">
                                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                                    <div>
                                        <small class="text-muted d-block fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">RETURN</small>
                                        <span class="fw-bold text-dark" id="qRet">25 Dec 2026</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded p-3 mb-4 d-flex align-items-center shadow-sm">
                            <i class="fas fa-user ms-2 me-3 text-muted"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">PASSENGERS / CLASS</small>
                                <input type="text" class="form-control border-0 fw-bold text-dark p-0 bg-transparent" id="qPassengers" value="3 Adults" style="box-shadow: none;">
                            </div>
                            <i class="fas fa-pen text-muted bg-light p-2 rounded-circle" style="font-size: 0.8rem; cursor: pointer;" onclick="document.getElementById('qPassengers').focus();"></i>
                        </div>

                        <!-- Contact Form -->
                        <form id="passengerQuoteForm">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3" id="qName" placeholder="Name" required>
                                <label for="qName" class="text-muted">Enter your name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3" id="qEmail" placeholder="name@example.com" required>
                                <label for="qEmail" class="text-muted">Enter your e-mail</label>
                            </div>
                            <div class="input-group mb-4 rounded-3 overflow-hidden shadow-sm border" style="height: 58px;">
                                <span class="input-group-text bg-white border-0 px-3">
                                    🇺🇸 +1 <i class="fas fa-chevron-down ms-1 text-muted" style="font-size: 0.7rem;"></i>
                                </span>
                                <div class="form-floating flex-grow-1">
                                    <input type="tel" class="form-control border-0 px-2" id="qPhone" placeholder="Phone" required style="box-shadow: none;">
                                    <label for="qPhone" class="text-muted px-2">Enter your phone</label>
                                </div>
                            </div>

                            <button type="submit" class="btn w-100 py-3 fw-bold rounded-pill mb-3 text-white shadow" style="background-color: #00c853; font-size: 1.1rem; letter-spacing: 1px;">GET A FREE QUOTE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Logic -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchBtn = document.getElementById('triggerSearchBtn');
            const loadingOverlay = document.getElementById('flightSearchLoading');
            const progressBar = document.getElementById('loadingProgressBar');
            const loadingDot = document.getElementById('loadingDot');
            const loadingPercentage = document.getElementById('loadingPercentage');
            const loadingFrom = document.getElementById('loadingFrom');
            const loadingTo = document.getElementById('loadingTo');
            const quoteOverlay = document.getElementById('quoteFormOverlay');
            const closeQuoteBtn = document.getElementById('closeQuoteForm');
            
            // Search Inputs
            const searchFrom = document.getElementById('searchFrom');
            const searchTo = document.getElementById('searchTo');
            const searchDep = document.getElementById('searchDep');
            const searchRet = document.getElementById('searchRet');
            
            // Quote Spans
            const qFromDetail = document.getElementById('qFromDetail');
            const qToDetail = document.getElementById('qToDetail');
            const qDep = document.getElementById('qDep');
            const qRet = document.getElementById('qRet');

            if(searchBtn) {
                searchBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Show Loading Overlay
                    loadingOverlay.classList.remove('d-none');
                    
                    // Extract airport codes for loading screen
                    const fromMatch = searchFrom.value.match(/\(([^)]+)\)/);
                    const toMatch = searchTo.value.match(/\(([^)]+)\)/);
                    if(loadingFrom) loadingFrom.innerText = fromMatch ? fromMatch[1] : (searchFrom.value ? searchFrom.value.split(',')[0].toUpperCase() : 'FROM');
                    if(loadingTo) loadingTo.innerText = toMatch ? toMatch[1] : (searchTo.value ? searchTo.value.split(',')[0].toUpperCase() : 'TO');
                    
                    let progress = 0;
                    let interval = setInterval(() => {
                        progress += Math.floor(Math.random() * 15) + 5;
                        if (progress >= 100) progress = 100;
                        
                        progressBar.style.width = progress + '%';
                        if(loadingDot) loadingDot.style.left = progress + '%';
                        loadingPercentage.innerText = progress + '%';
                        
                        // Subtle bounce for airplane
                        let vehicle = document.getElementById('flyingVehicle');
                        if(vehicle) {
                            vehicle.style.transform = `translate(-50%, calc(-50% - ${progress % 5}px)) rotate(0deg)`;
                        }
                        
                        if (progress === 100) {
                            clearInterval(interval);
                            
                            // Map Input Values
                            if (searchFrom.value && qFromDetail) { qFromDetail.value = searchFrom.value; }
                            if (searchTo.value && qToDetail) { qToDetail.value = searchTo.value; }
                            
                            // Format Dates safely
                            try {
                                if (searchDep.value) { qDep.innerText = new Date(searchDep.value).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }); }
                                if (searchRet.value) { qRet.innerText = new Date(searchRet.value).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }); }
                            } catch(e) {}

                            setTimeout(() => {
                                loadingOverlay.classList.add('d-none');
                                
                                // Reset animation for next time
                                progressBar.style.width = '0%';
                                if(loadingDot) loadingDot.style.left = '0%';
                                loadingPercentage.innerText = '0%';
                                let vehicle = document.getElementById('flyingVehicle');
                                if(vehicle) vehicle.style.transform = 'translate(-50%, -50%) rotate(0deg)'; 
                                
                                // Show Quote Form Overlay
                                quoteOverlay.classList.remove('d-none');
                                document.body.style.overflow = 'hidden'; 
                            }, 400); 
                        }
                    }, 350); 
                });
            }

            if(closeQuoteBtn) {
                closeQuoteBtn.addEventListener('click', function() {
                    quoteOverlay.classList.add('d-none');
                    document.body.style.overflow = 'auto'; // restore scroll
                });
            }
            // Quote Form Submission
            const quoteForm = document.getElementById('passengerQuoteForm');
            if(quoteForm) {
                quoteForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const submitBtn = quoteForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerText;
                    submitBtn.innerText = 'Submitting...';
                    submitBtn.disabled = true;

                    // Gather data
                    const data = {
                        _token: document.querySelector('input[name="_token"]').value,
                        name: document.getElementById('qName').value,
                        email: document.getElementById('qEmail').value,
                        phone: document.getElementById('qPhone').value,
                        sms_updates: 0,
                        departure_city: document.getElementById('searchFrom') ? document.getElementById('searchFrom').value : '',
                        arrival_city: document.getElementById('searchTo') ? document.getElementById('searchTo').value : '',
                        departure_date: document.getElementById('searchDep') ? document.getElementById('searchDep').value : '',
                        return_date: document.getElementById('searchRet') ? document.getElementById('searchRet').value : '',
                    };

                    fetch('{{ route("flight-quote.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message || 'Quote requested successfully!');
                        quoteOverlay.classList.add('d-none');
                        document.body.style.overflow = 'auto'; // restore scroll
                        quoteForm.reset();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Something went wrong. Please try again.');
                    })
                    .finally(() => {
                        submitBtn.innerText = originalText;
                        submitBtn.disabled = false;
                    });
                });
            }
        });
    </script>
@endsection
