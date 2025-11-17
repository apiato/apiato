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
    <title>Apiato - Login</title>

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
                        'shake': 'shake 0.5s ease-in-out',
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
                        shake: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '25%': { transform: 'translateX(-5px)' },
                            '75%': { transform: 'translateX(5px)' },
                        },
                    },
                },
            },
        };
    </script>

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
    </style>
</head>
<body class="bg-gradient-to-br from-apiato-dark via-apiato-darker to-gray-900 dark:from-gray-50 dark:via-gray-100 dark:to-gray-200 min-h-screen flex items-center justify-center relative font-raleway transition-colors duration-300 overflow-x-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22%3E%3Ccircle cx=%2225%22 cy=%2225%22 r=%221%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3Ccircle cx=%2275%22 cy=%2275%22 r=%221%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3Ccircle cx=%2250%22 cy=%2210%22 r=%220.5%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3Ccircle cx=%2290%22 cy=%2240%22 r=%220.8%22 fill=%22rgba(68,87,194,0.1)%22/%3E%3C/svg%3E')]"></div>

    <!-- Back Link -->
    <a href="/" class="absolute top-4 left-4 sm:top-6 sm:left-6 z-50 text-white/80 hover:text-white dark:text-gray-600 dark:hover:text-gray-900 transition-colors duration-300 flex items-center gap-2 text-sm sm:text-base font-medium animate-slide-in">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Home
    </a>

    <!-- Login Container -->
    <div class="w-full max-w-md mx-4 sm:mx-6 lg:mx-8 relative z-10">
        <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/50 p-6 sm:p-8 lg:p-10 animate-fade-in-up">
            <!-- Logo Section -->
            <div class="text-center mb-8 sm:mb-10">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-light text-apiato-blue mb-3 sm:mb-4 tracking-widest">Apiato</h1>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base lg:text-lg leading-relaxed">Welcome back!</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="post" class="space-y-6 sm:space-y-8">
                @csrf

                <!-- Session Error -->
                @if(session('login'))
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4 animate-shake">
                        <p class="text-red-600 dark:text-red-400 text-sm font-medium">{{ session('login') }}</p>
                    </div>
                @endif

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full px-4 py-3 sm:px-5 sm:py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:bg-white dark:focus:bg-gray-700 focus:border-apiato-blue focus:ring-4 focus:ring-apiato-blue/10 dark:focus:ring-apiato-blue/20 transition-all duration-300 text-sm sm:text-base outline-none"
                            placeholder="Enter your email"
                        >
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-600 dark:text-red-400 text-xs sm:text-sm font-medium animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 sm:px-5 sm:py-4 bg-gray-50 dark:bg-gray-800 border-2 border-transparent rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:bg-white dark:focus:bg-gray-700 focus:border-apiato-blue focus:ring-4 focus:ring-apiato-blue/10 dark:focus:ring-apiato-blue/20 transition-all duration-300 text-sm sm:text-base outline-none"
                            placeholder="Enter your password"
                        >
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 dark:text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-600 dark:text-red-400 text-xs sm:text-sm font-medium animate-shake">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-apiato-blue to-blue-600 hover:from-blue-600 hover:to-apiato-blue text-white font-semibold text-sm sm:text-base uppercase tracking-wider py-3 sm:py-4 px-6 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group"
                >
                    <span class="relative z-10">Sign In</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                </button>
            </form>

            <!-- Additional Links -->
            <div class="mt-8 sm:mt-10 text-center space-y-4">
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:gap-6 text-sm">
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-apiato-blue hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300 font-medium transition-colors duration-300">
                            Forgot Password?
                        </a>
                    @endif
                    @if(Route::has('register'))
                        <span class="hidden sm:block text-gray-400 dark:text-gray-600">•</span>
                        <a href="{{ route('register') }}" class="text-apiato-blue hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300 font-medium transition-colors duration-300">
                            Create Account
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
