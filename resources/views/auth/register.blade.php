<x-guest-layout>
    <div class="backdrop-blur-auth w-full bg-primary border border-input-border rounded-lg overflow-hidden">
        <!-- Header Image -->
        <img src="{{ asset('assets/card-over-container.png') }}" class="w-full h-auto block opacity-80" alt="Header decoration">

        <!-- Card Content -->
        <div class="flex flex-col gap-4 sm:gap-6 p-8 sm:p-12">
            <!-- Title Section -->
            <div class="flex flex-col gap-2 text-center">
                <h1 class="text-xl sm:text-2xl font-bold text-secondary font-sora leading-tight -tracking-wide">GemuList</h1>
                <p class="text-sm sm:text-base text-surface font-inter">Start your gaming journey today</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Form Fields -->
                <div class="flex flex-col gap-3 sm:gap-4">
                    <!-- Username Field -->
                    <div class="flex flex-col gap-2">
                        <label for="username" class="text-xs sm:text-sm font-mono font-medium uppercase tracking-wider text-surface">Username</label>

                        <div class="flex items-center gap-4 bg-input border border-input-border rounded px-4 py-3 focus-within:border-secondary focus-within:ring-1 focus-within:ring-secondary transition-colors @error('username') border-red-500 @enderror">
                            <img src="{{ asset('assets/card-over-icon.png') }}" alt="User icon" class="w-4 h-4 flex-shrink-0 opacity-70">
                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Enter your username"
                                class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-muted"
                                required
                                autocomplete="username"
                                autofocus
                            >
                        </div>

                        @error('username')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                                placeholder="********"
                                class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-muted"
                                required
                                autocomplete="new-password"
                            >
                        </div>

                        @error('password')
                            <p class="text-xs text-red-400 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="text-xs sm:text-sm font-mono font-medium uppercase tracking-wider text-surface">Confirm Password</label>

                        <div class="flex items-center gap-5 bg-input border border-input-border rounded px-4 py-3 focus-within:border-secondary focus-within:ring-1 focus-within:ring-secondary transition-colors">
                            <img src="{{ asset('assets/container/container-icon2.png') }}" alt="Password icon" class="w-3 h-3 flex-shrink-0 opacity-70">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="********"
                                class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-muted"
                                required
                                autocomplete="new-password"
                            >
                        </div>
                    </div>
                </div>

                <!-- Submit & Login Link -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-8 flex-wrap">
                    <div class="flex items-center gap-1 text-xs sm:text-sm">
                        <span class="text-muted">Already have an account?</span>
                        <a href="{{ route('login') }}" class="font-semibold text-secondary hover:text-white hover:underline transition-colors">Login</a>
                    </div>

                    <button type="submit" class="w-full sm:w-auto rounded bg-secondary px-8 py-2.5 text-primary font-bold shadow-lg shadow-secondary/20 hover-bright transition-all cursor-pointer">Register</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
