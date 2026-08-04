<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	@vite([
        "resources/css/register/global.css",
        "resources/css/register/reg.css",
        "resources/css/register/reset.css",
    ])
    <style>
        .input-field { background: transparent; border: none; color: white; width: 100%; outline: none; font-family: inherit; font-size: inherit; }
        .input-field::placeholder { color: rgba(255, 255, 255, 0.5); }
        .text-error { color: #ff6b6b; font-size: 12px; margin-top: 4px; }
        .card-over-input input[type="checkbox"] { width: 100%; height: 100%; cursor: pointer; }
        .alert { background-color: rgba(255, 107, 107, 0.2); border: 1px solid #ff6b6b; color: white; padding: 10px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
    </style>
</head>

<body>
	<div class="main">
		<div class="main-container">
			<div class="main-overlay-plus-blur main-overlay-plus1"></div>
			<div class="main-overlay-plus-blur main-overlay-plus2"></div>
		</div>
		
		<div class="card-over">
			<img src="assets/card-over-container.png" class="card-over-container1" />
			
			<div class="card-over-container2">
				<div class="card-over-container3">
					<p class="card-over-text-heading">GemuList</p>
					<p class="card-over-text-container">Start your gaming journey today</p>
				</div>
				
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert">
                            <p>Please fix the errors below.</p>
                        </div>
                    @endif

                    <div class="card-over-form">
                        <div class="card-over-container4">
                            <p class="text">Username :</p>
                            
                            <div class="card-over-container5 card">
                                <div class="card-over-container6">
                                    <img src="assets/card-over-icon.png" class="card-over-icon" />
                                </div>
                                
                                <input type="text" name="username" class="text-enter-your input-field" placeholder="Enter your username" value="{{ old('username') }}" required autofocus />
                            </div>
                            @error('username')
                                <p class="text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="card-over-container7">
                            <p class="text">EMAIL :</p>
                            
                            <div class="card-over-container8 card">
                                <div class="container-a container2">
                                    <img src="assets/container/container-icon1.png" />
                                </div>
                                
                                <input type="email" name="email" class="text-enter-your input-field" placeholder="Enter your email" value="{{ old('email') }}" required />
                            </div>
                            @error('email')
                                <p class="text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="container-b container3">
                            <p class="text">PASSWORD :</p>
                            
                            <div class="container-container card">
                                <div class="container-a container1">
                                    <img src="assets/container/container-icon2.png" />
                                </div>
                                
                                <input type="password" name="password" class="text-enter-your input-field" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" required />
                            </div>
                            @error('password')
                                <p class="text-error">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="container-b container4">
                            <p class="text">confirm PASSWORD :</p>
                            
                            <div class="container-container card">
                                <div class="container-a container1">
                                    <img src="assets/container/container-icon2.png" />
                                </div>
                                
                                <input type="password" name="password_confirmation" class="text-enter-your input-field" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" required />
                            </div>
                        </div>
                        
                        <div>
                            <div class="card-over-container9">
                                <div class="card-over-input">
                                    <input type="checkbox" name="terms" id="terms" required {{ old('terms') ? 'checked' : '' }} />
                                </div>
                                <label for="terms" class="card-over-text-label" style="cursor: pointer;">I accept the Terms of Service and Privacy Policy</label>
                            </div>
                            @error('terms')
                                <p class="text-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="card-over-container10">
                        <button type="submit" class="card-over-btn hover-bright" style="width: 100%; border: none; cursor: pointer;">Sign Up</button>
                        
                        <div class="card-over-paragraph">
                            <p class="card-over-text-already-have">Already have an account?</p>
                            <a href="{{ route('login') }}" class="card-over-text-sign-in" style="text-decoration: none;">Sign In</a>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
</body>

</html>
