<x-guest-layout>
    <div class="backdrop-blur-auth w-full bg-primary border border-input-border rounded-lg overflow-hidden">
        <!-- Header Image -->
        <img src="{{ asset('assets/card-over-container.png') }}" class="w-full h-auto block opacity-80" alt="Header decoration">

        <!-- Card Content -->
        <div class="flex flex-col gap-4 sm:gap-6 p-8 sm:p-12">
            <!-- Title Section -->
            <div class="flex flex-col gap-2 text-center">
                <h1 class="text-xl sm:text-2xl font-bold text-secondary font-sora leading-tight -tracking-wide">GemuList</h1>
                <p class="text-sm sm:text-base text-surface font-inter">Login to access your performance data</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Form Fields -->
                <div class="flex flex-col gap-3 sm:gap-4">
                    <!-- Email Field -->
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-xs sm:text-sm font-mono font-medium uppercase tracking-wider text-surface">Email</label>

                        <div class="flex items-center gap-4 bg-input border border-input-border rounded px-4 py-3 focus-within:border-secondary focus-within:ring-1 focus-within:ring-secondary transition-colors @error('email') border-red-500 @enderror">
                            <img src="{{ asset('assets/container/container-icon1.png') }}" alt="Email icon" class="w-4 h-4 flex-shrink-0 opacity-70">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-muted"
                                required
                                autocomplete="username"
                                autofocus
                            >
                        </div>

                        @error('email')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-xs sm:text-sm font-mono font-medium uppercase tracking-wider text-surface">Password</label>

                        <div class="flex items-center gap-5 bg-input border border-input-border rounded px-4 py-3 focus-within:border-secondary focus-within:ring-1 focus-within:ring-secondary transition-colors @error('password') border-red-500 @enderror">
                            <img src="{{ asset('assets/container/container-icon2.png') }}" alt="Password icon" class="w-3 h-3 flex-shrink-0 opacity-70">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-muted"
                                required
                                autocomplete="current-password"
                            >
                        </div>

                        @error('password')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember -->
                    <div class="flex items-center justify-between flex-wrap gap-3 text-xs sm:text-sm pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="checkbox"
                                id="remember"
                                name="remember"
                                class="h-4 w-4 rounded border border-input-border bg-input accent-secondary flex-shrink-0 cursor-pointer"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <span class="text-surface select-none">Remember me</span>
                        </label>
                    </div>
                </div>

                <!-- Submit & Register Link -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-8 flex-wrap">
                    <div class="flex items-center gap-1 text-xs sm:text-sm">
                        <span class="text-muted">Don't have account?</span>
                        <a href="{{ route('register') }}" class="font-semibold text-secondary hover:text-white hover:underline transition-colors">Register Here</a>
                    </div>

                    <button type="submit" class="w-full sm:w-auto rounded bg-secondary px-8 py-2.5 text-primary font-bold shadow-lg shadow-secondary/20 hover-bright transition-all cursor-pointer">Login</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
