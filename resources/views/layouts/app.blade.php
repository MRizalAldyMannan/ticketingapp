<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ticket Management Security Lab')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Sidebar Basic Resets */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* light gray bg */
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 78px; /* Default collapsed width */
            background: #0f172a; /* Slate 900 */
            z-index: 100;
            transition: all 0.4s ease;
        }
        
        .sidebar.open {
            width: 260px; /* Expanded width */
        }
        
        /* Logo / Header */
        .sidebar .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        .sidebar .logo-details .icon {
            color: #fff;
            font-size: 24px;
            min-width: 40px; /* aligns with text */
            text-align: center;
        }
        .sidebar .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 700;
            opacity: 0;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .sidebar.open .logo-details .logo_name {
            opacity: 1;
        }
        
        /* Nav Links */
        .sidebar .nav-list {
            height: calc(100% - 150px); /* Leave room for logo and profile */
            padding-left: 0;
            list-style: none;
            overflow-y: auto;
            overflow-x: hidden;
            margin-bottom: 0;
            margin-top: 15px;
        }
        /* Custom Scrollbar */
        .sidebar .nav-list::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar .nav-list::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 5px;
        }

        .sidebar .nav-list li {
            position: relative;
            margin: 8px 12px;
            list-style: none;
        }
        
        /* Links and Accordion buttons */
        .sidebar .nav-list li a,
        .sidebar .nav-list li .iocn-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            border-radius: 8px;
            color: #cbd5e1; /* slate 300 */
            transition: all 0.3s ease;
            padding: 12px 10px;
            cursor: pointer;
        }
        
        .sidebar .nav-list li a:hover,
        .sidebar .nav-list li .iocn-link:hover {
            background: #1e293b; /* lighter slate */
            color: #fff;
        }
        .sidebar .nav-list li a.active {
            background: #2563eb; /* Active blue highlight */
            color: #fff;
        }

        .sidebar .nav-list li i {
            min-width: 35px;
            text-align: center;
            font-size: 18px;
        }
        
        .sidebar .nav-list li .link_name {
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
        }
        .sidebar.open .nav-list li .link_name {
            opacity: 1;
            pointer-events: auto;
        }

        /* Tooltip behavior when collapsed */
        .sidebar .nav-list li .tooltip_bg {
            position: absolute;
            top: 50%;
            left: calc(100% + 15px);
            transform: translateY(-50%);
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            padding: 6px 12px;
            color: #0f172a;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0s;
            z-index: 100;
        }
        .sidebar:not(.open) .nav-list li:hover .tooltip_bg {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
        }

        /* Dropdown Chevron */
        .sidebar .nav-list li .iocn-link {
            justify-content: space-between;
        }
        .sidebar .nav-list li .iocn-link .toggle-area {
            display: flex;
            align-items: center;
        }
        .sidebar .nav-list li .iocn-link .arrow {
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0;
            font-size: 14px;
        }
        .sidebar.open .nav-list li .iocn-link .arrow {
            opacity: 1;
        }
        .sidebar .nav-list li.showMenu .arrow {
            transform: rotate(-180deg);
        }

        /* Sub-menu styling */
        .sidebar .nav-list li .sub-menu {
            padding: 6px 6px 6px 45px;
            margin-top: 0px;
            display: none;
            list-style: none;
        }
        .sidebar .nav-list li.showMenu .sub-menu {
            display: block;
        }
        .sidebar .nav-list li .sub-menu li {
            margin: 2px 0;
        }
        .sidebar .nav-list li .sub-menu a {
            color: #94a3b8;
            font-size: 14px;
            padding: 8px 10px;
            white-space: nowrap;
            border-radius: 6px;
        }
        .sidebar .nav-list li .sub-menu a:hover,
        .sidebar .nav-list li .sub-menu a.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }
        /* When collapsed, hide sub-menu completely to avoid overflow */
        .sidebar:not(.open) .nav-list li .sub-menu {
            display: none !important;
        }

        /* Profile Block Styling - NO PFP, just name and email */
        .profile-container {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #0B1120; /* Darker slate for footer */
            padding: 15px 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
            transition: all 0.4s ease;
            height: 70px;
        }
        /* hide details when collapsed */
        .sidebar:not(.open) .profile-container {
            justify-content: center;
        }
        .profile-container .profile-details {
            display: flex;
            flex-direction: column;
            white-space: nowrap;
            opacity: 1;
            transition: all 0.3s;
            max-width: 165px;
            overflow: hidden;
        }
        .sidebar:not(.open) .profile-details {
            opacity: 0;
            display: none;
        }
        .profile-container .profile-details .name {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .profile-container .profile-details .email {
            font-size: 12px;
            color: #94a3b8;
            text-overflow: ellipsis;
            overflow: hidden;
        }
        .logout-btn a, .logout-btn button {
            background: transparent;
            border: none;
            color: #f87171; /* red 400 */
            font-size: 18px;
            cursor: pointer;
            transition: color 0.2s;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
        }
        .logout-btn button:hover, .logout-btn a:hover {
            color: #dc2626;
        }

        /* Main Content wrapper */
        .home-section {
            position: relative;
            background: #f3f4f6;
            min-height: 100vh;
            left: 78px;
            width: calc(100% - 78px);
            transition: all 0.4s ease;
        }
        .sidebar.open ~ .home-section {
            left: 260px;
            width: calc(100% - 260px);
        }
        
        /* Top Hamburger Nav */
        .home-section .navbar-top {
            height: 60px;
            background: #fff;
            display: flex;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .home-section .navbar-top .bx-menu {
            font-size: 22px;
            cursor: pointer;
            color: #0f172a;
            padding: 5px;
            border-radius: 5px;
            transition: background 0.2s;
        }
        .home-section .navbar-top .bx-menu:hover {
            background: #f1f5f9;
        }
        
        .main-content {
            padding: 24px;
            padding-bottom: 50px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 78px;
            }
            .sidebar.open {
                width: 250px;
            }
            .home-section {
                left: 78px;
                width: calc(100% - 78px);
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar"> <!-- Collapsed by default -->
    <div class="logo-details" onclick="toggleSidebar()">
        <i class="fas fa-shield-halved icon text-success"></i>
        <span class="logo_name">Security Lab</span>
    </div>
    
    <ul class="nav-list">
        <!-- Dashboard Menu -->
        @auth
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-gauge-high"></i>
                <span class="link_name">Dashboard</span>
            </a>
            <span class="tooltip_bg">Dashboard</span>
        </li>
        @endauth
        
        <!-- Tickets Menu -->
        <li>
            <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.index') ? 'active' : '' }}">
                <i class="fas fa-ticket-alt"></i>
                <span class="link_name">Tickets</span>
            </a>
            <span class="tooltip_bg">Tickets</span>
        </li>
        
        <li>
            <a href="{{ route('tickets.create') }}" class="{{ request()->routeIs('tickets.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i>
                <span class="link_name">Create Ticket</span>
            </a>
            <span class="tooltip_bg">Create Ticket</span>
        </li>

        <!-- Konsep Keamanan (Accordion) -->
        <li>
            <div class="iocn-link" onclick="toggleSubMenu(this)">
                <div class="toggle-area">
                    <i class="fas fa-user-secret"></i>
                    <span class="link_name">Konsep Dasar</span>
                </div>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('security.xss') }}" class="{{ request()->routeIs('security.xss') ? 'active' : '' }}">Demo XSS</a></li>
                <li><a href="{{ route('security.csrf') }}" class="{{ request()->routeIs('security.csrf') ? 'active' : '' }}">Demo CSRF</a></li>
                <li><a href="{{ route('security.headers') }}" class="{{ request()->routeIs('security.headers') ? 'active' : '' }}">Info Headers</a></li>
                <li><a href="{{ route('security.validation') }}" class="{{ request()->routeIs('security.validation') ? 'active' : '' }}">Validasi Input</a></li>
            </ul>
            <span class="tooltip_bg">Konsep Dasar</span>
        </li>

        <!-- CSRF Module 3 -->
        <li>
            <div class="iocn-link" onclick="toggleSubMenu(this)">
                <div class="toggle-area">
                    <i class="fas fa-bug"></i>
                    <span class="link_name">CSRF Lab</span>
                </div>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('csrf-lab.index') }}">Overview</a></li>
                <li><a href="{{ route('csrf-lab.how-it-works') }}">How It Works</a></li>
                <li><a href="{{ route('csrf-lab.attack-demo') }}">Attack Demo</a></li>
                <li><a href="{{ route('csrf-lab.protection-demo') }}">Protection Demo</a></li>
                <li><a href="{{ route('csrf-lab.ajax-demo') }}">AJAX Example</a></li>
            </ul>
            <span class="tooltip_bg">CSRF Lab (Mod 3)</span>
        </li>

        <!-- SQLi Module 4 -->
        <li>
            <div class="iocn-link" onclick="toggleSubMenu(this)">
                <div class="toggle-area">
                    <i class="fas fa-database"></i>
                    <span class="link_name">SQLi Lab</span>
                </div>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('sqli-lab.index') }}">Overview</a></li>
                <li><a href="{{ route('sqli-lab.vulnerable-search') }}" class="text-danger">Vuln Search</a></li>
                <li><a href="{{ route('sqli-lab.vulnerable-login') }}" class="text-danger">Vuln Login</a></li>
                <li><a href="{{ route('sqli-lab.blind-sqli') }}" class="text-danger">Blind SQLi</a></li>
                <li><a href="{{ route('sqli-lab.secure-search') }}" class="text-success">Secure Search</a></li>
                <li><a href="{{ route('sqli-lab.cheatsheet') }}">Cheatsheet</a></li>
            </ul>
            <span class="tooltip_bg">SQLi Lab (Mod 4)</span>
        </li>

        <!-- BAC Module 5 -->
        <li>
            <div class="iocn-link" onclick="toggleSubMenu(this)">
                <div class="toggle-area">
                    <i class="fas fa-door-open"></i>
                    <span class="link_name">BAC Lab</span>
                </div>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('bac-lab.index') }}">Overview BAC</a></li>
                <li><a href="{{ route('bac-lab.comparison') }}">BAC Comparison</a></li>
                <li><a href="{{ route('bac-lab.vulnerable-dashboard') }}" class="text-danger">Vuln Dashboard</a></li>
                <li><a href="{{ route('bac-lab.secure-dashboard') }}" class="text-success">Secure Dashboard</a></li>
            </ul>
            <span class="tooltip_bg">BAC Lab (Mod 5)</span>
        </li>

        <!-- File Upload Module 6 -->
        <li>
            <div class="iocn-link" onclick="toggleSubMenu(this)">
                <div class="toggle-area">
                    <i class="fas fa-file-upload"></i>
                    <span class="link_name">Upload Lab</span>
                </div>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('upload-lab.index') }}">Overview Upload</a></li>
                <li><a href="{{ route('upload-lab.logging') }}">Security Logs</a></li>
                <li><a href="{{ route('upload-lab.basic') }}">Basic Form</a></li>
                <li><a href="{{ route('upload-lab.vulnerable') }}" class="text-danger">Vuln Upload</a></li>
                <li><a href="{{ route('upload-lab.secure') }}" class="text-success">Secure Upload</a></li>
            </ul>
            <span class="tooltip_bg">Upload Lab (Mod 6)</span>
        </li>

        <!-- Auth Module -->
        <li>
            <div class="iocn-link" onclick="toggleSubMenu(this)">
                <div class="toggle-area">
                    <i class="fas fa-lock"></i>
                    <span class="link_name">Auth Module</span>
                </div>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="{{ route('security.auth-comparison') }}">Auth Comparison</a></li>
                <li><a href="{{ route('vulnerable.login') }}" class="text-danger">Vuln Login</a></li>
                <li><a href="{{ route('vulnerable.register') }}" class="text-danger">Vuln Register</a></li>
            </ul>
            <span class="tooltip_bg">Auth Security</span>
        </li>
    </ul>

    <!-- Bottom Profile Area -->
    <div class="profile-container">
        @auth
            <div class="profile-details">
                <div class="name" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</div>
                <div class="email" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</div>
            </div>
            <div class="logout-btn">
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <button type="submit" title="Logout"><i class="fas fa-sign-out-alt"></i></button>
                </form>
            </div>
        @else
            <div class="profile-details">
                <div class="name">Guest</div>
                <div class="email">Not logged in</div>
            </div>
            <div class="logout-btn">
                <a href="{{ route('login') }}" title="Login" class="text-success"><i class="fas fa-sign-in-alt"></i></a>
            </div>
        @endauth
    </div>
