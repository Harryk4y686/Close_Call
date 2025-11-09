<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CloseCall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Keyframe Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0,0,0);
            }
            40%, 43% {
                transform: translate3d(0, -8px, 0);
            }
            70% {
                transform: translate3d(0, -4px, 0);
            }
            90% {
                transform: translate3d(0, -2px, 0);
            }
        }
        
        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes rotateIn {
            from {
                opacity: 0;
                transform: rotate(-180deg) scale(0.8);
            }
            to {
                opacity: 1;
                transform: rotate(0deg) scale(1);
            }
        }
        
        /* Animation Classes */
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        .animate-fadeInLeft {
            animation: fadeInLeft 0.8s ease-out forwards;
        }
        
        .animate-fadeInRight {
            animation: fadeInRight 0.8s ease-out forwards;
        }
        
        .animate-scaleIn {
            animation: scaleIn 0.6s ease-out forwards;
        }
        
        .animate-slideInFromTop {
            animation: slideInFromTop 0.8s ease-out forwards;
        }
        
        .animate-slideInFromBottom {
            animation: slideInFromBottom 0.8s ease-out forwards;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        .animate-bounce {
            animation: bounce 1s infinite;
        }
        
        .animate-rotateIn {
            animation: rotateIn 0.8s ease-out forwards;
        }
        
        /* Staggered Animation Delays */
        /* Animation delays removed for smoother loading */
        
        /* Header styles from jobs.blade.php */
        .header {
            background: white;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 70px;
            gap: 1rem;
            margin-left: 0px;
            padding-left: 129px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .header:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        .search-bar {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 0.5rem 1rem;
            width: 504px;
            border: 1px solid #000000;
            height: 40px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .search-bar:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #00A88F;
        }
        
        .search-bar:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 168, 143, 0.2);
            border-color: #00A88F;
        }
        
        .search-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .search-bar:hover::before {
            left: 100%;
        }
        .search-bar input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            color: #000000;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }
        .search-bar input::placeholder {
            color: #000000;
        }
        .notification-icon, .avatar-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            transition: background-color 0.3s;
            text-decoration: none;
            color: inherit;
        }
        .notification-icon:hover, .avatar-icon:hover {
            background: #e5e7eb;
        }
        
        /* Main content */
        .main-content {
            margin-left: 109px;
            padding: 0;
            min-height: 100vh;
        }
        
        /* Content wrapper */
        .content-wrapper {
            padding: 24px 60px;
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Job Detail Styles */
        .job-header {
            background: linear-gradient(135deg, #a8d5ba 0%, #7eb3d3 100%);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 50px;
            position: relative;
            min-height: 200px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .job-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }
        
        .job-header:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .job-company-info {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: -50px;
            position: relative;
            z-index: 1;
        }
        
        .company-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        .header-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
            align-self: flex-end;
            margin-bottom: 8px;
        }
        
        .company-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
            padding-top: 0px;
        }
        
        .company-logo {
            width: 172px;
            height: 172px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            object-fit: cover;
            margin-top: -140px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .company-logo:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .company-details h3 {
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 4px 0;
            color: #333;
        }
        
        .company-location {
            color: #666;
            font-size: 16px;
            margin-bottom: 8px;
        }
        
        .apply-btn {
            background: #00A88F;
            color: white;
            padding: 12px 32px;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 200px;
        }
        
        .apply-btn:hover {
            background: #008B7A;
        }
        
        .options-btn {
            background: transparent;
            border: none;
            color: #666;
            padding: 8px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            font-size: 18px;
            font-weight: bold;
        }
        
        .options-btn:hover {
            background: #f3f4f6;
        }
        
        /* Options Dropdown Menu */
        .options-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            z-index: 1000;
            display: none;
            overflow: hidden;
        }
        
        .options-dropdown.show {
            display: block;
        }
        
        .dropdown-item {
            padding: 12px 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-item:hover {
            background-color: #f9fafb;
        }
        
        .dropdown-item.danger {
            color: #dc2626;
        }
        
        .dropdown-item.danger:hover {
            background-color: #fef2f2;
        }
        
        .header-buttons {
            position: relative;
        }
        
        /* Horizontal Divider */
        .nav-divider {
            border: none;
            height: 1px;
            background-color: #000000;
            margin: 16px -20px 8px -20px;
            width: calc(100% + 40px);
        }
        
        /* Navigation Tabs */
        .nav-tabs {
            display: flex;
            margin-top: 0;
        }
        
        .nav-tab {
            flex: 1;
            padding: 16px 0;
            text-align: center;
            background: none;
            border: none;
            font-size: 16px;
            font-weight: 500;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .nav-tab::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.1), transparent);
            transition: left 0.3s;
        }
        
        .nav-tab:hover::before {
            left: 100%;
        }
        
        .nav-tab.active {
            color: #333;
        }
        
        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: #00A88F;
        }
        
        .nav-tab:hover {
            color: #333;
        }
        
        /* Content Sections */
        .content-sections {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 24px;
            transition: all 0.3s ease;
        }
        
        .content-section {
            margin-bottom: 24px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        
        .section-content {
            color: #555;
            line-height: 1.6;
        }
        
        .section-content ul {
            margin: 8px 0;
            padding-left: 20px;
        }
        
        .section-content li {
            margin-bottom: 4px;
        }
        
        /* Locations Section */
        .locations-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 24px;
            transition: all 0.3s ease;
        }
        
        .locations-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #333;
        }
        
        .location-content {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        
        .location-details {
            flex: 1; /* take remaining space */
        }
        
        .location-headquarters {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        
        .location-address {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
            margin-bottom: 12px;
        }
        
        .get-directions {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #00A88F;
            text-decoration: none;
            font-weight: 800;
            font-size: 18px;
        }
        
        .get-directions:hover {
            text-decoration: underline;
        }
        
        .get-directions img {
            width: 16px;
            height: 16px;
        }
        
        .map-container {
            width: 250px;
            height: 250px;
            background-color: #f0f2f5;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 16px;
            flex-shrink: 0; /* prevent shrinking */
        }
        
        .map-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }
        
        /* Active Jobs Section */
        .active-jobs-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 24px;
        }
        
        .active-jobs-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 16px;
            color: #333;
        }
        
        .job-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }
        
        .job-logo {
            border-radius: 8px;
            flex-shrink: 0;
        }
        
        .job-info {
            flex: 1;
        }
        
        .job-title-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        
        .job-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .job-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        
        .job-apply {
            background: #00A88F;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .job-apply:hover {
            background: #008B7A;
            transform: translateY(-1px);
        }
        
        .job-more {
            padding: 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        
        .job-more:hover {
            background: #f3f4f6;
        }
        
        .job-subinfo {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .job-meta {
            display: flex;
            gap: 8px;
        }
        
        .job-meta-item {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .job-meta-item--green {
            background: #d1fae5;
            color: #065f46;
        }
        
        .job-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.05), transparent);
            transition: left 0.5s;
        }
        
        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .job-card:hover::before {
            left: 100%;
        }
        
        .job-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        
        .job-info {
            flex: 1;
        }
        
        .job-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 8px 0;
            color: #333;
        }
        
        .job-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        
        .job-meta span {
            font-size: 14px;
            color: #666;
        }
        
        .job-actions {
            display: flex;
            gap: 8px;
        }
        
        .apply-job-btn, .save-job-btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .apply-job-btn::before, .save-job-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .apply-job-btn {
            background: #00A88F;
            color: white;
        }
        
        .apply-job-btn:hover {
            background: #008B7A;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 168, 143, 0.3);
        }
        
        .apply-job-btn:hover::before {
            left: 100%;
        }
        
        .save-job-btn {
            background: #f3f4f6;
            color: #666;
            border: 1px solid #e5e7eb;
        }
        
        .save-job-btn:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .save-job-btn:hover::before {
            left: 100%;
        }
        
        .job-description {
            color: #555;
            line-height: 1.6;
        }
        
        .job-description p {
            margin-bottom: 12px;
        }
        
        .job-requirements h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 16px 0 8px 0;
            color: #333;
        }
        
        .job-requirements ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .job-requirements li {
            margin-bottom: 4px;
            color: #555;
        }
        
        /* Sidebar styles from jobs.blade.php */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 109px;
            height: 100vh;
            background: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem 0;
            z-index: 1000;
        }
        .sidebar-logo {
            width: 61px;
            height: 61px;
            margin-bottom: 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }
        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .sidebar-icon-img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
        .sidebar-icon {
            width: 60px;
            height: 60px;
            margin: 0.5rem 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: background-color 0.3s;
            position: relative;
            text-decoration: none;
            color: inherit;
        }
        .sidebar-icon:hover {
            background-color: #f3f4f6;
        }
        .sidebar-icon.active {
            background-color: #f3f4f6;
        }
        .sidebar-icon.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 20px;
            background: linear-gradient(to bottom, #00A88F, #81e6d9);
            border-radius: 0 2px 2px 0;
        }
        
        /* Mobile Responsive for Header */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
                padding-left: 129px;
                flex-wrap: wrap;
                justify-content: center;
                height: auto;
                gap: 0.75rem;
            }
            
            .search-bar {
                width: 100%;
                max-width: 350px;
            }
            
        }
        
        @media (max-width: 480px) {
            .header {
                padding-left: 120px;
            }
            
            .search-bar {
                max-width: 280px;
            }
        }
        /* Detailed Jobs Section Styles */
