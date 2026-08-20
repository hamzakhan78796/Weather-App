<!DOCTYPE html>
<html lang="en">
<head>
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>Modern Weather App - Live Weather Forecast & Updates</title>
    <meta name="description" content="Check real-time weather conditions, hourly forecasts, and 5-day weather updates for any city with a sleek glassmorphic weather application built in Laravel.">
    <meta name="keywords" content="weather app, laravel weather app, live weather forecast, hourly weather, temperature converter, current weather">
    <meta name="author" content="Hamza Aslam">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Modern Weather App - Live Weather Forecast">
    <meta property="og:description" content="Check real-time weather conditions, hourly forecasts, and 5-day weather updates with dynamic backgrounds.">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23fbc531%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><circle cx=%2212%22 cy=%2212%22 r=%224%22/><path d=%22M12 2v2%22/><path d=%22M12 20v2%22/><path d=%22m4.93 4.93 1.41 1.41%22/><path d=%22m17.66 17.66 1.41 1.41%22/><path d=%22M2 12h2%22/><path d=%22M20 12h2%22/><path d=%22m6.34 17.66-1.41 1.41%22/><path d=%22m19.07 4.93-1.41 1.41%22/></svg>">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Styles -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.8s ease;
            padding: 20px;
            background-attachment: fixed;
        }
        .bg-default { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); }
        .bg-clear { background: linear-gradient(135deg, #2980B9 0%, #6DD5FA 100%, #FFFFFF 100%); }
        .bg-clouds { background: linear-gradient(135deg, #757F9A 0%, #D7DDE8 100%); }
        .bg-rain { background: linear-gradient(135deg, #373B44 0%, #4286f4 100%); }
        .bg-thunderstorm { background: linear-gradient(135deg, #141E30 0%, #243B55 100%); }
        .bg-snow { background: linear-gradient(135deg, #E0EAFC 0%, #CFDEF3 100%); }
        .weather-container {
            width: 100%;
            max-width: 520px;
            padding: 35px 25px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            text-align: center;
            color: white;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease-out forwards;
            position: relative;
            z-index: 2;
        }
        .btn-common {
            position: absolute;
            top: 20px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-common:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }
        .theme-toggle {
            left: 20px;
            width: 35px;
            border-radius: 50%;
        }
        .unit-toggle {
            right: 20px;
            border-radius: 20px;
            padding: 0 12px;
            font-size: 11px;
            font-weight: 600;
        }
        h1 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .search-box {
            position: relative;
        }
        .search-box::before {
            content: "";
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' stroke='rgba(255,255,255,0.7)' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' viewBox='0 0 24 24'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            pointer-events: none;
            z-index: 2;
        }
        .search-box form {
            position: relative;
            display: flex;
            width: 100%;
            margin-bottom: 12px;
        }
        .search-box input {
            width: 100%;
            padding: 14px 18px 14px 45px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }
        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .search-box input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        }
        .search-box button {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            padding: 0 20px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            background: white;
            color: #2a5298;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s ease;
        }
        .search-box button:hover {
            background: #f0f0f0;
            transform: scale(0.98);
        }
        .history-section {
            margin-bottom: 15px;
        }
        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 6px;
            padding: 0 5px;
        }
        .clear-history {
            background: none;
            border: none;
            color: #ffcccc;
            cursor: pointer;
            font-size: 11px;
            text-decoration: underline;
            transition: color 0.2s;
        }
        .clear-history:hover {
            color: #ff5252;
        }
        .recent-searches {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: center;
        }
        .recent-tag {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            color: white;
            gap: 5px;
            transition: all 0.2s ease;
        }
        .recent-tag span.city-name {
            cursor: pointer;
        }
        .recent-tag span.city-name:hover {
            text-decoration: underline;
        }
        .remove-tag {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #ffcccc;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .remove-tag:hover {
            background: #ff5252;
            color: white;
        }
        .weather-icon-badge {
            margin: 10px auto 5px auto;
            width: 55px;
            height: 55px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floatIcon 3s ease-in-out infinite, pulseGlow 4s ease-in-out infinite;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 10px 20px rgba(0,0,0,0.1), 0 0 15px rgba(255,255,255,0.1); }
            50% { box-shadow: 0 15px 30px rgba(0,0,0,0.2), 0 0 25px rgba(255,255,255,0.3); }
        }
        h2 {
            font-size: 26px;
            font-weight: 600;
            margin-top: 4px;
        }
        .current-date {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2px;
            font-weight: 300;
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 15px;
        }
        .detail-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 8px 4px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
            transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }
        .detail-card span:nth-child(2) {
            font-size: 10px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.8);
        }
        .detail-card strong {
            font-size: 12px;
            font-weight: 500;
        }
        .forecast-container {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: left;
        }
        .forecast-title {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
        }
        .forecast-scroll {
            display: flex;
            gap: 8px;
            overflow-x: scroll;
            padding-bottom: 8px;
            scroll-behavior: smooth;
        }
        .forecast-scroll::-webkit-scrollbar {
            height: 8px;
        }
        .forecast-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .forecast-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
        }
        .forecast-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 8px 6px;
            min-width: 70px;
            text-align: center;
            flex-shrink: 0;
            font-size: 10px;
            transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }
        .forecast-card span {
            display: block;
        }
        .daily-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .daily-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 11px;
            transition: transform 0.3s ease, background 0.3s ease, box-shadow 0.3s ease;
        }
        .detail-card:hover, .forecast-card:hover, .daily-row:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .empty-state {
            padding: 15px 0;
        }
        .empty-state p {
            color: rgba(255, 255, 255, 0.8);
            margin-top: 8px;
            font-size: 13px;
        }
        @media (max-width: 480px) {
            body {
                padding: 10px;
                align-items: flex-start;
            }
            .weather-container {
                padding: 20px 15px;
            }
            .details-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .detail-card:nth-child(5) {
                grid-column: span 2;
            }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes popIn {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }
        .spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(42, 82, 152, 0.3);
            border-radius: 50%;
            border-top-color: #2a5298;
            animation: spin 1s ease-in-out infinite;
            margin-right: 4px;
            vertical-align: text-bottom;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .error-alert {
            background: rgba(255, 82, 82, 0.15);
            border: 1px solid rgba(255, 82, 82, 0.4);
            color: #ffcccc;
            padding: 10px 15px;
            border-radius: 50px;
            font-size: 13px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            animation: popIn 0.4s ease-out forwards;
            backdrop-filter: blur(5px);
        }
        body.dark-mode { background: #121212 !important; }
        body.dark-mode .weather-container { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: #fff; }
        body.dark-mode .detail-card, 
        body.dark-mode .forecast-card, 
        body.dark-mode .daily-row { background: rgba(255, 255, 255, 0.05); }
        .weather-icon-small { width: 24px; height: 24px; margin-bottom: 4px; }
        .forecast-card span:nth-child(2) { margin: 5px 0; }
        .weather-container::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(45deg, rgba(255,255,255,0.4), transparent, rgba(255,255,255,0.1));
            border-radius: 30px;
            z-index: -1;
            pointer-events: none;
            opacity: 0.5;
        }
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background-image: 
                radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px),
                radial-gradient(circle, rgba(255,255,255,0.2) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            animation: moveParticles 20s linear infinite;
            z-index: 1;
            pointer-events: none;
        }
        @keyframes moveParticles {
            0% { transform: translateY(0) translateX(0); }
            100% { transform: translateY(-50px) translateX(-50px); }
        }
    </style>
</head>

@php
    $bgClass = 'bg-default';
    $mainWeather = '';

    if(isset($weather) && !session('error')) {
        $mainWeather = strtolower($weather['weather'][0]['main']);
        
        if($mainWeather == 'clear') {
            $bgClass = 'bg-clear';
        } elseif($mainWeather == 'clouds') {
            $bgClass = 'bg-clouds';
        } elseif($mainWeather == 'rain' || $mainWeather == 'drizzle') {
            $bgClass = 'bg-rain';
        } elseif($mainWeather == 'thunderstorm') {
            $bgClass = 'bg-thunderstorm';
        } elseif($mainWeather == 'snow') {
            $bgClass = 'bg-snow';
        }
    }
@endphp

<body class="{{ $bgClass }}">
    <div class="weather-container">
        <button class="theme-toggle btn-common" onclick="toggleTheme()">
            <svg id="themeIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </button>

        @if(isset($weather) && !session('error'))
            <button id="unitToggleBtn" class="unit-toggle btn-common" onclick="toggleUnit()">°C / °F</button>
        @endif

        <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>
            </svg>
            Weather App
        </h1>
        
        @if(session('error'))
            <div class="error-alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff5252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="search-box">
            <form id="searchForm" action="{{ route('weather.search') }}" method="GET">
                @csrf
                <input
                    type="text"
                    name="city"
                    id="cityInput"
                    placeholder="Enter city name..."
                    value="{{ old('city', request('city')) }}"
                    required
                >
                <button id="searchBtn" type="submit">Search</button>
            </form>
        </div>

        <div id="historySection" class="history-section" style="display: none;">
            <div class="history-header">
                <span>Recent Searches:</span>
                <button type="button" class="clear-history" onclick="clearAllHistory()">Clear All</button>
            </div>
            <div id="recentSearches" class="recent-searches"></div>
        </div>

        @if(isset($weather) && !session('error'))
            <input type="hidden" id="currentSearchedCity" value="{{ $weather['name'] }}">

            <div class="weather-icon-badge">
                @if($mainWeather == 'clear')
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#fbc531" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                @elseif($mainWeather == 'rain' || $mainWeather == 'drizzle')
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M16 14v6"/><path d="M8 14v6"/><path d="M12 16v6"/></svg>
                @elseif($mainWeather == 'thunderstorm')
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#fffa65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 9"/><polyline points="13 11 9 17 15 17 11 23"/></svg>
                @elseif($mainWeather == 'snow')
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#c8d6e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 17.58A5 5 0 0 0 18 8h-1.26A8 8 0 1 0 4 16.25"/><path d="M8 16h.01"/><path d="M12 20h.01"/><path d="M16 16h.01"/></svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                @endif
            </div>

            <h2>{{ $weather['name'] }}</h2>
            <div class="current-date">{{ \Carbon\Carbon::now()->format('l, M j, Y') }}</div>
            
            <div class="weather-main-section" style="margin: 15px 0;">
                <div class="temperature" 
                     id="tempValue" 
                     data-temp-c="{{ $weather['main']['temp'] }}"
                     style="font-size: 64px; font-weight: 700; line-height: 1; margin-bottom: 8px;">
                    {{ round($weather['main']['temp']) }}°C
                </div>

                <div class="condition" style="font-size: 16px; font-weight: 500; text-transform: capitalize; margin-bottom: 8px;">
                    {{ $weather['weather'][0]['description'] }}
                </div>

                @if(isset($todayMax) && isset($todayMin))
                    <div class="high-low" style="font-size: 13px; font-weight: 400; opacity: 0.9; display: flex; justify-content: center; gap: 15px;">
                        <span><strong style="font-weight: 600;">High:</strong> {{ $todayMax }}°C</span>
                        <span><strong style="font-weight: 600;">Low:</strong> {{ $todayMin }}°C</span>
                    </div>
                @endif
            </div>

            <div class="details-grid">
                <div class="detail-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #64b5f6;">
                        <path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>
                    </svg>
                    <span>Humidity</span>
                    <strong>{{ $weather['main']['humidity'] }}%</strong>
                </div>

                <div class="detail-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #81c784;">
                        <path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/>
                    </svg>
                    <span>Wind</span>
                    <strong>{{ round($weather['wind']['speed'] * 3.6, 1) }} km/h</strong>
                </div>

                <div class="detail-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #ffb74d;">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                    <span>Pressure</span>
                    <strong>{{ $weather['main']['pressure'] }} hPa</strong>
                </div>

                <div class="detail-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #4db6ac;">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    <span>Visibility</span>
                    <strong>{{ $weather['visibility'] / 1000 }} km</strong>
                </div>

                <div class="detail-card" style="grid-column: span 2;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #e57373;">
                        <path d="M14 14.76V3.5a2.5 2.5 0 0 0-5 0v11.26a4.5 4.5 0 1 0 5 0z"/>
                    </svg>
                    <span>Feels Like</span>
                    <strong id="feelsLikeValue" data-feels-c="{{ $weather['main']['feels_like'] }}">
                        {{ round($weather['main']['feels_like']) }}°C
                    </strong>
                </div>
            </div>

            @if(isset($forecast) && isset($forecast['list']))
                <div class="forecast-container">
                    <div class="forecast-title">Hourly Forecast</div>
                    <div class="forecast-scroll">
                        @foreach(array_slice($forecast['list'], 0, 6) as $item)
                            @php
                                $cond = strtolower($item['weather'][0]['main']);
                            @endphp
                            <div class="forecast-card">
                                <span>{{ \Carbon\Carbon::parse($item['dt_txt'])->format('g A') }}</span>
                                <div style="margin: 4px auto;">
                                    @if($cond == 'clear')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fbc531" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                                    @elseif($cond == 'clouds' || $cond == 'few clouds' || $cond == 'scattered clouds')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dff9fb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                                    @elseif($cond == 'rain' || $cond == 'drizzle')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M16 14v2"/><path d="M12 16v2"/><path d="M8 14v2"/></svg>
                                    @elseif($cond == 'thunderstorm')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fffa65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 9"/><polyline points="13 11 9 17 15 17 11 23"/></svg>
                                    @elseif($cond == 'snow')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c8d6e5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 17.58A5 5 0 0 0 18 8h-1.26A8 8 0 1 0 4 16.25"/><path d="M8 16h.01"/><path d="M12 20h.01"/><path d="M16 16h.01"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"><path d="M17.5 19H9a7 7 0 1 1 6.71-9"/></svg>
                                    @endif
                                </div>
                                <span style="font-weight: 600; margin: 2px 0;">{{ round($item['main']['temp']) }}°C</span>
                                <span style="font-size: 9px; opacity: 0.8; text-transform: capitalize;">{{ $item['weather'][0]['main'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(isset($dailyForecast) && count($dailyForecast) > 0)
                <div class="forecast-container">
                    <div class="forecast-title">5-Day Forecast</div>
                    <div class="daily-list">
                        @foreach($dailyForecast as $day)
                            @php
                                $dCond = strtolower($day['description']);
                            @endphp
                            <div class="daily-row">
                                <span style="font-weight: 500; width: 90px; text-align: left;">{{ $day['date'] }}</span>
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span>
                                        @if(str_contains($dCond, 'clear'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fbc531" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                                        @elseif(str_contains($dCond, 'cloud'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#dff9fb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                                        @elseif(str_contains($dCond, 'rain') || str_contains($dCond, 'drizzle'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M16 14v2"/><path d="M12 16v2"/><path d="M8 14v2"/></svg>
                                        @elseif(str_contains($dCond, 'thunder'))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fffa65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 16.9A5 5 0 0 0 18 7h-1.26a8 8 0 1 0-11.62 9"/><polyline points="13 11 9 17 15 17 11 23"/></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/></svg>
                                        @endif
                                    </span>
                                    <span style="text-transform: capitalize; opacity: 0.9;">{{ $day['description'] }}</span>
                                </div>
                                <span style="font-weight: 600;">{{ $day['temp'] }}°C</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @elseif(!session('error'))
            <div class="empty-state">
                <h2>Welcome!</h2>
                <p>Enter a city name above to check the current weather.</p>
            </div>
        @endif
    </div>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const cityField = document.getElementById('currentSearchedCity');
        if (cityField) {
            let cityName = cityField.value.trim();
            if (cityName) {
                let searches = JSON.parse(localStorage.getItem('weatherSearches')) || [];
                searches = searches.filter(c => c.toLowerCase() !== cityName.toLowerCase());
                searches.unshift(cityName);
                if (searches.length > 5) searches.pop();
                localStorage.setItem('weatherSearches', JSON.stringify(searches));
            }
        }
        renderRecentSearches();
    });

    function renderRecentSearches() {
        const section = document.getElementById('historySection');
        const container = document.getElementById('recentSearches');
        let searches = JSON.parse(localStorage.getItem('weatherSearches')) || [];
        
        if (searches.length === 0) {
            section.style.display = 'none';
            return;
        }

        section.style.display = 'block';
        container.innerHTML = '';
        
        searches.forEach(city => {
            const tag = document.createElement('div');
            tag.className = 'recent-tag';
            
            const nameSpan = document.createElement('span');
            nameSpan.className = 'city-name';
            nameSpan.innerText = city;
            nameSpan.onclick = function() {
                document.getElementById('cityInput').value = city;
                document.getElementById('searchForm').submit();
            };
            
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'remove-tag';
            removeBtn.innerHTML = '✕';
            removeBtn.onclick = function(e) {
                e.stopPropagation();
                removeSingleSearch(city);
            };

            tag.appendChild(nameSpan);
            tag.appendChild(removeBtn);
            container.appendChild(tag);
        });
    }

    function removeSingleSearch(cityName) {
        let searches = JSON.parse(localStorage.getItem('weatherSearches')) || [];
        searches = searches.filter(c => c.toLowerCase() !== cityName.toLowerCase());
        localStorage.setItem('weatherSearches', JSON.stringify(searches));
        renderRecentSearches();
    }

    function clearAllHistory() {
        localStorage.removeItem('weatherSearches');
        renderRecentSearches();
    }

    let isCelsius = true;
    function toggleUnit() {
        const tempElement = document.getElementById('tempValue');
        const feelsElement = document.getElementById('feelsLikeValue');
        const btn = document.getElementById('unitToggleBtn');

        if (!tempElement) return;

        let tempC = parseFloat(tempElement.getAttribute('data-temp-c'));
        let feelsC = parseFloat(feelsElement.getAttribute('data-feels-c'));

        if (isCelsius) {
            let tempF = (tempC * 9/5) + 32;
            let feelsF = (feelsC * 9/5) + 32;

            tempElement.innerText = Math.round(tempF) + '°F';
            feelsElement.innerText = Math.round(feelsF) + '°F';
            btn.innerText = 'Switch to °C';
            isCelsius = false;
        } else {
            tempElement.innerText = Math.round(tempC) + '°C';
            feelsElement.innerText = Math.round(feelsC) + '°C';
            btn.innerText = 'Switch to °F';
            isCelsius = true;
        }
    }

    document.getElementById('searchForm').addEventListener('submit', function() {
        const btn = document.getElementById('searchBtn');
        btn.disabled = true;
        btn.style.cursor = 'not-allowed';
        btn.style.opacity = '0.9';
        btn.innerHTML = '<span class="spinner"></span> Searching...';
    });

    function toggleTheme() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDark);
        
        document.getElementById('themeIcon').innerHTML = isDark 
            ? '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>' 
            : '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>';
    }

    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
        document.getElementById('themeIcon').innerHTML = '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>';
    }
    </script>
</body>
</html>