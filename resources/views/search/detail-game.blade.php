<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request('title', 'GemuList') }} - Detail Game</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Vite: load app.css (Tailwind CSS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 p-0 bg-[#141414] text-[#F4F4F4] font-['Inter',sans-serif] min-h-screen relative overflow-x-hidden selection:bg-[#FF6B35] selection:text-white bg-[radial-gradient(circle_at_5%_35%,_rgba(255,107,53,0.22)_0%,_rgba(255,107,53,0)_45%),_radial-gradient(circle_at_95%_65%,_rgba(255,159,28,0.20)_0%,_rgba(255,159,28,0)_45%),_linear-gradient(180deg,_#141414_0%,_#1A1A1A_100%)] bg-fixed">

    {{-- Ambient Orange Glow Orbs --}}
    <div class="fixed top-[15%] -left-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,107,53,0.3)_0%,_rgba(255,107,53,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0"></div>
    <div class="fixed bottom-[15%] -right-[120px] w-[500px] h-[500px] bg-[radial-gradient(circle,_rgba(255,159,28,0.25)_0%,_rgba(255,159,28,0)_70%)] blur-[70px] rounded-full pointer-events-none z-0"></div>

@php
    $title = request('title', 'GemuList');
    $image = request('image', null);

    $descriptions = [
        'Cyberpunk 2077' => "Navigate the digital sprawl of Night City in this open-world action-adventure RPG. Step into the shoes of V, a mercenary outlaw going after a one-of-a-kind implant that is the key to immortality.",
        'Elden Ring' => "Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.",
        "Baldur's Gate 3" => "Gather your party and return to the Forgotten Realms in a tale of fellowship and betrayal, sacrifice and survival, and the lure of absolute power.",
        'Valorant' => "Blend your style and experience on a global, competitive stage. You have 13 rounds to attack and defend your side using sharp gunplay and tactical abilities.",
        'Starfield' => "In this next-generation role-playing game set amongst the stars, create any character you want and explore with unparalleled freedom as you embark on an epic journey to answer humanity's greatest mystery.",
        'Red Dead Redemption 2' => "Arthur Morgan and the Van der Linde gang are outlaws on the run. With federal agents and the best bounty hunters in the nation massing on their heels, the gang must rob, steal and fight their way across America.",
        'The Witcher 3' => "You are Geralt of Rivia, mercenary monster slayer. Before you stands a war-torn, monster-infested continent you can explore at will.",
        'God of War Ragnarök' => "Embark on an epic and heartfelt journey as Kratos and Atreus struggle with holding on and letting go through the Nine Realms of Norse mythology.",
        'Hogwarts Legacy' => "Experience Hogwarts in the 1800s. Your character is a student who holds the key to an ancient secret that threatens to tear the wizarding world apart.",
        'Call of Duty: Modern Warfare' => "Drop into a visceral campaign or assemble your team in the ultimate online playground featuring multiple Ops challenges and battlegrounds.",
        'Diablo IV' => "Endless demons to slaughter, countless abilities to master, nightmarish dungeons, and legendary loot in an expansive open world.",
        'Final Fantasy XVI' => "An epic dark fantasy world where the fate of the land is decided by the mighty Eikons and the Dominants who wield them.",
        'Resident Evil 4' => "Survival is just the beginning. Six years have passed since the biological disaster in Raccoon City, Leon S. Kennedy is sent on a mission to rescue the president's kidnapped daughter.",
        'Street Fighter 6' => "Powered by Capcom's proprietary RE ENGINE, the Street Fighter 6 experience spans three distinct game modes featuring World Tour, Fighting Ground and Battle Hub.",
        'Mortal Kombat 1' => "Discover a reborn Mortal Kombat Universe created by the Fire God Liu Kang featuring a new fighting system, game modes, and fatalities!",
    ];

    $defaultDescription = "Navigate the digital sprawl of Neo-Saitama in this high-octane tactical RPG. As a rogue console cowboy, you'll need to optimize your hardware and manage your reputation among the warring megacorps. Every decision impacts your trajectory through the electrified underbelly of the city.";
    $description = $descriptions[$title] ?? $defaultDescription;
@endphp

<section class="min-h-screen bg-transparent text-[#F4F4F4] px-5 lg:px-20 py-[40px] flex flex-col justify-center relative z-10 overflow-x-hidden">
    {{-- Navigation Back Button --}}
    <div class="lg:absolute lg:top-10 lg:left-20 z-10 mb-6 lg:mb-0">
        <a href="{{ route('games.search') }}" class="inline-flex items-center gap-2.5 text-[#A0A0A0] hover:text-white font-['Inter',sans-serif] font-semibold text-base tracking-widest uppercase transition-all duration-200 hover:-translate-x-1 no-underline">
            <svg class="w-4.5 h-4.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 19L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>BACK</span>
        </a>
    </div>

    {{-- Main Content Showcase & Description --}}
    <div class="flex flex-col lg:flex-row items-center lg:items-start justify-center gap-[36px] lg:gap-[60px] max-w-[1200px] mx-auto w-full my-5 lg:my-auto py-10 text-center lg:text-left">

        {{-- Left Column: Media Showcase Visual --}}
        <div class="relative w-[280px] sm:w-[350px] h-[280px] sm:h-[350px] shrink-0">
            <div class="absolute -inset-1 bg-gradient-to-r from-[#FF6B35] to-[#FF9F1C] opacity-35 blur-sm rounded-[15px] pointer-events-none"></div>
            <div class="absolute w-[100px] h-[100px] -left-5 -top-5 bg-[#FF9F1C] mix-blend-screen opacity-25 blur-[25px] rounded-full pointer-events-none"></div>
            <div class="absolute w-[75px] h-[75px] -right-4.5 -bottom-4.5 bg-[#FF6B35] mix-blend-screen opacity-25 blur-[25px] rounded-full pointer-events-none"></div>

            <div class="relative z-10 w-full h-full bg-[#1E1E1E] border border-[#FF6B35]/25 backdrop-blur-md rounded-[15px] flex items-center justify-center overflow-hidden">
                @if (!empty($image) && $image !== 'placeholder')
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover rounded-[14px]">
                @else
                    <svg class="absolute inset-0 w-full h-full pointer-events-none" viewBox="0 0 470 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="0" x2="470" y2="470" stroke="white" stroke-opacity="0.2" stroke-width="2"/>
                        <line x1="470" y1="0" x2="0" y2="470" stroke="white" stroke-opacity="0.2" stroke-width="2"/>
                        <rect x="1" y="1" width="468" height="468" rx="14" stroke="white" stroke-opacity="0.15" stroke-width="1"/>
                    </svg>
                    <span class="relative z-20 font-['Sora',sans-serif] font-bold text-sm tracking-widest uppercase text-white/50 text-center">MEDIA SHOWCASE</span>
                @endif
            </div>
        </div>

        {{-- Right Column: Title, Description, and Action Button --}}
        <div class="flex flex-col justify-between items-center lg:items-start h-auto lg:h-[350px] max-w-[650px] w-full">
            <h1 class="mt-0 lg:-mt-1 mb-4 font-['Sora',sans-serif] font-extrabold text-3xl sm:text-4xl lg:text-5xl leading-tight tracking-tight text-[#FF6B35]">{{ $title }}</h1>
            <p class="m-0 font-['Inter',sans-serif] font-semibold text-base sm:text-lg leading-relaxed text-[#D0D0D0]">
                {{ $description }}
            </p>
            <div class="mt-6 lg:mt-auto flex">
                <button type="button" id="gl10OpenBtn" class="inline-flex items-center justify-center px-7 py-3.5 min-w-[150px] min-h-[48px] bg-[#FF6B35] hover:bg-[#E55A27] active:translate-y-0 disabled:bg-[#FF6B35]/80 disabled:opacity-80 disabled:cursor-not-allowed border-0 rounded-lg font-['Sora',sans-serif] font-bold text-sm text-white cursor-pointer shadow-[0_10px_20px_-3px_rgba(255,107,53,0.4)] hover:shadow-[0_14px_25px_-3px_rgba(255,107,53,0.5)] hover:-translate-y-0.5 transition-all duration-200">
                    Add to My Games
                </button>
            </div>
        </div>

    </div>
</section>

{{-- MODAL / POPUP ADD TO MY GAMES --}}
<div id="gl10ModalBackdrop" class="fixed inset-0 z-[999] bg-transparent flex flex-col items-center justify-center p-5 lg:px-20 lg:py-10 opacity-0 invisible transition-all duration-250 overflow-y-auto [&.is-active]:opacity-100 [&.is-active]:visible" aria-hidden="true">
    <div class="flex flex-col lg:flex-row items-center lg:items-start justify-center gap-[36px] lg:gap-[60px] max-w-[1200px] mx-auto w-full my-5 lg:my-auto py-10">
        <div class="hidden lg:block w-[350px] h-[350px] shrink-0 invisible"></div>
        <div class="flex flex-col items-center lg:items-start max-w-[650px] w-full">
            <div class="w-[360px] max-w-[90vw] bg-[#1E1E1E]/92 border border-[#FF9F1C]/35 shadow-[0_20px_40px_-10px_rgba(0,0,0,0.6)] backdrop-blur-md rounded-lg overflow-visible scale-95 translate-y-2.5 transition-transform duration-250 ease-out [.is-active_&]:scale-100 [.is-active_&]:translate-y-0" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
                {{-- Modal Header --}}
                <div class="flex items-center justify-between h-[52px] px-5 bg-[#282828]/80 border-b border-[#FF9F1C]/20 rounded-t-lg">
                    <h2 id="modalTitle" class="m-0 font-['Sora',sans-serif] font-bold text-lg text-[#FF9F1C] flex items-center">Status Game</h2>
                    <button type="button" id="gl10ModalCloseBtn" class="bg-transparent border-0 cursor-pointer text-[#D0D0D0] hover:text-white p-1 rounded transition-colors flex items-center justify-center" aria-label="Close">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5">
                            <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="p-6 sm:p-7 flex flex-col gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="font-['Sora',sans-serif] font-semibold text-base text-[#F4F4F4] flex items-center">Status:</label>
                        <div id="gl10CustomSelect" class="relative w-full">
                            <button type="button" class="w-full h-11 px-3.5 bg-[#1E1E1E] border border-[#FF6B35]/35 focus:border-[#FF6B35] focus:ring-2 focus:ring-[#FF6B35]/30 rounded font-['Inter',sans-serif] text-base text-[#F4F4F4] flex items-center justify-between cursor-pointer outline-none transition-all [.is-open_&]:border-[#FF6B35] [.is-open_&]:ring-2 [.is-open_&]:ring-[#FF6B35]/30" aria-haspopup="listbox" aria-expanded="false">
                                <span class="gl10-select-value">Planning</span>
                                <svg class="w-3.5 h-3.5 text-[#D0D0D0] transition-transform duration-200 [.is-open_&]:rotate-180" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>

                            <div class="absolute top-[calc(100%+6px)] inset-x-0 z-[1050] bg-[#1E1E1E] border border-[#FF6B35]/40 rounded-md shadow-2xl overflow-hidden opacity-0 invisible -translate-y-1.5 transition-all duration-200 [.is-open_&]:opacity-100 [.is-open_&]:visible [.is-open_&]:translate-y-0" role="listbox">
                                <div class="gl10-select-option px-3.5 py-3 font-['Inter',sans-serif] text-sm text-[#D0D0D0] cursor-pointer hover:bg-[#FF6B35]/25 hover:text-white transition-colors [&.is-selected]:bg-[#FF6B35] [&.is-selected]:text-white [&.is-selected]:font-semibold is-selected" data-value="planning">Planning</div>
                                <div class="gl10-select-option px-3.5 py-3 font-['Inter',sans-serif] text-sm text-[#D0D0D0] cursor-pointer hover:bg-[#FF6B35]/25 hover:text-white transition-colors [&.is-selected]:bg-[#FF6B35] [&.is-selected]:text-white [&.is-selected]:font-semibold" data-value="on_progress">On Progress</div>
                                <div class="gl10-select-option px-3.5 py-3 font-['Inter',sans-serif] text-sm text-[#D0D0D0] cursor-pointer hover:bg-[#FF6B35]/25 hover:text-white transition-colors [&.is-selected]:bg-[#FF6B35] [&.is-selected]:text-white [&.is-selected]:font-semibold" data-value="finished">Finished</div>
                                <div class="gl10-select-option px-3.5 py-3 font-['Inter',sans-serif] text-sm text-[#D0D0D0] cursor-pointer hover:bg-[#FF6B35]/25 hover:text-white transition-colors [&.is-selected]:bg-[#FF6B35] [&.is-selected]:text-white [&.is-selected]:font-semibold" data-value="dropped">Dropped</div>
                            </div>

                            <input type="hidden" name="status" id="gameStatusInput" value="planning">
                        </div>
                    </div>

                    <button type="button" id="gl10ModalSaveBtn" class="w-full h-[42px] bg-[#FF6B35] hover:bg-[#E55A27] shadow-[0_0_20px_rgba(255,107,53,0.35)] hover:shadow-[0_0_25px_rgba(255,107,53,0.5)] rounded border-0 font-['Sora',sans-serif] font-semibold text-sm text-white cursor-pointer flex items-center justify-center hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openBtn = document.getElementById('gl10OpenBtn');
        const modalBackdrop = document.getElementById('gl10ModalBackdrop');
        const closeBtn = document.getElementById('gl10ModalCloseBtn');
        const saveBtn = document.getElementById('gl10ModalSaveBtn');
        const gameTitle = @json($title);
        const storageKey = 'gemulist_added_' + encodeURIComponent(gameTitle);

        function markAsAdded() {
            if (openBtn) {
                openBtn.textContent = 'Added';
                openBtn.disabled = true;
                openBtn.classList.add('is-added');
                openBtn.setAttribute('aria-disabled', 'true');
            }
        }

        // Cek status game dari localStorage saat halaman dibuka
        if (localStorage.getItem(storageKey)) {
            markAsAdded();
        }

        function openModal() {
            if (openBtn && (openBtn.disabled || openBtn.classList.contains('is-added'))) {
                return;
            }
            if (modalBackdrop) {
                modalBackdrop.classList.add('is-active');
                modalBackdrop.setAttribute('aria-hidden', 'false');
            }
        }

        function closeModal() {
            if (modalBackdrop) {
                modalBackdrop.classList.remove('is-active');
                modalBackdrop.setAttribute('aria-hidden', 'true');
            }
        }

        if (openBtn) {
            openBtn.addEventListener('click', openModal);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        if (saveBtn) {
            saveBtn.addEventListener('click', function () {
                const hiddenInput = document.getElementById('gameStatusInput');
                const selectedStatus = hiddenInput ? hiddenInput.value : 'planning';

                // Simpan status game ke localStorage
                localStorage.setItem(storageKey, selectedStatus);

                // Ubah teks tombol menjadi Added & disabled
                markAsAdded();
                closeModal();
            });
        }

        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', function (e) {
                if (e.target === modalBackdrop || e.target.classList.contains('gl10-modal-layout')) {
                    closeModal();
                }
            });
        }

        // Custom Select Dropdown logic
        const selectWrap = document.getElementById('gl10CustomSelect');
        if (selectWrap) {
            const trigger = selectWrap.querySelector('button');
            const valueSpan = selectWrap.querySelector('.gl10-select-value');
            const options = selectWrap.querySelectorAll('.gl10-select-option');
            const hiddenInput = document.getElementById('gameStatusInput');

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = selectWrap.classList.contains('is-open');
                selectWrap.classList.toggle('is-open', !isOpen);
                trigger.setAttribute('aria-expanded', !isOpen);
            });

            options.forEach(option => {
                option.addEventListener('click', function (e) {
                    e.stopPropagation();
                    options.forEach(opt => opt.classList.remove('is-selected'));
                    option.classList.add('is-selected');

                    const selectedText = option.textContent.trim();
                    const selectedVal = option.getAttribute('data-value');

                    valueSpan.textContent = selectedText;
                    if (hiddenInput) hiddenInput.value = selectedVal;

                    selectWrap.classList.remove('is-open');
                    trigger.setAttribute('aria-expanded', 'false');
                });
            });

            document.addEventListener('click', function () {
                selectWrap.classList.remove('is-open');
                trigger.setAttribute('aria-expanded', 'false');
            });
        }
    });
</script>

</body>
</html>