.detailed-jobs-section {
    margin-top: 20px;
    transition: all 0.3s ease;
}

.djob-card {
    background: #FFFFFF;
    border-radius: 12px;
    box-shadow: 0 1px 6px rgba(0,0,0,0.08);
    border: 1px solid #E5E7EB;
    padding: 16px 18px;
    margin-bottom: 47px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.djob-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 168, 143, 0.05), transparent);
    transition: left 0.5s;
}

.djob-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.djob-card:hover::before {
    left: 100%;
}

.djob-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.djob-logo {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    object-fit: cover;
}

.djob-headcol { 
    flex: 1; 
    min-width: 0; 
}

.djob-title-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-top: 6px;
}

.djob-title {
    font-weight: 700;
    font-size: 18px;
    color: #111827;
}

.djob-subinfo { 
    font-size: 16px; 
    color: #6b7280; 
}

.djob-subinfo a { 
    color: #2F80ED; 
    text-decoration: none; 
}

.djob-apply {
    color: #00A49C;
    font-weight: 600;
    font-size: 18px;
    text-decoration: none;
    white-space: nowrap;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.djob-apply::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 164, 156, 0.1), transparent);
    transition: left 0.3s;
}

.djob-apply:hover {
    color: #008B7A;
    transform: translateY(-2px);
}