</div>

<section class="home-section">
    <div class="navbar-top">
        <i class="fas fa-bars bx-menu" id="btn" onclick="toggleSidebar()"></i>
        <h5 class="ms-3 mb-0 fw-bold text-secondary">
            @yield('title', 'Ticket Management Security Lab')
        </h5>
    </div>

    <main class="main-content">
        {{-- Flash Message System --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- For blade.php using extends --}}
        @yield('content')
        
        {{-- For blade components using <x-app-layout> --}}
        @if(isset($slot))
            {{ $slot }}
        @endif
    </main>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let sidebar = document.querySelector(".sidebar");

    // Toggle Sidebar Width
    function toggleSidebar() {
        sidebar.classList.toggle("open");
        
        // If sidebar is collapsed, close all menus to keep it neat
        if(!sidebar.classList.contains("open")) {
            let menus = document.querySelectorAll('.nav-list li');
            menus.forEach(menu => {
                menu.classList.remove('showMenu');
            });
        }
    }

    // Toggle Submenus (Accordion Logic)
    function toggleSubMenu(element) {
        // If sidebar is currently collapsed, expanding a submenu should expand the sidebar
        if(!sidebar.classList.contains("open")) {
            sidebar.classList.add("open");
        }
        
        let parentLi = element.parentElement;
        
        // Optional: Close other open menus (accordion effect)
        let allLi = document.querySelectorAll('.nav-list li');
        allLi.forEach(li => {
            if(li !== parentLi && li.classList.contains("showMenu")) {
                li.classList.remove("showMenu");
            }
        });
        
        parentLi.classList.toggle("showMenu");
    }
</script>
@stack('scripts')
</body>
</html>
