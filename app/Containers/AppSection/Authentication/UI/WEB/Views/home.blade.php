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
            <a href="/" target="_blank" class="text-xl sm:text-2xl font-semibold text-apiato-blue tracking-wide">Apiato</a>
            <div class="hidden md:flex items-center gap-4 lg:gap-6">
                @if(Route::has('public_docs'))
                    <a href="{{ route('public_docs') }}" target="_blank" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">API Docs (Public)</a>
                @endif
                @if(Route::has('private_docs'))
                    <a href="{{ route('private_docs') }}" target="_blank" class="text-sm font-medium uppercase tracking-wider text-white dark:text-gray-900 hover:text-apiato-blue transition-colors duration-300">API Docs (Private)</a>
                @endif
                @guest('web')
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
                    @if(Route::has('public_docs'))
                        <a href="{{ route('public_docs') }}" target="_blank" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">API Docs (Public)</a>
                    @endif
                    @if(Route::has('private_docs'))
                        <a href="{{ route('private_docs') }}" target="_blank" class="py-3 px-4 text-white dark:text-gray-900 hover:bg-apiato-blue/10 rounded-lg transition-all duration-300 min-h-[44px] flex items-center font-medium text-base" onclick="closeMobileMenu()">API Docs (Private)</a>
                    @endif
                    <div class="h-px bg-white/10 dark:bg-gray-300 my-3"></div>
                    @guest('web')
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
                <a href="https://apiato.io/" target="_blank" class="px-6 py-3 sm:px-8 sm:py-4 bg-gradient-to-r from-apiato-blue to-blue-600 text-white font-semibold text-base sm:text-lg uppercase tracking-wider rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 min-h-[48px] flex items-center justify-center">Get Started</a>
                <a href="https://github.com/apiato/apiato" target="_blank" class="px-6 py-3 sm:px-8 sm:py-4 border-2 border-apiato-blue text-apiato-blue font-semibold text-base sm:text-lg uppercase tracking-wider rounded-full hover:bg-apiato-blue hover:text-white hover:-translate-y-1 transition-all duration-300 min-h-[48px] flex items-center justify-center">View on GitHub</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-apiato-blue to-blue-600 text-white py-10 sm:py-12 lg:py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden safe-area-bottom">
        <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Ccircle cx=%2220%22 cy=%2220%22 r=%222%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3Ccircle cx=%2280%22 cy=%2280%22 r=%222%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3Ccircle cx=%2240%22 cy=%2260%22 r=%221%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3Ccircle cx=%2260%22 cy=%2230%22 r=%221.5%22 fill=%22rgba(255,255,255,0.1)%22/%3E%3C/svg%3E')]"></div>
        <div class="max-w-7xl mx-auto relative z-10">
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
