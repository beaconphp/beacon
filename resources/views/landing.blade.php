<x-layouts.base title="Beacon">
    <x-slot:body class="bg-white text-zinc-900 font-sans antialiased overflow-x-hidden">
        <header class="fixed top-0 w-full bg-white/80 backdrop-blur-md z-50 border-b border-zinc-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <a href="{{ route('landing') }}">
                        <x-logo color class="h-6"/>
                    </a>

                    <div class="flex items-center space-x-4">
                        @if(current_user()?->canAccessDashboard())
                            <a href="{{ route('dashboard.tickets.index') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white text-sm md:text-base px-4 py-1.5 md:px-6 md:py-2.5 rounded-lg md:rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">Go to dashboard</a>
                        @else
                            <a href="{{ route('dashboard.login') }}" class="hidden sm:inline-block text-zinc-500 hover:text-zinc-900 transition-colors font-medium">Sign In</a>
                            <a href="{{ route('dashboard.login') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 text-white text-sm md:text-base px-4 py-1.5 md:px-6 md:py-2.5 rounded-lg md:rounded-xl font-semibold hover:shadow-lg hover:scale-105 transition-all duration-200">Get Started</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
            <div class="absolute top-10 md:top-20 -left-10 md:left-10 size-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
            <div class="absolute top-72 md:top-40 -right-20 md:right-10 size-52 md:size-72 bg-pink-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center space-x-2 border border-zinc-200 rounded-full px-5 py-2 mb-8">
                        <span class="w-2 h-2 bg-pink-500 rounded-full animate-pulse"></span>
                        <span class="text-sm font-semibold">Open Source & Self-Hosted</span>
                        <img src="https://img.shields.io/github/stars/beaconphp/beacon" alt="">
                    </div>

                    <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-semibold mb-6">
                        Perfect Support for
                        <span class="block">Extraordinary Growth</span>
                    </h1>

                    <p class="text-xl text-zinc-600 mb-10 max-w-2xl mx-auto leading-relaxed">Enhance your customer support workflow with intelligent ticketing, intuitive dashboard and analytics. Built with <span class="italic font-serif">Laravel</span> for developers who care.</p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('dashboard.login') }}" class="w-full sm:w-auto bg-gradient-to-r from-pink-500 to-pink-600 text-white px-8 py-4 rounded-xl font-semibold text-lg hover:shadow-2xl hover:scale-105 transition-all duration-200 glow-button">Start ticketing</a>
                        <a href="https://github.com/beaconphp/beacon" target="_blank" class="w-full sm:w-auto bg-white border-2 border-zinc-200 text-zinc-900 px-8 py-4 rounded-xl font-semibold text-lg hover:border-zinc-300 hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            <span>View on GitHub</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </x-slot:body>
</x-layouts.base>