.djob-apply:hover::before {
    left: 100%;
}

.djob-actions { 
    display: inline-flex; 
    align-items: center; 
    gap: 10px; 
}

.djob-more {
    width: 35px;
    height: 35px;
    border-radius: 9999px;
    background: #EEF2F7;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #E5E7EB;
    color: #111827;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.djob-more::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(0, 164, 156, 0.1);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

.djob-more:hover {
    background: #00A49C;
    color: white;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 164, 156, 0.3);
}

.djob-more:hover::before {
    width: 100%;
    height: 100%;
}

.djob-meta {
    display: flex;
    gap: 14px;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 6px;
}

.djob-meta-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 16px;
    color: #6b7280;
}

.djob-meta-item--green { 
    color: #00A49C; 
}

.djob-section-title {
    margin-top: 12px;
    font-weight: 700;
    font-size: 20px;
    color: #111827;
}

.djob-desc {
    margin-top: 4px;
    font-size: 16px;
    color: #4b5563;
    line-height: 1.5;
}

.djob-desc strong { 
    color: #111827; 
}

.djob-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.dtag {
    background: #F3F4F6;
    color: #374151;
    border-radius: 20px;
    padding: 5px 12px;
    font-size: 16px;
    font-weight: 500;
    border: 1px solid #E5E7EB;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.dtag::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 164, 156, 0.1), transparent);
    transition: left 0.3s;
}

.dtag:hover {
    background: #00A49C;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 164, 156, 0.3);
}

