<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Close Call - Find Your Dream Job</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script>
        // Scroll Animation
        function initScrollAnimations() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    } else {
                        entry.target.classList.remove('animate-in');
                    }
                });
            }, observerOptions);

            // Observe elements with animation classes
            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', initScrollAnimations);
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            overflow-x: hidden;
            width: 100%;
            max-width: 100%;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Navigation */
        .header {
            background: url('/image/headerbg.png') no-repeat center center;
            background-size: cover;
            padding: 60px 0 120px;
            position: relative;
        }
        
        .navigation {
            gap: 15px;
            position: relative;
            right: -5%;
        }
        
        .nav-link {
            color: #000000;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 12px;
            transition: opacity 0.3s ease;
        }
        
        .nav-link:hover {
            opacity: 0.7;
        }
        
        .profile-link {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        /* Hero Section */
        .hero-section {
            margin-bottom: 60px;
        }
        
        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 64px;
            line-height: 1.2;
            color: #000000;
            margin-bottom: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background: #FFFFFF;
            border: 1px solid #000000;
            border-radius: 25px;
            padding: 12px 20px;
            max-width: 50%;
            margin: 0 auto 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .search-input {
            border: none;
            outline: none;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            width: 100%;
            margin-left: 10px;
            color: #666;
        }
        
        .search-input::placeholder {
            color: #999;
        }
        
        .search-icon {
            width: 20px;
            height: 20px;
            color: #666;
        }
        
        /* Stats Section */
        .stats-container {
            gap: 15px;
        }
        
        .stat-card {
            border-radius: 42px;
            min-width: 130px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            gap: 12px;
            transition: transform 0.3s ease;
            width: 13%;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .stat-icon {
            width: 24px;
            height: 24px;
            object-fit: contain;
            flex-shrink: 0;
        }
        
        .stat-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-align: left;
        }
        
        .stat-number {
            font-weight: 700;
            font-size: 16px;
            color: #00A49C;
            margin-bottom: 2px;
            line-height: 1.2;
        }
        
        .stat-label {
            font-size: 11px;
            color: #666;
            line-height: 1.2;
        }
        
        /* Job Categories Section */
        .section {
            padding: 60px;
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }
        
        /* Section white background akan diganti dengan Tailwind */
        
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 18px;
            color: #000000;
        }
        
        .categories-grid {
            margin-bottom: 30px;
        }
        
        .category-card {
            background: #FFFFFF;
            border-radius: 15px;
            padding: 10px;
            text-align: left;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            width:100%;
            gap: 12px;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
        }
        
        .category-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }
        
        .category-content {
            flex: 1;
        }
        
        .category-name {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
            color: #000;
        }
        
        .category-positions {
            font-size: 16px;
            color: #666;
        }
        
        .see-all-link {
            display: block;
            text-align: left;
            color: #00A49C;
            text-decoration: none;
            font-weight: 500;
            margin-top: 20px;
        }
        
        /* Browse Jobs Section */
        .jobs-list {
            max-width: 100%;
        }
        
        .job-card {
            display: flex;
            width: 100%;
            align-items: center;
            background: #FFFFFF;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            gap: 20px;
        }
        
        .job-card:hover {
            transform: translateY(-2px);
        }
        
        .job-logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f0f0f0;
            flex-shrink: 0;
        }
        
        .job-details {
            flex: 1;
            min-width: 0;
        }
        
        .job-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
            color: #000;
        }
        
        .job-company {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .job-status {
            display: flex;
            align-items: center;
            color: #00A49C;
            font-size: 12px;
            gap: 8px;
        }
        
        .job-status img {
            filter: brightness(0) saturate(100%) invert(64%) sepia(96%) saturate(459%) hue-rotate(141deg) brightness(92%) contrast(101%);
        }
        
        .job-apply-btn {
            width: 40px;
            height: 40px;
            background: #00A49C;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: 300;
            transition: background 0.3s ease;
            flex-shrink: 0;
            margin-left: auto;
        }
        
        .job-apply-btn:hover {
            background: #008a7b;
        }
        
        /* Reviews Section */
        /* Reviews Section Background akan diganti dengan Tailwind */
        .reviews-section {
            background: #E6ECF1;
            width: 100vw;
            margin-left: calc(-50vw + 50%);
            padding: 60px calc(50vw - 50%);
        }
        
        .reviews-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
            width: 100%;
            min-width: 100%;
        }
        
        .review-card {
            background: #FFFFFF;
            border-radius: 30px;
            padding: 25px 15px;
            min-width: 220px;
            height: 350px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .reviewer-name {
            font-weight: 600;
            font-size: 20px;
            margin: 0 0 20px 0;
            color: #000;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .reviewer-avatar {
            width: 136px;
            height: 136px;
            border-radius: 50%;
            margin: 20px 0 20px 0;
            object-fit: cover;
            border: 3px solid #f0f0f0;
            flex-shrink: 0;
        }
        
        .review-spacer {
            flex-grow: 1;
        }
        
        .review-text {
            font-size: 16px;
            color: #000000;
            line-height: 1.5;
            margin-top: 20px;
            text-align: center;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            padding: 0 5px;
        }
        
        /* CloseCall AI Section */
        .ai-section {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .ai-logo {
            width: 136px;
            height: 136px;
            border-radius: 50%;
            margin: 0 auto 30px;
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(0,164,156,0.3);
        }
        
        .ai-title {
            font-weight: 700;
            font-size: 64px;
            margin-bottom: 20px;
            color: #000;
            line-height: 1.2;
        }
        
        .ai-description {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .ai-search-bar {
            display: flex;
            align-items: center;
            background: #FFFFFF;
            border: 1px solid #e0e0e0;
            border-radius: 25px;
            padding: 12px 20px;
            max-width: 100%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .ai-search-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            color: #666;
        }
        
        /* CTA Section */
        .cta-section {
            display: flex;
            min-height: 400px;
            background: #f8f9fa;
        }
        
        .cta-left {
            flex: 1;
            background: linear-gradient(135deg, #4db6ac 0%, #26a69a 50%, #00695c 100%);
            box-shadow: 0 4px 5px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .cta-left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            top: 20%;
            left: 10%;
            animation: float 6s ease-in-out infinite;
        }
        
        .cta-left::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            bottom: 30%;
            right: 15%;
            animation: float 8s ease-in-out infinite reverse;
        }
        
        .cta-sphere-1 {
            position: absolute;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.3), rgba(255,255,255,0.05));
            border-radius: 50%;
            top: 60%;
            left: 30%;
            animation: float 7s ease-in-out infinite;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .cta-sphere-2 {
            position: absolute;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), rgba(255,255,255,0.03));
            border-radius: 50%;
            bottom: 20%;
            left: 60%;
            animation: float 5s ease-in-out infinite reverse;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

         .cta-sphere-3 {
            position: absolute;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), rgba(255,255,255,0.03));
            border-radius: 50%;
            bottom: 60%;
            left: 70%;
            animation: float 6s ease-in-out infinite reverse;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

         .cta-sphere-4 {
            position: absolute;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), rgba(255,255,255,0.03));
            border-radius: 50%;
            bottom: 20%;
            left: 10%;
            animation: float 4s ease-in-out infinite reverse;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

          .cta-sphere-5 {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), rgba(255,255,255,0.03));
            border-radius: 50%;
            bottom: 20%;
            left: 70%;
            animation: float 4s ease-in-out infinite reverse;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

          .cta-sphere-6 {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), rgba(255,255,255,0.03));
            border-radius: 50%;
            bottom: -30%;
            left: 5%;
            animation: float 4s ease-in-out infinite reverse;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-90px);
            }
        }
        
        .cta-right {
            flex: 1;
            background: #e8eaf6;
            box-shadow: 0 4px 5px rgba(0, 0, 0, 0.5);
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .cta-title {
            font-weight: 700;
            font-size: 64px;
            margin-bottom: 20px;
            color: #000;
            line-height: 1.2;
        }
        
        .cta-description {
            font-size: 16px;
            margin-bottom: 40px;
            color: #666;
            line-height: 1.6;
            max-width: 400px;
            text-align: center;
        }
        
        .cta-buttons {
            display: flex;
            gap: 15px;
            flex-direction: column;
            display: flex;
            align-items: center;
        }
        
        .cta-button {
            background: #00A49C;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
            text-align: center;
            border: none;
            width: 270%;
        }
        
        .cta-button:hover {
            background: #008a7b;
        }
        
        .cta-button.secondary {
            background: #26a69a;
        }
        
        .cta-button.secondary:hover {
            background: #00695c;
        }
        
        /* Footer */
        .footer {
            background: #f8f9fa;
            padding: 60px 0 20px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .footer-column h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: #000;
        }
        
        .footer-link {
            display: block;
            color: #000000;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .footer-link:hover {
            color: #00A49C;
        }
        
        .footer-logo {
            width: 77px;
            height: 77px;
            border-radius: 8px;
            margin-bottom: 20px;
            object-fit: cover;
        }
        
        .footer-copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            color: #666;
            font-size: 14px;
        }
        
        /* Scroll Animation Styles */
        .scroll-animate {
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .scroll-animate-left {
            transform: translateX(-100px);
        }

        .scroll-animate-right {
            transform: translateX(100px);
        }

        .scroll-animate-up {
            transform: translateY(50px);
        }

        .scroll-animate-scale {
            transform: scale(0.8);
        }

        .scroll-animate.animate-in {
            opacity: 1;
            transform: translateX(0) translateY(0) scale(1);
        }

        /* Staggered animation delays */
        .scroll-animate.delay-100 { transition-delay: 0.1s; }
        .scroll-animate.delay-200 { transition-delay: 0.2s; }
        .scroll-animate.delay-300 { transition-delay: 0.3s; }
        .scroll-animate.delay-400 { transition-delay: 0.4s; }
        .scroll-animate.delay-500 { transition-delay: 0.5s; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 36px;
            }
            
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .category-card {
                gap: 12px;
            }
            
            .category-icon {
                width: 45px;
                height: 45px;
            }
            
            
            .review-card {
                min-width: 200px;
                height: 280px;
                padding: 20px 12px;
            }
            
            .reviewer-name {
                font-size: 18px;
                height: 22px;
                margin: 0 0 15px 0;
            }
            
            .reviewer-avatar {
                width: 70px;
                height: 70px;
                margin: 0 0 15px 0;
            }
            
            .review-text {
                font-size: 14px;
                height: 50px;
            }
            
            .navigation {
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
                padding-right: 0;
            }
            
            .stats-container {
                gap: 10px;
            }
            
            .stat-card {
                min-width: 110px;
                padding: 12px 15px;
                gap: 8px;
            }
            
            .stat-number {
                font-size: 14px;
            }
            
            .stat-label {
                font-size: 10px;
            }
            
            .cta-section {
                flex-direction: column;
                min-height: auto;
            }
            
            .cta-left {
                min-height: 300px;
            }
            
            .cta-right {
                padding: 40px 20px;
            }
            
            .cta-title {
                font-size: 36px;
            }
            
            .ai-logo {
                width: 80px;
                height: 80px;
            }
            
            .ai-title {
                font-size: 28px;
            }
            
            .ai-search-bar {
                max-width: 350px;
            }
            
            .footer-logo {
                width: 35px;
                height: 35px;
            }
            
            .profile-icon {
                width: 19px;
                height: 19px;
            }
        }
        
        @media (max-width: 480px) {
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .category-card {
                gap: 10px;
            }
            
            .category-icon {
                width: 40px;
                height: 40px;
            }
            
            
            .review-card {
                min-width: 180px;
                height: 260px;
                padding: 18px 10px;
            }
            
            .reviewer-name {
                font-size: 16px;
                height: 20px;
                margin: 0 0 12px 0;
            }
            
            .reviewer-avatar {
                width: 60px;
                height: 60px;
                margin: 0 0 12px 0;
            }
            
            .review-text {
                font-size: 13px;
                height: 45px;
            }
            
            .stats-container {
                gap: 8px;
            }
            
            .stat-card {
                min-width: 100px;
                padding: 10px 12px;
            }
            
            .stat-number {
                font-size: 13px;
            }
            
            .stat-label {
                font-size: 9px;
            }
            
            .ai-logo {
                width: 70px;
                height: 70px;
            }
            
            .ai-title {
                font-size: 24px;
            }
            
            .ai-search-bar {
                max-width: 320px;
                padding: 10px 15px;
            }
            
            .ai-description {
                font-size: 14px;
            }
            
            .footer-logo {
                width: 32px;
                height: 32px;
            }
            
            .navigation {
                justify-content: center;
                gap: 15px;
                padding-right: 0;
            }
            
            .nav-link {
                font-size: 13px;
                padding: 6px 10px;
            }
            
            .profile-icon {
                width: 18px;
                height: 18px;
            }
        }
    </style>
