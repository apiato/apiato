<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Apiato</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        raleway: ['Raleway', 'sans-serif'],
                    },
                    colors: {
                        'apiato-blue': '#4457C2',
                        'apiato-dark': '#0f0f23',
                        'apiato-darker': '#1a1a2e',
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideIn: {
                            '0%': { opacity: '0', transform: 'translateX(20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                    },
                },
            },
        };
    </script>

    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" />

    <!-- Custom Styles -->
    <style>
        html {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            scroll-behavior: smooth;
        }
        body {
            font-feature-settings: 'kern' 1, 'liga' 1;
        }

        /* Mobile optimizations */
        @media (max-width: 640px) {
            body {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-tap-highlight-color: transparent;
            }

            /* Allow text selection in content areas */
            p, h1, h2, h3, h4, h5, h6, span, div {
                -webkit-user-select: text;
                -khtml-user-select: text;
                -moz-user-select: text;
                -ms-user-select: text;
                user-select: text;
            }
        }

        /* Safe area support for devices with notches */
        @supports (padding: max(0px)) {
            .safe-area-top {
                padding-top: max(1rem, env(safe-area-inset-top));
            }

            .safe-area-bottom {
                padding-bottom: max(1rem, env(safe-area-inset-bottom));
            }
        }

        /* Hamburger menu animations */
        .hamburger-line {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .hamburger-line:nth-child(1) {
            top: 0;
        }

        .hamburger-line:nth-child(2) {
            top: 50%;
            transform: translateY(-50%);
        }

        /* Adjust for smaller mobile icons */
        @media (max-width: 640px) {
            .hamburger-icon .hamburger-line:nth-child(2) {
                top: 6px;
            }
        }

        .hamburger-line:nth-child(3) {
            bottom: 0;
        }

        /* Mobile menu slide-in animation */
        .animate-slide-in {
            animation: slideIn 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes slideIn {
            0% {
                transform: translateX(-20px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .code-keyword { color: #ff79c6; }
        .code-string { color: #50fa7b; }
        .code-comment { color: #6272a4; }
        .code-function { color: #8be9fd; }
        .code-variable { color: #f8f8f2; }
        .dark .code-keyword { color: #d73a49; }
        .dark .code-string { color: #50fa7b; }
        .dark .code-comment { color: #6a737d; }
        .dark .code-function { color: #005cc5; }
        .dark .code-variable { color: #24292e; }
    </style>
</head>
<body class="bg-apiato-dark text-white font-raleway transition-colors duration-300 dark:bg-gray-50 dark:text-gray-900 min-h-screen">
    <!-- Mobile Control Buttons -->
    <div class="fixed top-3 right-3 sm:top-4 sm:right-4 z-[1001] flex items-center gap-2 sm:gap-3">
        <!-- Theme Toggle Button -->
        <button id="theme-toggle" class="p-2 sm:p-3 bg-apiato-darker dark:bg-gray-200 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 touch-manipulation" aria-label="Toggle theme">
            <svg id="theme-icon" class="w-4 h-4 sm:w-5 sm:h-5 text-apiato-blue" fill="currentColor" viewBox="0 4 20 20">
                <path id="moon-icon" d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.6-2A1,1,0,0,0,8.81,2.17,10.32,10.32,0,0,0,2.71,6c-2.13,3.39-.44,7.84,3.75,9.87a9.57,9.57,0,0,0,10.2-.37A1,1,0,0,0,21.64,13Z"></path>
                <path id="sun-icon" class="hidden" fill-rule="evenodd" d="M12 7.5a4.5 4.5 0 1 0 0 9 4.5 4.5 0 0 0 0-9zM12 2v2m0 16v2m6.36-1.64l-1.42-1.42m-12.72 0L5.64 20.36M20.36 5.64l-1.42 1.42M5.64 5.64l1.42 1.42M16.5 12h2m-13 0h-2"></path>
            </svg>
        </button>

        <!-- Mobile Menu Toggle Button -->
        <button id="mobile-menu-toggle" class="md:hidden p-2 sm:p-3 bg-apiato-darker dark:bg-gray-200 rounded-full shadow-lg hover:scale-105 transition-transform duration-300 touch-manipulation min-h-[36px] min-w-[36px] sm:min-h-[44px] sm:min-w-[44px] flex items-center justify-center" aria-label="Toggle menu" aria-expanded="false">
            <div class="hamburger-icon w-4 h-4 sm:w-5 sm:h-5 relative">
                <span class="hamburger-line absolute left-0 top-0 w-full h-0.5 bg-white dark:bg-gray-900 transition-all duration-300 origin-center"></span>
                <span class="hamburger-line absolute left-0 top-1.5 sm:top-2 w-full h-0.5 bg-white dark:bg-gray-900 transition-all duration-300 origin-center"></span>
                <span class="hamburger-line absolute left-0 bottom-0 w-full h-0.5 bg-white dark:bg-gray-900 transition-all duration-300 origin-center"></span>
            </div>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full bg-apiato-dark/90 dark:bg-white/90 backdrop-blur-md z-50 py-3 sm:py-4 shadow-lg border-b border-white/10 dark:border-gray-200 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <a href="/" class="text-xl sm:text-2xl font-semibold text-apiato-blue tracking-wide">Apiato</a>
            <div class="hidden md:flex items-center gap-4 lg:gap-6">
                <a href="#demo" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">Demo</a>
                <a href="#features" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">Features</a>
                <a href="https://apiato.io/" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">Docs</a>
                <a href="https://github.com/apiato/apiato" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">GitHub</a>
                @if(Route::has('public_docs'))
                    <a href="{{ route('public_docs') }}" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">API Docs</a>
                @endif
                @guest
                    <a href="{{ route('login.form') }}" class="px-3 py-1.5 sm:px-4 sm:py-2 border-2 border-apiato-blue text-apiato-blue rounded-full text-xs sm:text-sm font-semibold uppercase tracking-wider hover:bg-apiato-blue hover:text-white transition-all duration-300">Login</a>
                @endguest
                @auth('web')
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    <button type="submit" form="logout-form" class="px-3 py-1.5 sm:px-4 sm:py-2 border-2 border-apiato-blue text-apiato-blue rounded-full text-xs sm:text-sm font-semibold uppercase tracking-wider hover:bg-apiato-blue hover:text-white transition-all duration-300">Logout</button>
                @endauth
            </div>
        </div>
        <div id="mobile-menu" class="md:hidden fixed top-16 left-4 right-4 bg-apiato-dark/95 dark:bg-white/95 backdrop-blur-md z-40 rounded-2xl shadow-2xl transform translate-y-[-20px] opacity-0 transition-all duration-300 ease-out max-h-[70vh] overflow-y-auto border border-white/10 dark:border-gray-200">
            <div class="p-6">
                <div class="flex flex-col gap-2">
                    <a href="#demo" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">Demo</a>
                    <a href="#features" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">Features</a>
                    <a href="https://apiato.io/" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">Docs</a>
                    <a href="https://github.com/apiato/apiato" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">GitHub</a>
                    @if(Route::has('public_docs'))
                        <a href="{{ route('public_docs') }}" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">API Docs</a>
                    @endif
                    <div class="h-px bg-white/10 dark:bg-gray-300 my-3"></div>
                    @guest
                        <a href="{{ route('login.form') }}" class="py-3 px-4 text-apiato-blue hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">Login</a>
                    @endguest
                    @auth('web')
                        <button type="submit" form="logout-form" class="py-3 px-4 text-apiato-blue hover:bg-apiato-blue/10 rounded-lg text-left transition-all duration-300 min-h-[44px] flex items-center w-full font-medium text-base" onclick="closeMobileMenu()">Logout</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-apiato-dark via-apiato-darker to-gray-900 dark:from-gray-50 dark:via-gray-100 dark:to-gray-200 pt-16 sm:pt-20">
        <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Ccircle cx=%2225%22 cy=%2225%22 r=%221%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3Ccircle cx=%2275%22 cy=%2275%22 r=%221%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3Ccircle cx=%2250%22 cy=%2210%22 r=%220.5%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3Ccircle cx=%2290%22 cy=%2240%22 r=%220.8%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3C/svg%3E')]"></div>
        <div class="text-center max-w-4xl px-4 sm:px-6 lg:px-8 z-10 animate-fade-in-up">
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-light text-apiato-blue mb-4 sm:mb-6 tracking-widest leading-tight">Apiato</h1>
            <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-gray-300 dark:text-gray-700 mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed px-2 break-words">A flawless framework for building scalable and testable API-Centric Apps with PHP and Laravel. Build powerful APIs with elegance and speed.</p>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center px-4">
                <a href="https://apiato.io/" class="px-6 py-3 sm:px-8 sm:py-4 bg-gradient-to-r from-apiato-blue to-blue-600 text-white font-semibold text-base sm:text-lg uppercase tracking-wider rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 min-h-[48px] flex items-center justify-center">Get Started</a>
                <a href="https://github.com/apiato/apiato" class="px-6 py-3 sm:px-8 sm:py-4 border-2 border-apiato-blue text-apiato-blue font-semibold text-base sm:text-lg uppercase tracking-wider rounded-full hover:bg-apiato-blue hover:text-white hover:-translate-y-1 transition-all duration-300 min-h-[48px] flex items-center justify-center">View on GitHub</a>
            </div>
        </div>
    </section>

    <!-- Code Demo Section -->
    <section id="demo" class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8 bg-apiato-darker dark:bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-center">
                <div class="animate-fade-in-up">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-apiato-blue mb-4 sm:mb-6 font-light">Build APIs with Elegance</h2>
                    <p class="text-sm sm:text-base md:text-lg text-gray-300 dark:text-gray-900 mb-6 sm:mb-8 leading-relaxed break-words">Apiato provides a structured architecture that makes API development intuitive and maintainable. Create endpoints, handle requests, and manage responses with clean, reusable code.</p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="https://apiato.io/docs/" class="px-4 py-2 sm:px-6 sm:py-3 bg-gradient-to-r from-apiato-blue to-blue-600 text-white font-semibold text-sm sm:text-base uppercase tracking-wider rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 whitespace-nowrap">Read Documentation</a>
                        <a href="https://github.com/apiato/apiato" class="px-4 py-2 sm:px-6 sm:py-3 border-2 border-apiato-blue text-apiato-blue font-semibold text-sm sm:text-base uppercase tracking-wider rounded-full hover:bg-apiato-blue hover:text-white hover:-translate-y-1 transition-all duration-300 whitespace-nowrap">View Source</a>
                    </div>
                </div>
                <div class="relative animate-fade-in-up">
                    <div class="bg-gray-900 dark:bg-gray-800 rounded-xl overflow-hidden shadow-2xl border border-gray-700 dark:border-gray-300 max-w-full">
                        <div class="bg-gray-800 dark:bg-gray-700 px-3 sm:px-4 py-2 sm:py-3 flex items-center gap-2">
                            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-red-500 rounded-full"></span>
                            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-yellow-500 rounded-full"></span>
                            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-green-500 rounded-full"></span>
                            <span class="ml-auto text-gray-400 text-xs">api.php</span>
                        </div>
                        <div class="p-3 sm:p-4 lg:p-6 font-mono text-xs sm:text-sm text-gray-300 leading-relaxed overflow-x-auto max-w-full">
                            <div class="mb-1 break-all"><span class="code-keyword">use</span> App\Containers\User\UI\API\Controllers\UserController;</div>
                            <div class="mb-1 break-all"><span class="code-keyword">use</span> Illuminate\Support\Facades\Route;</div>
                            <div class="mb-3"></div>
                            <div class="mb-1 break-all">Route::<span class="code-function">get</span>(<span class="code-string">'/users'</span>, [UserController::<span class="code-keyword">class</span>, <span class="code-string">'index'</span>]);</div>
                            <div class="mb-1 break-all">Route::<span class="code-function">post</span>(<span class="code-string">'/users'</span>, [UserController::<span class="code-keyword">class</span>, <span class="code-string">'store'</span>]);</div>
                            <div class="mb-1 break-all">Route::<span class="code-function">get</span>(<span class="code-string">'/users/{id}'</span>, [UserController::<span class="code-keyword">class</span>, <span class="code-string">'show'</span>]);</div>
                            <div class="mb-1 break-all">Route::<span class="code-function">put</span>(<span class="code-string">'/users/{id}'</span>, [UserController::<span class="code-keyword">class</span>, <span class="code-string">'update'</span>]);</div>
                            <div class="mb-1 break-all">Route::<span class="code-function">delete</span>(<span class="code-string">'/users/{id}'</span>, [UserController::<span class="code-keyword">class</span>, <span class="code-string">'destroy'</span>]);</div>
                            <div class="mb-3"></div>
                            <div class="code-comment break-all">// Apiato handles the rest - validation, transformation, testing</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-apiato-darker to-gray-800 dark:from-gray-100 dark:to-gray-50">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-white dark:text-gray-900 text-center mb-8 sm:mb-12 font-light">Why Choose Apiato?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                <div class="bg-white dark:bg-gray-50 p-4 sm:p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-200 animate-fade-in-up">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 mb-3 sm:mb-4 text-apiato-blue" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-800 dark:text-gray-900 mb-3 sm:mb-4 font-semibold">Rapid Development</h3>
                    <p class="text-gray-600 dark:text-gray-700 text-sm sm:text-base">Build APIs faster with our structured architecture and pre-built components. Focus on business logic, not boilerplate code.</p>
                </div>
                <div class="bg-white dark:bg-gray-50 p-4 sm:p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-200 animate-fade-in-up">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 mb-3 sm:mb-4 text-apiato-blue" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 3v18h18V3H3zm4 14H5v-2h2v2zm0-4H5v-2h2v2zm0-4H5V7h2v2zm6 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2zm6 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v2z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-800 dark:text-gray-900 mb-3 sm:mb-4 font-semibold">Modular Design</h3>
                    <p class="text-gray-600 dark:text-gray-700 text-sm sm:text-base">Organize your code into reusable containers. Each feature is isolated, making maintenance and scaling effortless.</p>
                </div>
                <div class="bg-white dark:bg-gray-50 p-4 sm:p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-200 animate-fade-in-up">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 mb-3 sm:mb-4 text-apiato-blue" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 17l5-5-5-5v10zm10-10v10H4V7h16zm2-2H2v14h20V5z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-800 dark:text-gray-900 mb-3 sm:mb-4 font-semibold">Built-in Testing</h3>
                    <p class="text-gray-600 dark:text-gray-700 text-sm sm:text-base">Comprehensive testing tools included. Write unit tests, feature tests, and API tests with ease.</p>
                </div>
                <div class="bg-white dark:bg-gray-50 p-4 sm:p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-200 animate-fade-in-up">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 mb-3 sm:mb-4 text-apiato-blue" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 4v16h16V4H4zm2 2h12v12H6V6zm2 2v8h8V8H8z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-800 dark:text-gray-900 mb-3 sm:mb-4 font-semibold">Rich Documentation</h3>
                    <p class="text-gray-600 dark:text-gray-700 text-sm sm:text-base">Auto-generated API documentation and extensive guides. Get up and running quickly with our resources.</p>
                </div>
                <div class="bg-white dark:bg-gray-50 p-4 sm:p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-200 animate-fade-in-up">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 mb-3 sm:mb-4 text-apiato-blue" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 14v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-800 dark:text-gray-900 mb-3 sm:mb-4 font-semibold">Security First</h3>
                    <p class="text-gray-600 dark:text-gray-700 text-sm sm:text-base">Built-in authentication, authorization, and security best practices. Keep your APIs secure by default.</p>
                </div>
                <div class="bg-white dark:bg-gray-50 p-4 sm:p-6 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 dark:border-gray-200 animate-fade-in-up">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 mb-3 sm:mb-4 text-apiato-blue" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19.43 12.98c.04-.32.07-.64.07-.98s-.03-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.3-.61-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98l-.38-2.65A.488.488 0 0 0 14 2h-4c-.25 0-.46.18-.49.42l-.38 2.65c-.61.25-1.17.59-1.69.98l-2.49-1c-.23-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.07.65-.07.98s.03.66.07.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.03.24.24.42.49.42h4c.25 0 .46-.18.49-.42l.38-2.65c.61-.25 1.17-.59 1.69-.98l2.49 1c.23.09.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65zM12 15.5c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-800 dark:text-gray-900 mb-3 sm:mb-4 font-semibold">High Performance</h3>
                    <p class="text-gray-600 dark:text-gray-700 text-sm sm:text-base">Optimized for speed and scalability. Handle thousands of requests with confidence.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-apiato-blue to-blue-600 text-white py-10 sm:py-12 lg:py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden safe-area-bottom">
        <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Ccircle cx=%2220%22 cy=%2220%22 r=%222%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3Ccircle cx=%2280%22 cy=%2280%22 r=%222%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3Ccircle cx=%2240%22 cy=%2260%22 r=%221%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3Ccircle cx=%2260%22 cy=%2230%22 r=%221.5%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3C/svg%3E')]"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-wrap justify-center gap-6 sm:gap-8 lg:gap-10 mb-8 sm:mb-10">
                <a href="https://apiato.io/" class="text-white/90 hover:text-white text-sm sm:text-base lg:text-lg font-medium transition-colors duration-300 min-h-[44px] flex items-center">Documentation</a>
                <a href="https://github.com/apiato/apiato" class="text-white/90 hover:text-white text-sm sm:text-base lg:text-lg font-medium transition-colors duration-300 min-h-[44px] flex items-center">GitHub</a>
                @if(Route::has('public_docs') && Route::has('private_docs'))
                    <a href="{{ route('public_docs') }}" class="text-white/90 hover:text-white text-sm sm:text-base lg:text-lg font-medium transition-colors duration-300 min-h-[44px] flex items-center">Public API Docs</a>
                    <a href="{{ route('private_docs') }}" class="text-white/90 hover:text-white text-sm sm:text-base lg:text-lg font-medium transition-colors duration-300 min-h-[44px] flex items-center">Private API Docs</a>
                @endif
            </div>
            <hr class="border-white/30 mb-8 sm:mb-10 w-3/4 sm:w-1/2 mx-auto">
            <p class="text-white/80 text-center text-sm sm:text-base lg:text-lg px-4">&copy; {{ date('Y') }} Apiato. A flawless framework for scalable API-Centric Apps.</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const moonIcon = document.getElementById('moon-icon');
        const sunIcon = document.getElementById('sun-icon');
        const navLinks = document.querySelectorAll('nav a, #mobile-menu a');

        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            const isDark = document.body.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'light' : 'dark');
            moonIcon.classList.toggle('hidden', isDark);
            sunIcon.classList.toggle('hidden', !isDark);
            navLinks.forEach(link => {
                link.classList.toggle('text-white', !isDark);
                link.classList.toggle('text-gray-900', isDark);
            });
        });

        // Load saved theme
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'light') {
                document.body.classList.add('dark');
                moonIcon.classList.add('hidden');
                sunIcon.classList.remove('hidden');
                navLinks.forEach(link => link.classList.add('text-gray-900'));
            } else {
                moonIcon.classList.remove('hidden');
                sunIcon.classList.add('hidden');
                navLinks.forEach(link => link.classList.add('text-white'));
            }
        });

        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        let isMenuOpen = false;

        function toggleMobileMenu() {
            isMenuOpen = !isMenuOpen;
            const toggleButton = mobileMenuToggle;
            const hamburgerLines = toggleButton.querySelectorAll('.hamburger-line');

            if (isMenuOpen) {
                // Open menu
                mobileMenu.classList.remove('translate-y-[-20px]', 'opacity-0');
                mobileMenu.classList.add('translate-y-0', 'opacity-100');
                toggleButton.setAttribute('aria-expanded', 'true');

                // Animate hamburger to X
                if (hamburgerLines.length === 3) {
                    hamburgerLines[0].classList.add('rotate-45', 'translate-y-1.5');
                    hamburgerLines[1].classList.add('opacity-0');
                    hamburgerLines[2].classList.add('-rotate-45', '-translate-y-1.5');
                }
            } else {
                // Close menu
                mobileMenu.classList.remove('translate-y-0', 'opacity-100');
                mobileMenu.classList.add('translate-y-[-20px]', 'opacity-0');
                toggleButton.setAttribute('aria-expanded', 'false');

                // Animate hamburger back to lines
                if (hamburgerLines.length === 3) {
                    hamburgerLines[0].classList.remove('rotate-45', 'translate-y-1.5');
                    hamburgerLines[1].classList.remove('opacity-0');
                    hamburgerLines[2].classList.remove('-rotate-45', '-translate-y-1.5');
                }
            }
        }

        function closeMobileMenu() {
            if (isMenuOpen) {
                toggleMobileMenu();
            }
        }

        // Add click event listener to mobile menu toggle
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleMobileMenu();
            });
        }

        // Close menu when clicking outside
        if (mobileMenu) {
            mobileMenu.addEventListener('click', (e) => {
                if (e.target === mobileMenu) {
                    closeMobileMenu();
                }
            });
        }

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isMenuOpen) {
                closeMobileMenu();
            }
        });

        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                    });
                }
                // Close mobile menu if open (handled by onclick in mobile menu links)
            });
        });
    </script>
</body>
</html>