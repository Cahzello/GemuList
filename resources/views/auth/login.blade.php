<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - GemuList</title>
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	@vite([
		"resources/css/login/global.css",
		"resources/css/login/login.css",
		"resources/css/login/reset.css",
	])
</head>

<body>
	<div class="main">
		<div class="main-container">
			<div class="main-overlay-plus-blur main-overlay-plus1"></div>
			<div class="main-overlay-plus-blur main-overlay-plus2"></div>
		</div>
		
		<div class="card-over">
			<img src="{{ asset('assets/card-over-container.png') }}" class="card-over-container1" alt="Header decoration">
			
			<div class="card-over-container2">
				<div class="card-over-container3">
					<p class="card-over-text-heading">GemuList</p>
					<p class="card-over-text-container">Login to access your performance data</p>
				</div>
				
				<form method="POST" action="{{ route('login') }}" class="card-over-form">
					@csrf
					
					<div class="card-over-container4">
						<label for="email" class="card-over-text-a">EMAIL :</label>
						
						<div class="card-over-container5 card @error('email') error @enderror">
							<div class="container container1">
								<img src="{{ asset('assets/container/container-icon1.png') }}" alt="Email icon">
							</div>
							
							<input 
								type="email" 
								id="email" 
								name="email" 
								value="{{ old('email') }}"
								placeholder="Enter your email"
								class="card-over-input-field"
								required
								autocomplete="email"
								autofocus
							>
						</div>
						
						@error('email')
							<span class="error-message">{{ $message }}</span>
						@enderror
					</div>
					
					<div class="card-over-container6">
						<label for="password" class="card-over-text-a">PASSWORD :</label>
						
						<div class="card-over-container7 card @error('password') error @enderror">
							<div class="container container2">
								<img src="{{ asset('assets/container/container-icon2.png') }}" alt="Password icon">
							</div>
							
							<input 
								type="password" 
								id="password" 
								name="password" 
								placeholder="Enter your password"
								class="card-over-input-field"
								required
								autocomplete="current-password"
							>
						</div>
						
						@error('password')
							<span class="error-message">{{ $message }}</span>
						@enderror
					</div>
					
					<div class="card-over-container8">
						<div class="card-over-container9">
							<input 
								type="checkbox" 
								id="remember" 
								name="remember" 
								class="card-over-checkbox"
								{{ old('remember') ? 'checked' : '' }}
							>
							<label for="remember" class="card-over-text-label">Remember me</label>
						</div>
						
						@if (Route::has('password.request'))
							<a href="{{ route('password.request') }}" class="card-over-text-link">Forgot?</a>
						@endif
					</div>
					
					<div class="card-over-container10">
						<button type="submit" class="card-over-btn hover-bright">Login</button>
						
						<div class="card-over-paragraph">
							<p class="card-over-text3">Don't have account? </p>
							<a href="{{ route('register') }}" class="card-over-text-link-register">Register Here</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
