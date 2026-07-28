<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=JetBrains Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/my-games-gl.css" />
@vite(["resources/js/script.js","resources/css/global.css","resources/css/my-games-gl.css","resources/css/reset.css"])
</head>

<body>
	<div class="main">
		<div class="main-container1">
			<h1 class="main-title">MY GAMES</h1>
			<p class="main-text">
				Manage your personal library. Track what you're playing, what you've conquered, and<br />
				what's next on your journey through the digital realms.
			</p>
		</div>
		
		<div class="main-container2">
			<div class="main-section-left">
				<div class="card-game card-game1">
					<div class="card-game-line"></div>
					<img src="assets/card-game/card-game-bg1.png" class="card-game-bg" />
					
					<div class="card-game-container1">
												<div class="card-game-container2">
							<p class="card-game-text">The Witcher 3: Wild Hunt</p>
						</div>
						
						<div class="card-game-container3">
							<p class="card-game-text-label">Status</p>
							
							<button data-status="Finished" class="btn hover-bright">
								<p class="btn-label1">Finished</p>
								
								<div class="btn-icon1">
									<img src="assets/btn-icon-clip/btn-img.png" class="btn-img" />
								</div>
							</button>
						</div>
					</div>
				</div>
				
				<div class="card-game card-game2">
					<div class="card-game-line"></div>
					<img src="assets/card-game/card-game-bg2.png" class="card-game-bg" />
					
					<div class="card-game-container1">
												<div class="card-game-container2">
							<p class="card-game-text">Persona 5: Royal</p>
						</div>
						
						<div class="card-game-container3">
							<p class="card-game-text-label">Status</p>
							
							<button data-status="On Progress" class="btn hover-bright">
								<p class="btn-label1">On Progress</p>
								
								<div class="btn-icon1">
									<img src="assets/btn-icon-clip/btn-img.png" class="btn-img" />
								</div>
							</button>
						</div>
					</div>
				</div>
				
				<div class="card-game card-game3">
					<div class="card-game-line"></div>
					<img src="assets/card-game/card-game-bg3.png" class="card-game-bg" />
					
					<div class="card-game-container1">
												<div class="card-game-container2">
							<p class="card-game-text">Elden Ring</p>
						</div>
						
						<div class="card-game-container3">
							<p class="card-game-text-label">Status</p>
							
							<button data-status="Planning" class="btn hover-bright">
								<p class="btn-label1">Planning</p>
								
								<div class="btn-icon1">
									<img src="assets/btn-icon-clip/btn-img.png" class="btn-img" />
								</div>
							</button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card-aside-right-col">
				<div class="card-aside-right-col-heading">
					<div class="card-aside-right-col-container1">
						<img src="assets/card-aside-right-col-icon1.png" />
					</div>
					
					<p class="card-aside-right-col-text">Sort & Filter</p>
				</div>
				
				<div class="card-aside-right-col-search">
					<p class="card-aside-right-col-text-label1 text">Search Collection</p>
					
					<div class="card-aside-right-col-container2">
						<div class="card-aside-right-col-container3">
							<img src="assets/card-aside-right-col-icon2.png" />
						</div>
						
						<p class="card-aside-right-col-text-find-a-game">Find a game...</p>
					</div>
				</div>
				
				<div class="card-aside-right-col-sort">
					<p class="card-aside-right-col-text-label2">Title</p>
					
					<div class="card-aside-right-col-container4">
						<button class="btn-a btn2 hover-bright">
							<div class="btn-icon-container">
								<img src="assets/btn-icon-container/btn-icon1.png" />
							</div>
							
							<p class="btn-label2">A-Z</p>
						</button>
						
						<button class="btn-a btn3 hover-bright">
							<div class="btn-icon-container">
								<img src="assets/btn-icon-container/btn-icon2.png" />
							</div>
							
							<p class="btn-label2">Z-A</p>
						</button>
					</div>
				</div>
				
				<div class="card-aside-right-col-filter-status">
					<p class="text">Status</p>
					
					<div class="card-aside-right-col-container5">
						<div class="label" data-status="Planning">
							<div class="container filter-checkbox active">
								<img src="assets/container/container-icon.png" class="container-icon" />
							</div>
							<p class="label-text">Planning</p>
						</div>
						
						<div class="label" data-status="On Progress">
							<div class="container filter-checkbox active">
								<img src="assets/container/container-icon.png" class="container-icon" />
							</div>
							<p class="label-text">On Progress</p>
						</div>
						
						<div class="label" data-status="Finished">
							<div class="container filter-checkbox active">
								<img src="assets/container/container-icon.png" class="container-icon" />
							</div>
							<p class="label-text">Finished</p>
						</div>
						
						<div class="label" data-status="Dropped">
							<div class="container filter-checkbox active">
								<img src="assets/container/container-icon.png" class="container-icon" />
							</div>
							<p class="label-text">Dropped</p>
						</div>
					</div>
				</div>
				
				<button class="card-aside-right-col-btn hover-bright">Apply Changes</button>
			</div>
		</div>
	</div>
	<script src="script.js"></script>
</body>

</html>