.dtag:hover::before {
    left: 100%;
}
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <a href="{{ route('landing-page') }}" class="sidebar-logo">
            <img src="{{ asset('image/logo.png') }}" alt="CloseCall Logo" class="logo-img">
        </a>
        <a href="{{ route('profile') }}" class="sidebar-icon active" data-page="home">
            <img src="{{ asset('image/home.png') }}" alt="Home" class="sidebar-icon-img">
        </a>
        <a href="{{ route('jobs') }}" class="sidebar-icon" data-page="jobs">
            <img src="{{ asset('image/jobs.png') }}" alt="Jobs" class="sidebar-icon-img">
        </a>
        <a href="{{ route('events') }}" class="sidebar-icon" data-page="events">
            <img src="{{ asset('image/events.png') }}" alt="Events" class="sidebar-icon-img">
        </a>
        <a href="{{ route('chats') }}" class="sidebar-icon" data-page="chats">
            <img src="{{ asset('image/chats.png') }}" alt="Chats" class="sidebar-icon-img">
        </a>
        <a href="{{ route('AI') }}" class="sidebar-icon" data-page="AI">
            <img src="{{ asset('image/genius.png') }}" alt="AI" class="sidebar-icon-img">
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header animate-slideInFromTop">
            <div class="search-bar animate-fadeInUp">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <input type="text" placeholder="Search...">
            </div>
            <a href="#" class="notification-icon animate-fadeInRight">
                <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                    <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
                </svg>
            </a>
            <a href="{{ route('profile') }}" class="avatar-icon">
                @if(isset($profile) && $profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile" 
                         style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;"
                         onerror="console.error('Failed to load profile image:', this.src); this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24" style="display: none;">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                @else
                    <svg width="18" height="18" fill="#6b7280" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                @endif
            </a>
        </div>
             <!-- Content -->
        <div class="content-wrapper">
            <!-- Job Header with Background -->
            <div class="job-header animate-fadeInUp"></div>
            
            <!-- Job Company Info -->
            <div class="job-company-info animate-scaleIn">
                <div class="company-header">
                    <div class="company-left">
                        <img src="{{ asset('image/socialmediamanager.png') }}" alt="Best Partner Education" class="company-logo animate-float">
                        <div class="company-details animate-fadeInLeft">
                            <h3 style="font-size: 24px">Best Partner Education</h3>
                            <div class="company-location">Education, International Studies<br>Indonesia</div>
                        </div>
                    </div>
                    <div class="header-buttons animate-fadeInRight">
                        <button class="options-btn" id="optionsBtn">⋮</button>
                        <div class="options-dropdown" id="optionsDropdown">
                            <div class="dropdown-item" data-action="save">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z"/>
                                </svg>
                                Save Company
                            </div>
                            <div class="dropdown-item" data-action="share">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92s2.92-1.31 2.92-2.92-1.31-2.92-2.92-2.92z"/>
                                </svg>
                                Share
                            </div>
                            <div class="dropdown-item" data-action="copy">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                                </svg>
                                Copy Link
                            </div>
                            <div class="dropdown-item danger" data-action="report">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                                </svg>
                                Report Company
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Horizontal Line -->
                <hr class="nav-divider">
                
                <!-- Navigation Tabs -->
                <div class="nav-tabs animate-fadeInUp">
                    <button class="nav-tab active">About</button>
                    <button class="nav-tab">Active Jobs</button>
                </div>
            </div>
            
            <!-- Content Sections - Separate from company info -->
            <div class="content-sections animate-fadeInUp">
                <!-- About Section -->
                <div class="content-section animate-fadeInLeft">
                    <h4 class="section-title">About</h4>
                    <div class="section-content">
                        <p>Best Partner is the world's first and only end-to-end AI recruiting platform. We reduce time to hire from months to days, instantly matching pre-vetted candidates and conducting first-round phone screens.</p>
                        <p>Trusted by hundreds of Fortune 1000 enterprises including Nestlé, Porsche, Atlassian, Goldman Sachs, and Nike. Best Partner AIR is making talent acquisition professionals 100x more effective and saving companies hundreds of thousands of dollars in recruiting costs.</p>
                    </div>
                </div>
                
                <!-- Industry Section -->
                <div class="content-section animate-fadeInRight">
                    <h4 class="section-title">Industry</h4>
                    <div class="section-content">
                        <p>Education</p>
                    </div>
                </div>
                
                <!-- Company Size Section -->
                <div class="content-section animate-fadeInLeft">
                    <h4 class="section-title">Company Size</h4>
                    <div class="section-content">
                        <ul>
                            <li>50-100 employees</li>
                            <li>349 associated members on CloseCall</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Headquarters Section -->
                <div class="content-section">
                    <h4 class="section-title">Headquarters</h4>
                    <div class="section-content">
                        <div class="location-content">
                            <div class="map-container">
                                <img src="{{ asset('image/pontianak.jpg') }}" alt="Map of Pontianak, Kalimantan Barat" class="map-image">
                            </div>
                            <div class="location-details">
                                <p class="location-address">Jl. Prof. DR. Hamka No.29 – 30, Sungai Jawi, Kec. Pontianak Kota, Kota Pontianak, Kalimantan Barat 78115</p>
                                <a href="https://www.google.com/maps/place/Jl.+Prof.+DR.+Hamka+No.29,+Sungai+Jawi,+Kec.+Pontianak+Kota,+Kota+Pontianak,+Kalimantan+Barat+78115/@-0.0237033,109.3205903,17z/data=!3m1!4b1!4m6!3m5!1s0x2e1d58f1183a4941:0xbadf541c7933f3d0!8m2!3d-0.0237033!4d109.3231706!16s%2Fg%2F11vqmy4hl8?entry=ttu&g_ep=EgoyMDI1MTAwOC4wIKXMDSoASAFQAw%3D%3D" class="get-directions">
                                    Get directions
                                    <img src="{{ asset('image/getdirection.png') }}" alt="External link icon" style="margin-left: 10px">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
               <!-- Detailed Jobs (matches provided mock) -->
                <div class="detailed-jobs-section animate-fadeInUp" style="display: none">
                    <!-- Card 1 -->
                    <div class="djob-card animate-scaleIn">
                        <div class="djob-header">
                            <img style="width: 65px; height:65px" src="{{ asset('image/socialmediamanager.png') }}" class="djob-logo" alt="Logo">
                            <div class="djob-headcol">
                                <div class="djob-title-row">
                                    <div class="djob-title">Social Media Manager</div>
                                    <div class="djob-actions">
                                        <a href="{{ route('bestpartnerjob') }}" class="djob-apply">+ Apply</a>
                                        <a href="#" class="djob-more" aria-label="More options">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#111827"><circle cx="12" cy="9" r="2"/><circle cx="12" cy="15" r="2"/></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="djob-subinfo">Indonesia | Best Partner Education</div>
                                <div class="djob-meta">
                                    <span class="djob-meta-item djob-meta-item--green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                        Actively reviewing applications
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="djob-section-title">Job Description</div>
                        <div class="djob-desc">
                            <strong>Vector Illustrator (Badge Art Concept – Gamification Project)</strong><br>
                            We are seeking a vector illustrator to help us in the exploration of a visual direction for badge art within a larger gamification platform. This is a short-term opportunity to showcase your illustration style through concept work.
                        </div>
                        <div class="djob-desc">
                            <strong>Project Overview</strong><br>
                            You will be exploring badge art concepts that align with our platform’s tone and user experience. This is a short exploratory engagement to review your approach and see how it could evolve across a full slate of achievements. If your work aligns with our vision, there is potential for a longer-term engagement to illustrate the full badge set and other visual assets across the platform.
                        </div>
                        <div class="djob-tags">
                            <span class="dtag">#remote</span>
                            <span class="dtag">#design</span>
                            <span class="dtag">#socialmedia</span>
                            <span class="dtag">#activelyreviewing</span>
                        </div>
                    </div>   
                </div>
            </div>
            
            <!-- Active Jobs Section -->
            <div class="active-jobs-section animate-fadeInUp" style="display: none">
                <h3 class="active-jobs-title">Active Jobs (1)</h3>
                
                <!-- Detailed Jobs (matches provided mock) -->
                <div class="detailed-jobs-section">
                    <!-- Card 1 -->
                    <div class="djob-card">
                        <div class="djob-header">
                            <img style="width: 65px; height:65px" src="{{ asset('image/socialmediamanager.png') }}" class="djob-logo" alt="Logo">
                            <div class="djob-headcol">
                                <div class="djob-title-row">
                                    <div class="djob-title">Social Media Manager</div>
                                    <div class="djob-actions">
                                        <a href="{{ route('bestpartnerjob') }}" class="djob-apply">+ Apply</a>
                                        <a href="#" class="djob-more" aria-label="More options">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#111827"><circle cx="12" cy="9" r="2"/><circle cx="12" cy="15" r="2"/></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="djob-subinfo">Indonesia | Best Partner Education</div>
                                <div class="djob-meta">
                                    <span class="djob-meta-item djob-meta-item--green">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                        Actively reviewing applications
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="djob-section-title">Job Description</div>
                        <div class="djob-desc">
                            <strong>Vector Illustrator (Badge Art Concept – Gamification Project)</strong><br>
                            We are seeking a vector illustrator to help us in the exploration of a visual direction for badge art within a larger gamification platform. This is a short-term opportunity to showcase your illustration style through concept work.
                        </div>
                        <div class="djob-desc">
                            <strong>Project Overview</strong><br>
                            You will be exploring badge art concepts that align with our platform's tone and user experience. This is a short exploratory engagement to review your approach and see how it could evolve across a full slate of achievements. If your work aligns with our vision, there is potential for a longer-term engagement to illustrate the full badge set and other visual assets across the platform.
                        </div>
                        <div class="djob-tags">
                            <span class="dtag">#remote</span>
                            <span class="dtag">#design</span>
                            <span class="dtag">#socialmedia</span>
                            <span class="dtag">#activelyreviewing</span>
                        </div>
                    </div>   
                </div>
            </div>
            
<script>
    // Tab redirect functionality - redirect to bestpartnerjob page
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.nav-tab');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Redirect to bestpartnerjob page
                window.location.href = '{{ route("bestpartnerjob") }}';
            });
        });

        // Handle Options button dropdown
        const optionsBtn = document.getElementById('optionsBtn');
        const optionsDropdown = document.getElementById('optionsDropdown');
        
        if (optionsBtn && optionsDropdown) {
            optionsBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                optionsDropdown.classList.toggle('show');
            });
            
            // Handle dropdown item clicks
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const action = this.getAttribute('data-action');
                    
                    switch(action) {
                        case 'save':
                            alert('Company saved successfully!');
                            break;
                        case 'share':
                            if (navigator.share) {
                                navigator.share({
                                    title: 'Best Partner Education - About Us',
                                    text: 'Learn more about Best Partner Education',
                                    url: window.location.href
                                });
                            } else {
                                alert('Share functionality not supported on this browser');
                            }
                            break;
                        case 'copy':
                            navigator.clipboard.writeText(window.location.href).then(() => {
                                alert('Link copied to clipboard!');
                            });
                            break;
                        case 'report':
                            alert('Report submitted. Thank you for your feedback.');
                            break;
                    }
                    
                    optionsDropdown.classList.remove('show');
                });
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                optionsDropdown.classList.remove('show');
            });
        }

        // Smooth staggered animation system
        function animateElementsStaggered() {
            const elements = document.querySelectorAll('.animate-fadeInUp, .animate-fadeInLeft, .animate-fadeInRight, .animate-scaleIn');
            
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'none';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100); // Stagger by 100ms each
            });
        }

        // Initialize smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit for page to settle, then animate
            setTimeout(animateElementsStaggered, 100);
        });

        // Add parallax effect to job header
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const jobHeader = document.querySelector('.job-header');
            if (jobHeader) {
                jobHeader.style.transform = `translateY(${scrolled * 0.3}px)`;
            }
        });

        // Add typing effect to company name
        function typeWriter(element, text, speed = 100) {
            let i = 0;
            element.innerHTML = '';
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize typing effect after page load
        setTimeout(() => {
            const companyName = document.querySelector('.company-details h3');
            if (companyName) {
                const originalText = companyName.textContent;
                typeWriter(companyName, originalText, 80);
            }
        }, 1500);

        // Add ripple effect to buttons
        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');

            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);
        }

        // Add ripple effect to all interactive elements
        document.querySelectorAll('.nav-tab, .djob-apply, .djob-more, .dtag, .get-directions').forEach(element => {
            element.addEventListener('click', createRipple);
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(0, 168, 143, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Add smooth scroll for page load
        window.addEventListener('load', function() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });

        // Add hover effects to map container
        const mapContainer = document.querySelector('.map-container');
        if (mapContainer) {
            mapContainer.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            mapContainer.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        }

        // Add pulse animation to company logo on hover
        const companyLogo = document.querySelector('.company-logo');
        if (companyLogo) {
            companyLogo.addEventListener('mouseenter', function() {
                this.style.animation = 'pulse 1s infinite';
            });
            
            companyLogo.addEventListener('mouseleave', function() {
                this.style.animation = 'float 3s ease-in-out infinite';
            });
        }

        // Function to reset and animate elements immediately
        function animateElementImmediate(element, delay = 0) {
            if (!element) return;
            
            setTimeout(() => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'none';
                
                setTimeout(() => {
                    element.style.transition = 'all 0.5s ease-out';
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 10);
            }, delay);
        }

        // Function to hide elements immediately
        function hideElementImmediate(element) {
            if (!element) return;
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'all 0.3s ease-out';
        }
    });
</script>

</body>
</html>
