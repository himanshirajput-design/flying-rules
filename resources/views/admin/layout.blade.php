<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlightRules Admin Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/download.png') }}">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }
        
        /* Sidebar Styling */
        #sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            color: #fff;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
        }
        
        .brand-logo {
            padding: 2rem 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .brand-logo i {
            color: #0ea5e9;
            margin-right: 10px;
        }
        
        .nav-menu {
            padding: 1.5rem 1rem;
            list-style: none;
            margin: 0;
        }
        
        .nav-menu li {
            margin-bottom: 0.5rem;
        }
        
        .nav-menu a {
            color: #94a3b8;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.8rem 1.2rem;
            border-radius: 12px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .nav-menu a:hover, .nav-menu a.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .nav-menu a i {
            width: 24px;
            font-size: 1.1rem;
            margin-right: 10px;
            color: #0ea5e9;
        }
        
        /* Main Content Styling */
        #main-content {
            margin-left: 280px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .top-header {
            background: #fff;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .content-area {
            padding: 2rem;
            flex-grow: 1;
        }

        /* Card Enhancements */
        .card {
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table thead th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            border-bottom: none;
            padding: 1rem;
        }
        
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .btn-primary {
            background-color: #0ea5e9;
            border-color: #0ea5e9;
            border-radius: 10px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: #0284c7;
            border-color: #0284c7;
        }
        
        .badge {
            padding: 0.5em 0.8em;
            border-radius: 8px;
            font-weight: 500;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <i class="fas fa-paper-plane"></i> FlightRules
        </a>
        <ul class="nav-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.airlines.index') }}" class="{{ request()->routeIs('admin.airlines.*') ? 'active' : '' }}">
                    <i class="fas fa-plane-departure"></i> Airlines
                </a>
            </li>
            <li>
                <a href="{{ route('admin.policies.index') }}" class="{{ request()->routeIs('admin.policies.*') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i> Policies
                </a>
            </li>
            <li>
                <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="fas fa-blog"></i> Blog Posts
                </a>
            </li>
        </ul>
        
        <div class="position-absolute bottom-0 w-100 p-4 border-top" style="border-color: rgba(255,255,255,0.05) !important;">
            <a href="/" target="_blank" class="btn btn-outline-light w-100 rounded-3 text-start d-flex align-items-center justify-content-center">
                <i class="fas fa-external-link-alt me-2 text-cyan"></i> View Live Site
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <h4 class="mb-0 fw-bold text-dark">@yield('page_title', 'Overview')</h4>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-light bg-white border-0 dropdown-toggle d-flex align-items-center rounded-pill shadow-sm py-2 px-3" type="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0ea5e9&color=fff&rounded=true" alt="{{ auth()->user()->name }}" width="32" height="32" class="me-2">
                        <span class="fw-medium">{{ auth()->user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-4">
                        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user-circle me-2 text-muted"></i>Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 d-flex align-items-center">
                    <i class="fas fa-check-circle fs-4 me-3 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto position-relative" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-exclamation-triangle fs-5 me-2 text-danger"></i>
                        <strong>Please fix the following errors:</strong>
                    </div>
                    <ul class="mb-0 ps-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" style="top: 15px;" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
