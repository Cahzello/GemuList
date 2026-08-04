<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link
        href="https://fonts.googleapis.com/css2?family=JetBrains Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body
    class="bg-[#141414] bg-[radial-gradient(ellipse_at_top,_#2a2a2a_0%,_#181818_55%,_#141414_100%)] bg-fixed text-[#F4F4F4] font-sans m-0 min-h-screen">
    <div class="page min-h-screen bg-transparent">
        <main class="main max-w-[1400px] mx-auto pt-24 sm:pt-32 lg:pt-36 pb-20 px-4 sm:px-8 lg:px-12">
            <div class="header-container mb-8 sm:mb-12">
                <h1
                    class="page-title font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl uppercase tracking-wider bg-gradient-to-r from-[#FF6B35] to-[#FF9F1C] bg-clip-text text-transparent mb-3 sm:mb-4 inline-block leading-tight">
                    My Games
                </h1>
                <p
                    class="page-desc font-sans font-normal text-sm sm:text-base text-zinc-400 max-w-2xl leading-relaxed m-0">
                    Manage your personal library. Track what you're playing, what you've
                    conquered, and what's next on your journey through the digital
                    realms.
                </p>
            </div>

            <div class="content-row flex flex-col lg:flex-row items-stretch lg:items-start gap-6 w-full">
                <!-- LEFT COLUMN: COLLECTION LIST -->
                <section class="collection-panel relative flex-1 min-w-0 bg-transparent border-0 flex flex-col w-full">
                    <div class="collection-list flex flex-col gap-4 p-0 flex-1 w-full">
                        <!-- Game Card 1 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #22c55e"></div>
                            <div
                                class="card-cover cover-witcher flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0c/Witcher_3_cover_art.jpg/250px-Witcher_3_cover_art.jpg?utm_source=en.wikipedia.org&utm_campaign=parser&utm_content=thumbnail"
								 alt="The Witcher 3: Wild Hunt"
                                    class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        The Witcher 3: Wild Hunt
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15" viewBox="0 0 21 21"
                                            fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-finished font-mono text-sm font-medium text-[#22C55E]">Finished</span>
                                    </button>
                                </div>
                            </div>
                        </article>

                        <!-- Game Card 2 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #ff9f1c"></div>
                            <div
                                class="card-cover cover-persona flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://store-images.s-microsoft.com/image/apps.6937.14482474285447263.b2785fbb-9099-42c3-b705-629a79ac7e4a.1b3fdd25-f787-4146-8551-d00ad4d5be21"
								 alt="Persona 5: Royal" class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        Persona 5: Royal
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15" viewBox="0 0 21 21"
                                            fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-progress font-mono text-sm font-medium text-[#FF9F1C]">On
                                            Progress</span>
                                    </button>
                                </div>
                            </div>
                        </article>

                        <!-- Game Card 3 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #a0a0a0"></div>
                            <div
                                class="card-cover cover-elden flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTb1EHPzTI54_muBWIcz9hzr9SatK9jVBp2_wSbKoHHOtnhg8UAncbU5Ej8&s=10"
								 alt="Elden Ring" class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        Elden Ring
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15"
                                            viewBox="0 0 21 21" fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-planning font-mono text-sm font-medium text-[#A0A0A0]">Planning</span>
                                    </button>
                                </div>
                            </div>
                        </article>

                        <!-- Game Card 4 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #22c55e"></div>
                            <div
                                class="card-cover flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://store-images.s-microsoft.com/image/apps.47379.63407868131364914.bcaa868c-407e-42c2-baeb-48a3c9f29b54.89bb995b-b066-4a53-9fe4-0260ce07e894"
								 alt="Cyberpunk 2077"
                                    class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        Cyberpunk 2077
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15"
                                            viewBox="0 0 21 21" fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-finished font-mono text-sm font-medium text-[#22C55E]">Finished</span>
                                    </button>
                                </div>
                            </div>
                        </article>

                        <!-- Game Card 5 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #ff6b35"></div>
                            <div
                                class="card-cover flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://image.api.playstation.com/cdn/UP1004/CUSA03041_00/Hpl5MtwQgOVF9vJqlfui6SDB5Jl4oBSq.png"
								 alt="Red Dead Redemption 2"
                                    class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        Red Dead Redemption 2
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15"
                                            viewBox="0 0 21 21" fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-dropped font-mono text-sm font-medium text-[#FF6B35]">Dropped</span>
                                    </button>
                                </div>
                            </div>
                        </article>

                        <!-- Game Card 6 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #ff9f1c"></div>
                            <div
                                class="card-cover flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/a/a7/God_of_War_4_cover.jpg/250px-God_of_War_4_cover.jpg"
								 alt="God of War" class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        God of War
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15"
                                            viewBox="0 0 21 21" fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-progress font-mono text-sm font-medium text-[#FF9F1C]">On
                                            Progress</span>
                                    </button>
                                </div>
                            </div>
                        </article>

                        <!-- Game Card 7 -->
                        <article
                            class="game-card relative flex flex-col sm:flex-row gap-5 sm:gap-6 p-4 sm:p-6 bg-[#1E1E1E] border border-white/10 rounded-2xl z-10 transition-all duration-200 hover:border-[#FF6B35]/40 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-black/50 w-full box-border">
                            <div class="card-accent absolute left-0 top-0 bottom-0 w-1.5 rounded-l-2xl"
                                style="background: #a0a0a0"></div>
                            <div
                                class="card-cover flex-shrink-0 w-full sm:w-[148px] h-[200px] rounded-xl overflow-hidden bg-gradient-to-br from-zinc-800 to-zinc-950">
                                <img src="https://store-images.s-microsoft.com/image/apps.11593.13550459053619040.9c555c73-a698-4992-b0f3-c5084cf18b5e.82a9ea41-c628-4d02-8a0f-d0304eba31c7"
								 alt="Baldur's Gate 3"
                                    class="w-full h-full object-cover block" />
                            </div>
                            <div class="card-body flex-1 min-w-0 flex flex-col justify-start gap-4 pt-1">
                                <div class="card-title-row flex items-start justify-between gap-3">
                                    <h3
                                        class="card-title font-display font-bold text-lg sm:text-xl text-[#F4F4F4] leading-snug m-0">
                                        Baldur's Gate 3
                                    </h3>
                                    <button
                                        class="icon-btn flex-shrink-0 w-8 h-8 flex items-center justify-center bg-transparent border-0 rounded-lg cursor-pointer hover:bg-white/10 transition-colors"
                                        aria-label="Delete game">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none">
                                            <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path
                                                d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                                            <path
                                                d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                                                stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                            <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4"
                                                stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="card-status-block flex flex-col gap-2 w-full sm:max-w-[220px]">
                                    <span class="field-label font-mono text-xs font-medium text-zinc-400">Status</span>
                                    <button
                                        class="status-select relative flex items-center gap-2.5 px-3.5 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl cursor-pointer w-full text-left">
                                        <svg class="status-chevron" width="15" height="15"
                                            viewBox="0 0 21 21" fill="none">
                                            <path d="M6 7.5L10.5 12L15 7.5" stroke="#6B7280" stroke-width="1.575" />
                                        </svg>
                                        <span
                                            class="status-text status-planning font-mono text-sm font-medium text-[#A0A0A0]">Planning</span>
                                    </button>
                                </div>
                            </div>
                        </article>
                    </div>
                </section>

                <!-- RIGHT COLUMN: SIDEBAR FILTERS -->
                <aside class="sidebar w-full lg:w-[320px] flex-shrink-0 order-first lg:order-last">
                    <div
                        class="sidebar-panel relative bg-[#1E1E1E] border border-white/10 rounded-2xl p-5 sm:p-7 flex flex-col gap-6 w-full">
                        <div class="sidebar-heading flex items-center gap-3 pb-4 border-b border-white/10">
                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none">
                                <rect width="18" height="2" fill="#FF6B35" />
                                <rect y="5" width="18" height="2" fill="#FF6B35" />
                                <rect y="10" width="18" height="2" fill="#FF6B35" />
                            </svg>
                            <span class="sidebar-heading-text font-display font-bold text-lg text-[#F4F4F4]">Sort &amp;
                                Filter</span>
                        </div>

                        <div class="search-block flex flex-col gap-2.5">
                            <label class="field-label font-mono text-xs font-medium text-zinc-400">Search
                                Collection</label>
                            <div class="search-input-wrap relative">
                                <input type="text"
                                    class="search-input w-full py-3 pr-10 pl-3.5 bg-white/[0.03] border border-white/10 rounded-xl text-[#F4F4F4] font-mono text-xs sm:text-sm focus:outline-none focus:border-[#FF6B35]"
                                    placeholder="Find a game..." />
                                <svg class="search-icon absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                                    width="14" height="14" viewBox="0 0 10.5 10.5" fill="none">
                                    <circle cx="4.5" cy="4.5" r="4" stroke="#8890A6" stroke-width="1" />
                                    <line x1="7.8" y1="7.8" x2="10" y2="10"
                                        stroke="#8890A6" stroke-width="1" />
                                </svg>
                            </div>
                        </div>

                        <div class="sort-block flex flex-col gap-2.5">
                            <label class="field-label font-mono text-xs font-medium text-zinc-400">Title</label>
                            <div class="sort-buttons flex gap-2.5">
                                <button
                                    class="sort-btn active flex-1 flex items-center justify-center gap-2 py-2.5 bg-[#FF6B35]/15 border border-[#FF6B35]/60 rounded-xl text-[#FF6B35] font-mono text-xs sm:text-sm font-medium cursor-pointer transition-all duration-200">
                                    <svg width="12" height="12" viewBox="0 0 10 10" fill="none">
                                        <path d="M2 2V8M2 2L4 4M2 2L0 4" stroke="#FF6B35" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            transform="translate(0.5 0.5)" />
                                    </svg>
                                    <span>0&ndash;Z</span>
                                </button>
                                <button
                                    class="sort-btn flex-1 flex items-center justify-center gap-2 py-2.5 bg-white/[0.03] border border-white/10 rounded-xl text-[#F4F4F4] font-mono text-xs sm:text-sm font-medium cursor-pointer transition-all duration-200">
                                    <svg width="12" height="12" viewBox="0 0 10 10" fill="none">
                                        <path d="M2 8V2M2 8L4 6M2 8L0 6" stroke="#DAE2FC" stroke-width="1.2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            transform="translate(0.5 0.5)" />
                                    </svg>
                                    <span>Z&ndash;0</span>
                                </button>
                            </div>
                        </div>

                        <div class="filter-status-block flex flex-col gap-2.5">
                            <label class="field-label font-mono text-xs font-medium text-zinc-400">Status</label>
                            <div class="checkbox-list flex flex-col sm:flex-row lg:flex-col flex-wrap gap-3.5 pt-0.5">
                                <label class="checkbox-item flex items-center gap-3 cursor-pointer select-none">
                                    <span
                                        class="checkbox checked flex-shrink-0 w-[18px] h-[18px] rounded-md border border-[#FF6B35] flex items-center justify-center bg-[#FF6B35]">
                                        <svg width="9.51" height="7.01" viewBox="0 0 10 8" fill="none">
                                            <path d="M1 4L3.5 6.5L9 1" stroke="#FFFFFF" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <input type="checkbox" checked hidden />
                                    <span class="checkbox-text font-mono text-sm text-[#A0A0A0]">Planning</span>
                                </label>

                                <label class="checkbox-item flex items-center gap-3 cursor-pointer select-none">
                                    <span
                                        class="checkbox checked flex-shrink-0 w-[18px] h-[18px] rounded-md border border-[#FF6B35] flex items-center justify-center bg-[#FF6B35]">
                                        <svg width="9.51" height="7.01" viewBox="0 0 10 8" fill="none">
                                            <path d="M1 4L3.5 6.5L9 1" stroke="#FFFFFF" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <input type="checkbox" checked hidden />
                                    <span class="checkbox-text font-mono text-sm text-[#FF9F1C]">On Progress</span>
                                </label>

                                <label class="checkbox-item flex items-center gap-3 cursor-pointer select-none">
                                    <span
                                        class="checkbox checked flex-shrink-0 w-[18px] h-[18px] rounded-md border border-[#FF6B35] flex items-center justify-center bg-[#FF6B35]">
                                        <svg width="9.51" height="7.01" viewBox="0 0 10 8" fill="none">
                                            <path d="M1 4L3.5 6.5L9 1" stroke="#FFFFFF" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <input type="checkbox" checked hidden />
                                    <span class="checkbox-text font-mono text-sm text-[#22C55E]">Finished</span>
                                </label>

                                <label class="checkbox-item flex items-center gap-3 cursor-pointer select-none">
                                    <span
                                        class="checkbox flex-shrink-0 w-[18px] h-[18px] rounded-md border border-white/10 flex items-center justify-center bg-white/[0.03]">
                                        <svg width="9.51" height="7.01" viewBox="0 0 10 8" fill="none"
                                            class="opacity-0">
                                            <path d="M1 4L3.5 6.5L9 1" stroke="#FFFFFF" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                    <input type="checkbox" hidden />
                                    <span class="checkbox-text font-mono text-sm text-[#FF6B35]">Dropped</span>
                                </label>
                            </div>
                        </div>

                        <button
                            class="apply-btn mt-1 w-full py-3.5 bg-[#FF6B35] hover:bg-[#E85A24] border-0 rounded-xl text-white font-display font-bold text-base cursor-pointer shadow-lg shadow-[#FF6B35]/35 transition-all duration-200 active:scale-95">
                            Apply Changes
                        </button>
                    </div>
                </aside>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="delete-modal-overlay fixed inset-0 bg-black/75 hidden items-center justify-center z-[9999] backdrop-blur-sm"
        id="deleteModal">
        <div
            class="delete-modal bg-[#1E1E1E] border border-white/10 rounded-2xl p-8 sm:p-10 max-w-[370px] w-[90%] text-center shadow-2xl animate-scaleIn">
            <div
                class="delete-icon w-20 h-20 bg-[#FF6B35]/15 border border-[#FF6B35]/30 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg width="32" height="36" viewBox="0 0 16 18" fill="none">
                    <path d="M1 4H15" stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                    <path d="M5.5 4V2.2C5.5 1.8 5.85 1.5 6.25 1.5H9.75C10.15 1.5 10.5 1.8 10.5 2.2V4" stroke="#FF6B35"
                        stroke-width="1.4" stroke-linecap="round" />
                    <path d="M2.5 4L3.2 16C3.25 16.6 3.75 17 4.3 17H11.7C12.25 17 12.75 16.6 12.8 16L13.5 4"
                        stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6.3 7.5V13.5" stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                    <path d="M9.7 7.5V13.5" stroke="#FF6B35" stroke-width="1.4" stroke-linecap="round" />
                </svg>
            </div>
            <h2
                class="delete-modal-title font-display font-semibold text-xl sm:text-2xl text-[#F4F4F4] m-0 mb-8 tracking-tight">
                Delete this game?
            </h2>
            <div class="delete-modal-buttons flex gap-3">
                <button
                    class="delete-btn-confirm flex-1 py-3.5 px-6 bg-[#FF6B35] hover:bg-[#E85A24] border-0 rounded-xl text-white font-display font-semibold text-base cursor-pointer transition-all duration-200 active:scale-95"
                    id="confirmDelete">
                    Delete
                </button>
                <button
                    class="delete-btn-cancel flex-1 py-3.5 px-6 bg-transparent border-1.5 border-white/15 hover:border-white/30 hover:bg-white/5 rounded-xl text-[#F4F4F4] font-display font-semibold text-base cursor-pointer transition-all duration-200 active:scale-95"
                    id="cancelDelete">
                    No
                </button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>
