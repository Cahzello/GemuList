<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - GemuList</title>
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 overflow-auto">
	<div class="relative min-h-screen flex flex-col items-center justify-center p-6 sm:p-12 overflow-hidden">
		<!-- Decorative blur overlays -->
		<div class="absolute top-1/5 -left-20 w-96 h-96 bg-violet-500/20 rounded-lg blur-3xl pointer-events-none"></div>
		<div class="absolute top-1/2 -right-20 w-96 h-96 bg-cyan-600/10 rounded-lg blur-3xl pointer-events-none"></div>
		
		<!-- Auth Card -->
		<div class="relative z-10 backdrop-blur-auth w-full max-w-md bg-slate-900/60 border border-slate-700/10 rounded-lg overflow-hidden">
			<!-- Header Image -->
			<img src="{{ asset('assets/card-over-container.png') }}" class="w-full h-auto block" alt="Header decoration">
			
			<!-- Card Content -->
			<div class="flex flex-col gap-4 sm:gap-6 p-8 sm:p-12">
				<!-- Title Section -->
				<div class="flex flex-col gap-2 text-center">
					<h1 class="text-xl sm:text-2xl font-bold text-white font-sora leading-tight -tracking-wide">GemuList</h1>
					<p class="text-sm sm:text-base text-slate-300 font-inter">Login to access your performance data</p>
				</div>
				
				<!-- Login Form -->
				<form method="POST" action="{{ route('login') }}">
					@csrf
					
					<!-- Form Fields -->
					<div class="flex flex-col gap-3 sm:gap-4">
						<!-- Email Field -->
						<div class="flex flex-col gap-2">
							<label for="email" class="text-xs sm:text-sm font-mono font-medium uppercase tracking-wider text-violet-300">Email :</label>
							
							<div class="flex items-center gap-4 bg-slate-900 border border-slate-600 rounded px-4 py-3 focus-within:border-violet-500 focus-within:ring-1 focus-within:ring-violet-500 transition-colors @error('email') border-red-500 @enderror">
								<img src="{{ asset('assets/container/container-icon1.png') }}" alt="Email icon" class="w-4 h-4 flex-shrink-0">
								<input
									type="email"
									id="email"
									name="email"
									value="{{ old('email') }}"
									placeholder="Enter your email"
									class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-slate-500"
									required
									autocomplete="email"
									autofocus
								>
							</div>
							
							@error('email')
								<p class="text-xs text-red-400 mt-1">{{ $message }}</p>
							@enderror
						</div>
						
						<!-- Password Field -->
						<div class="flex flex-col gap-2">
							<label for="password" class="text-xs sm:text-sm font-mono font-medium uppercase tracking-wider text-violet-300">Password :</label>
							
							<div class="flex items-center gap-5 bg-slate-900 border border-slate-600 rounded px-4 py-3 focus-within:border-violet-500 focus-within:ring-1 focus-within:ring-violet-500 transition-colors @error('password') border-red-500 @enderror">
								<img src="{{ asset('assets/container/container-icon2.png') }}" alt="Password icon" class="w-3 h-3 flex-shrink-0">
								<input
									type="password"
									id="password"
									name="password"
									placeholder="Enter your password"
									class="flex-1 min-w-0 bg-transparent border-none outline-none text-white text-base font-inter placeholder-slate-500"
									required
									autocomplete="current-password"
								>
							</div>
							
							@error('password')
								<p class="text-xs text-red-400 mt-1">{{ $message }}</p>
							@enderror
						</div>
						
						<!-- Remember & Forgot -->
						<div class="flex items-center justify-between flex-wrap gap-3 text-xs sm:text-sm pt-1">
							<label class="flex items-center gap-2 cursor-pointer">
								<input
									type="checkbox"
									id="remember"
									name="remember"
									class="checkbox checkbox-sm checkbox-primary bg-slate-900 border-slate-600 flex-shrink-0"
									{{ old('remember') ? 'checked' : '' }}
								>
								<span class="text-slate-300 select-none">Remember me</span>
							</label>
							
							@if (Route::has('password.request'))
								<a href="{{ route('password.request') }}" class="font-mono font-medium uppercase tracking-wider text-violet-300 hover:text-violet-200 hover:underline transition-colors">Forgot?</a>
							@endif
						</div>
					</div>
					
					<!-- Submit & Register Link -->
					<div class="flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-12 pt-4 flex-wrap">
						<button type="submit" class="btn btn-primary btn-sm sm:btn-md w-full sm:w-auto bg-violet-600 hover:bg-violet-700 border-0 shadow-lg shadow-violet-500/30 hover-bright">Login</button>
						
						<div class="flex items-center gap-1 text-xs sm:text-sm flex-wrap justify-center">
							<span class="text-slate-300">Don't have account?</span>
							<a href="{{ route('register') }}" class="font-semibold text-lime-400 hover:text-lime-300 hover:underline transition-colors">Register Here</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