</head>
<body class="bg-white text-black leading-6 font-poppins">
    <!-- Header Section -->
    <div class="header">
        <div class="container w-full max-w-6xl mx-auto px-5">
            <nav class="navigation flex justify-end items-center mb-20 scroll-animate scroll-animate-up">
                <a href="#" class="nav-link">Home</a>
                <a href="#" class="nav-link">Browse Jobs</a>
                <a href="#" class="nav-link">Reviews</a>
                <a href="#" class="nav-link">CloseCall AI</a>
                <a href="/login" class="nav-link">Login</a>
                <a href="/register" class="nav-link">Sign Up</a>
            </nav>
            
            <!-- Hero Section -->
            <div class="hero-section text-center scroll-animate scroll-animate-left">
                <h1 class="hero-title scroll-animate scroll-animate-up delay-200">Countless job offers waiting for you!</h1>
                
                <div class="search-bar scroll-animate scroll-animate-up delay-300">
                    <svg class="search-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                    <input type="text" class="search-input" placeholder="Search...">
                </div>
                
                <div class="stats-container flex justify-center flex-wrap">
                    <div class="stat-card bg-white px-5 py-2 flex flex-row items-center scroll-animate scroll-animate-scale delay-100">
                        <img src="{{ asset('image/livejobs.png') }}" alt="Live Jobs" class="stat-icon">
                        <div class="stat-content">
                            <div class="stat-number">15,020</div>
                            <div class="stat-label">Live Jobs</div>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white px-5 py-2 flex flex-row items-center scroll-animate scroll-animate-scale delay-200">
                        <img src="{{ asset('image/companies.png') }}" alt="Companies" class="stat-icon">
                        <div class="stat-content">
                            <div class="stat-number">3,047</div>
                            <div class="stat-label">Companies</div>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white px-5 py-2 flex flex-row items-center scroll-animate scroll-animate-scale delay-300">
                        <img src="{{ asset('image/candidates.png') }}" alt="Candidates" class="stat-icon">
                        <div class="stat-content">
                            <div class="stat-number">301,563</div>
                            <div class="stat-label">Candidates</div>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white px-5 py-2 flex flex-row items-center scroll-animate scroll-animate-scale delay-400">
                        <img src="{{ asset('image/newjobs.png') }}" alt="New Jobs" class="stat-icon">
                        <div class="stat-content">
                            <div class="stat-number">2,072</div>
                            <div class="stat-label">New Jobs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Job Categories Section -->
    <section class="section bg-white scroll-animate scroll-animate-right">
        <div class="container w-full max-w-6xl mx-auto px-5">
            <h2 class="section-title text-left scroll-animate scroll-animate-up delay-200">Job Categories</h2>
            
            <div class="categories-grid grid grid-cols-4 gap-5">
                <div class="category-card scroll-animate scroll-animate-left delay-100">
                    <img src="{{ asset('image/graphicdesign.png') }}" alt="Graphics & Design" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Graphics & Design</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-right delay-200">
                    <img src="{{ asset('image/musicaudio.png') }}" alt="Code & Programming" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Code & Programming</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-left delay-300">
                    <img src="{{ asset('image/digitalmarketing.png') }}" alt="Digital Marketing" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Digital Marketing</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-right delay-400">
                    <img src="{{ asset('image/videoanimation.png') }}" alt="Video & Animation" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Video & Animation</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-left delay-100">
                    <img src="{{ asset('image/musicaudio.png') }}" alt="Music & Audio" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Music & Audio</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-right delay-200">
                    <img src="{{ asset('image/accountfinance.png') }}" alt="Account & Finance" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Account & Finance</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-left delay-300">
                    <img src="{{ asset('image/healthcare.png') }}" alt="Health & Care" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Health & Care</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
                
                <div class="category-card scroll-animate scroll-animate-right delay-400">
                    <img src="{{ asset('image/datascience.png') }}" alt="Data & Science" class="category-icon">
                    <div class="category-content">
                        <div class="category-name">Data & Science</div>
                        <div class="category-positions">100 open positions</div>
                    </div>
                </div>
            </div>
            
            <a href="#" class="see-all-link scroll-animate scroll-animate-up delay-500">See all...</a>
        </div>
    </section>
    
    <!-- Browse Jobs Section -->
    <section class="section bg-white scroll-animate scroll-animate-left">
        <div class="container w-full max-w-6xl mx-auto px-5">
            <h2 class="section-title text-left scroll-animate scroll-animate-up delay-200">Browse Jobs</h2>
            
            <div class="jobs-list">
                <div class="job-card scroll-animate scroll-animate-right delay-100">
                    <img src="{{ asset('image/dataanalyst.png') }}">
                    <div class="job-details">
                        <div class="job-title">Data Analyst</div>
                        <div class="job-company">Indonesia | GRHA Digital</div>
                        <div class="job-status">
                            <img src="{{ asset('image/eye.png') }}" alt="Viewing" width="16" height="10">
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn">+</a>
                </div>
                
                <div class="job-card scroll-animate scroll-animate-left delay-200">
                    <img src="{{ asset('image/socialmediamanager.png') }}" alt="Best Partner Education" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Social Media Manager</div>
                        <div class="job-company">Indonesia | Best Partner Education</div>
                        <div class="job-status">
                            <img src="{{ asset('image/eye.png') }}" alt="Viewing" width="16" height="10">
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn">+</a>
                </div>
                
                <div class="job-card scroll-animate scroll-animate-right delay-300">
                    <img src="{{ asset('image/mechanicalengineer.png') }}" alt="R-Tech Computer" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Mechanical Engineer</div>
                        <div class="job-company">Indonesia | R-Tech Computer</div>
                        <div class="job-status">
                            <img src="{{ asset('image/eye.png') }}" alt="Viewing" width="16" height="10">
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn">+</a>
                </div>
                
                <div class="job-card scroll-animate scroll-animate-left delay-400">
                    <img src="{{ asset('image/marketingteam.png') }}" alt="DNA Indonesia" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Marketing Team</div>
                        <div class="job-company">Indonesia | DNA Indonesia</div>
                        <div class="job-status">
                            <img src="{{ asset('image/eye.png') }}" alt="Viewing" width="16" height="10">
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn">+</a>
                </div>
                
                <div class="job-card scroll-animate scroll-animate-right delay-500">
                    <img src="{{ asset('image/accountant.png') }}" alt="SOECHI GROUP" class="job-logo">
                    <div class="job-details">
                        <div class="job-title">Accountant</div>
                        <div class="job-company">Indonesia | SOECHI GROUP</div>
                        <div class="job-status">
                            <img src="{{ asset('image/eye.png') }}" alt="Viewing" width="16" height="10">
                            Actively reviewing applications
                        </div>
                    </div>
                    <a href="#" class="job-apply-btn">+</a>
                </div>
            </div>
            
            <a href="#" class="see-all-link scroll-animate scroll-animate-up delay-500">See all...</a>
        </div>
    </section>
    
    <!-- Reviews Section -->
    <section class="reviews-section scroll-animate scroll-animate-right">
        <div class="container w-full max-w-6xl mx-auto px-5">
            <h2 class="section-title text-left scroll-animate scroll-animate-up delay-200">Reviews</h2>
            
            <div class="reviews-container">
                <div class="review-card scroll-animate scroll-animate-scale delay-100">
                    <div class="reviewer-name">Sammy Louise</div>
                    <img src="{{ asset('image/sammy.png') }}" alt="Sammy Louise" class="reviewer-avatar">
                    <div class="review-spacer"></div>
                    <div class="review-text">"I found a long-term job through here, it's amazing!"</div>
                </div>
                
                <div class="review-card scroll-animate scroll-animate-scale delay-200">
                    <div class="reviewer-name">Jennifer Lim</div>
                    <img src="{{ asset('image/jennifer.png') }}" alt="Jennifer Lim" class="reviewer-avatar">
                    <div class="review-spacer"></div>
                    <div class="review-text">"This helped me find the most suitable work-place!"</div>
                </div>
                
                <div class="review-card scroll-animate scroll-animate-scale delay-300">
                    <div class="reviewer-name">Anthony Brown</div>
                    <img src="{{ asset('image/anthony.png') }}" alt="Anthony Brown" class="reviewer-avatar">
                    <div class="review-spacer"></div>
                    <div class="review-text">"Amazing platform, it's filled with countless opportunities."</div>
                </div>
                
                <div class="review-card scroll-animate scroll-animate-scale delay-400">
                    <div class="reviewer-name">Timothy Wang</div>
                    <img src="{{ asset('image/timothy.png') }}" alt="Timothy Wang" class="reviewer-avatar">
                    <div class="review-spacer"></div>
                    <div class="review-text">"This web succeeded my expectations, and landed me into a great job!"</div>
                </div>
                
                <div class="review-card scroll-animate scroll-animate-scale delay-500">
                    <div class="reviewer-name">Meiling</div>
                    <img src="{{ asset('image/meiling.png') }}" alt="Meiling" class="reviewer-avatar">
                    <div class="review-spacer"></div>
                    <div class="review-text">"I've never felt so at ease when it comes to looking for job."</div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CloseCall AI Section -->
    <section class="section bg-white scroll-animate scroll-animate-left">
        <div class="container w-full max-w-6xl mx-auto px-5">
            <div class="ai-section text-center">
                <img src="{{ asset('image/AI.png') }}" alt="CloseCall AI" class="ai-logo scroll-animate scroll-animate-scale delay-100">
                
                <h2 class="ai-title scroll-animate scroll-animate-up delay-200">Check out our new<br>CloseCall AI!</h2>
                
                <p class="ai-description scroll-animate scroll-animate-up delay-300">"With CloseCall AI, you gain a smart career assistant that helps make creating professional resumes and prepare for applications easier than ever to land your dream job."</p>
                
                <div class="ai-search-bar scroll-animate scroll-animate-up delay-400">
                    <svg class="ai-search-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4l4 4 4-4h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                    </svg>
                    <input type="text" class="search-input" placeholder="Ask Something...">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Call-to-Action Section -->
    <section class="cta-section scroll-animate scroll-animate-up">
        <div class="cta-left">
            <div class="cta-sphere-1"></div>
            <div class="cta-sphere-2"></div>
            <div class="cta-sphere-3"></div>
            <div class="cta-sphere-4"></div>
            <div class="cta-sphere-5"></div>
            <div class="cta-sphere-6"></div>
        </div>
        <div class="cta-right">
            <h2 class="cta-title scroll-animate scroll-animate-scale delay-200">Join us now!</h2>
            
            <p class="cta-description scroll-animate scroll-animate-up delay-300">"Join CloseCall today and start exploring tailored opportunities that match your skills and goals! We'll help you land the dream job you've been searching for."</p>
            
            <div class="cta-buttons">
                <a href="/register" class="cta-button scroll-animate scroll-animate-up delay-400">Register</a>
                <a href="#" class="cta-button secondary scroll-animate scroll-animate-up delay-500">Login</a>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="footer-logo">
                </div>
                
                <div class="footer-column">
                    <a href="#" class="footer-link">About</a>
                    <a href="#" class="footer-link">Accessibility</a>
                    <a href="#" class="footer-link">Help Center</a>
                    <a href="#" class="footer-link">Services</a>
                </div>
                
                <div class="footer-column">
                    <a href="#" class="footer-link">Contact Us</a>
                    <a href="#" class="footer-link">Business Services</a>
                    <a href="#" class="footer-link">Ads</a>
                    <a href="#" class="footer-link">More</a>
                </div>
                
                <div class="footer-column">
                    <a href="#" class="footer-link">Home</a>
                    <a href="#" class="footer-link">Jobs</a>
                    <a href="#" class="footer-link">Reviews</a>
                    <a href="#" class="footer-link">AI</a>
                </div>
                
                <div class="footer-column">
                    <a href="#" class="footer-link">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms</a>
                    <a href="#" class="footer-link">Affiliate</a>
                    <a href="#" class="footer-link">Categories</a>
                </div>
            </div>
            
            <div class="footer-copyright">
                CloseCall © 2025
            </div>
        </div>
    </footer>
</body>
</html>