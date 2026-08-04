<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Personal Score</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=JetBrains+Mono:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/personalScore.js'])
</head>
<body class="relative min-h-screen flex flex-col gap-7 pt-[clamp(56px,8.5vw,123px)] bg-[#141414] font-['Sora',_sans-serif] text-center overflow-x-hidden">

  <!-- Decorative glow shapes -->
  <div class="absolute -left-[350px] -top-[200px] w-[700px] h-[700px] blur-[60px] opacity-75 pointer-events-none bg-[radial-gradient(circle_at_30%_50%,rgba(255,107,53,0.6)_0%,rgba(0,0,0,0)_70%)]"></div>
  <div class="absolute -right-[300px] -top-[100px] w-[600px] h-[600px] blur-[60px] opacity-75 pointer-events-none z-[6] bg-[radial-gradient(circle_at_70%_50%,rgba(255,107,53,0.5)_0%,rgba(0,0,0,0)_70%)]"></div>
  <div class="absolute left-1/2 -translate-x-1/2 -bottom-[300px] w-[800px] h-[400px] blur-[60px] opacity-75 pointer-events-none z-[5] bg-[radial-gradient(circle_at_50%_50%,rgba(255,107,53,0.3)_0%,rgba(0,0,0,0)_70%)]"></div>

  <!-- Heading -->
  <div class="mx-auto w-[90%] max-w-[491px] flex flex-col self-center gap-3.5">
    <h1 class="text-[#FF6B35] text-[clamp(22px,3vw,48px)] font-extrabold uppercase leading-[1.1] tracking-[-0.96px]">Personal Score</h1>
    <p class="-mt-[14px] min-h-[103px] flex items-center justify-center shrink-0 text-[rgba(244,244,244,0.72)] text-[clamp(15px,1.5vw,16px)] leading-[1.75]">
      <span>View your rated games and their scores. This page only displays games with a
      <b class="text-[#FF9F1C] font-semibold">Finished </b><span class="font-['Inter']">or </span><span class="text-[#ff3c49] font-['Inter']">Dropped</span><span class="font-['Inter']"> status. </span></span>
    </p>
  </div>

  <!-- Main column -->
  <div class="relative z-[7] w-full max-w-[1560px] mx-auto px-6 pt-[30px] pb-[60px] flex flex-col items-center gap-3.5">

    <!-- Sort bar -->
    <div class="flex flex-nowrap items-center justify-center gap-x-4 gap-y-3 px-6 py-[14px] rounded-[17px] bg-[#1E1E1E] w-full max-lg:flex-wrap max-lg:px-4 max-lg:gap-x-[14px] max-lg:gap-y-2 max-[640px]:flex-col max-[640px]:items-stretch max-[640px]:gap-3 max-[640px]:-mx-6 max-[640px]:w-auto max-[640px]:rounded-none">
      <div class="flex items-center gap-1.5 shrink-0 h-[38px] max-[640px]:justify-center max-[640px]:w-full max-[640px]:flex-wrap max-[640px]:gap-2 max-[640px]:h-auto">
        <button type="button" class="sort-bar-btn sort-bar-btn1 bg-[#FF6B35] flex items-center h-[34px] px-4 text-[15px] whitespace-nowrap rounded-[10px] text-[#F4F4F4] cursor-pointer transition hover:scale-[1.05] hover:brightness-[1.15] leading-normal max-[640px]:h-[42px] max-[640px]:px-5 max-[640px]:text-[16px] max-[640px]:rounded-[12px] hover:brightness-[1.15]">All</button>
        <button type="button" class="sort-bar-btn sort-bar-btn-finished flex items-center h-[34px] px-4 text-[15px] whitespace-nowrap rounded-[10px] text-[#F4F4F4] cursor-pointer transition hover:scale-[1.05] hover:brightness-[1.15] leading-normal max-[640px]:h-[42px] max-[640px]:px-5 max-[640px]:text-[16px] max-[640px]:rounded-[12px] hover:brightness-[1.15]">Finished</button>
        <button type="button" class="sort-bar-btn sort-bar-btn-dropped flex items-center h-[34px] px-4 text-[15px] whitespace-nowrap rounded-[10px] text-[#F4F4F4] cursor-pointer transition hover:scale-[1.05] hover:brightness-[1.15] leading-normal max-[640px]:h-[42px] max-[640px]:px-5 max-[640px]:text-[16px] max-[640px]:rounded-[12px] hover:brightness-[1.15]">Dropped</button>
        <button type="button" class="sort-bar-btn sort-bar-btn-unrated flex items-center h-[34px] px-4 text-[15px] whitespace-nowrap rounded-[10px] text-[#F4F4F4] cursor-pointer transition hover:scale-[1.05] hover:brightness-[1.15] leading-normal max-[640px]:h-[42px] max-[640px]:px-5 max-[640px]:text-[16px] max-[640px]:rounded-[12px] hover:brightness-[1.15]">Unrated</button>
      </div>

      <div class="relative flex items-center flex-[1_1_240px] min-w-[160px] max-w-[420px] max-lg:flex-[1_1_100%] max-lg:max-w-full max-lg:min-w-0 max-[640px]:w-full max-[640px]:max-w-full">
        <div class="absolute left-[10px] top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none leading-none">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#F4F4F4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
        </div>
        <input type="text" class="sort-bar-search-input w-full font-['Sora'] text-[14px] text-[#F4F4F4] bg-[rgba(38,38,38,0.6)] border border-[rgba(244,244,244,0.15)] rounded-[10px] py-2 pr-3.5 pl-9 outline-none transition-colors placeholder:text-[rgba(244,244,244,0.4)] focus:border-[#FF6B35] max-[640px]:text-[16px] max-[640px]:py-3 max-[640px]:pl-[38px]" placeholder="Search games..." />
      </div>

      <p class="flex items-center shrink-0 whitespace-nowrap text-[15px] h-9 text-[#F4F4F4] max-[640px]:h-[38px]">Sort by :</p>

      <div class="sort-bar-row-right flex items-center gap-0.5 shrink-0 h-9 max-[640px]:h-[38px] max-[640px]:gap-1.5">
        <div class="sort-option bg-[#FF6B35] inline-flex items-center justify-center gap-0.5 cursor-pointer px-1.5 rounded-lg h-8 select-none transition hover:scale-[1.08] hover:bg-[rgba(255,107,53,0.15)] max-[640px]:h-[38px] max-[640px]:px-2.5" data-sort="recent">
          <img src="/assets/personalScore/sort-bar-clock.svg" class="sort-icon sort-icon-img w-5 h-5 block text-[#F4F4F4]" alt="time" />
          <span class="sort-arrow text-[#F4F4F4] text-[12px] font-bold leading-none w-2 text-center flex items-center justify-center transition-colors"></span>
        </div>
        <div class="sort-option inline-flex items-center justify-center gap-0.5 cursor-pointer px-1.5 rounded-lg h-8 select-none transition hover:scale-[1.08] hover:bg-[rgba(255,107,53,0.15)] max-[640px]:h-[38px] max-[640px]:px-2.5" data-sort="rating">
          <img src="/assets/personalScore/sort-bar-star.svg" class="sort-icon sort-icon-img w-5 h-5 block text-[#F4F4F4]" alt="star" />
          <span class="sort-arrow text-[12px] font-bold leading-none text-[rgba(244,244,244,0.3)] w-2 text-center flex items-center justify-center transition-colors"></span>
        </div>
        <div class="sort-option inline-flex items-center justify-center gap-0.5 cursor-pointer px-1.5 rounded-lg h-8 select-none transition hover:scale-[1.08] hover:bg-[rgba(255,107,53,0.15)] max-[640px]:h-[38px] max-[640px]:px-2.5" data-sort="title">
          <span class="sort-icon sort-icon-title font-['Sora'] font-bold text-[16px] text-[#F4F4F4] flex items-center justify-center">A</span>
          <span class="sort-arrow text-[12px] font-bold leading-none text-[rgba(244,244,244,0.3)] w-2 text-center flex items-center justify-center transition-colors"></span>
        </div>
      </div>
    </div>

    <!-- Cards container (JS renders cards-grid here) -->
    <div class="cards ml-px w-full max-w-[1519px] flex flex-col gap-[25px] pb-[10px]"></div>
  </div>

  <!-- Modal backdrop -->
  <div class="over-backdrop fixed inset-0 bg-[rgba(0,0,0,0.6)] z-[999] hidden"></div>

  <!-- Modal overlay -->
  <div class="over fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-[1000] backdrop-blur-[10px] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] hidden flex-col items-center gap-12 bg-[#1E1E1E] p-12 border border-[rgba(255,255,255,0.1)] rounded-lg overflow-y-auto w-[90%] max-w-[672px] max-h-[90vh] max-[640px]:p-8 max-[640px]:gap-8 max-[640px]:w-[94%] max-[480px]:p-6 max-[480px]:gap-5 max-[480px]:w-[96%] max-[480px]:rounded-md">
    <div class="absolute -top-24 -right-24 blur-[50px] w-64 h-64 bg-[rgba(255,107,53,0.1)]"></div>

    <div class="relative z-[1] w-full max-w-[950px] flex items-start justify-between text-[#F4F4F4] font-['Sora'] font-extrabold leading-[1.188] tracking-[-0.32px] text-[clamp(28px,2.5vw,32px)] max-[480px]:flex-wrap max-[480px]:gap-2.5 max-[480px]:text-[22px]">
      <h1 class="over-title text-left">
        Rate &amp; Review <span class="sub-text-light text-[#FF9F1C]">Astro Bot</span>
      </h1>
      <div class="over-btn w-[18px] shrink-0 cursor-pointer">
        <img src="/assets/personalScore/modal/over-icon.png" />
      </div>
    </div>

    <div class="relative z-[2] w-full max-w-[950px] flex flex-col gap-4 text-[#F4F4F4] font-['Sora']">
      <h2 class="over-subtitle text-[clamp(19px,2vw,20px)] font-semibold leading-[1.4] max-[480px]:text-[18px]">Select Score</h2>
      <div class="over-container flex items-center gap-[7px] text-[16px] leading-[1.5] flex-wrap justify-center max-[573px]:grid max-[573px]:grid-cols-5 max-[573px]:gap-2 max-[573px]:justify-items-center">
        <button type="button" class="over-btn-score over-btn-scores w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_5px] border-2 border-[#555555] rounded cursor-pointer transition-all hover:scale-105">1</button>
        <p class="over-text-button over-text-btn1 w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">2</p>
        <p class="over-text-button over-text-btn2 w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">3</p>
        <p class="over-text-button over-text-btn3 w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">4</p>
        <p class="over-text-button over-text-btn4 w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">5</p>
        <p class="over-text-button over-text-btn5 w-[51px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">6</p>
        <p class="over-text-button over-text-btn6 w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">7</p>
        <p class="over-text-button over-text-btn7 w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_18px_11px_12px] border-2 border-[#555555] rounded cursor-pointer transition-all">8</p>
        <button type="button" class="over-btn-score over-btn-active w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_5px] border-2 border-[#555555] rounded cursor-pointer transition-all hover:scale-105">9</button>
        <button type="button" class="over-btn-score over-btn-score1 ml-px w-[50px] min-h-[50px] flex justify-center shrink-0 p-[11px_5px] border-2 border-[#555555] rounded cursor-pointer transition-all hover:scale-105">10</button>
      </div>
    </div>

    <div class="w-full max-w-[950px] flex flex-col gap-4">
      <div class="flex items-end justify-between">
        <h2 class="input-group-review-subtitle text-[#F4F4F4] text-[20px] font-['Sora'] font-semibold leading-[1.4] text-left">Share Your Thoughts</h2>
        <p class="input-group-review-text text-[rgba(244,244,244,0.72)] text-[14px] font-['JetBrains_Mono'] font-medium leading-none tracking-[0.7px] text-left">0/180</p>
      </div>
      <textarea class="input-group-review-input min-h-[170px] shrink-0 text-[rgba(244,244,244,0.72)] text-[16px] font-['Inter'] leading-[1.5] text-left bg-[#161616] p-6 border border-[#555555] rounded resize-y placeholder:text-[rgba(244,244,244,0.4)] max-[640px]:px-4 max-[480px]:p-4 max-[480px]:min-h-[120px] max-[480px]:text-[15px]" maxlength="180" placeholder="Your review here..."></textarea>
    </div>

    <div class="mt-1.5 w-full max-w-[950px] flex items-center justify-end gap-12 pt-4 border-t border-[rgba(255,255,255,0.1)] tracking-[1.4px] max-[640px]:flex-wrap max-[640px]:gap-6 max-[640px]:justify-center max-[480px]:flex-col max-[480px]:items-stretch max-[480px]:gap-3.5 max-[480px]:pt-[14px]">
      <p class="over-text-btn8 text-[rgba(244,244,244,0.72)] text-[14px] font-['JetBrains_Mono'] font-medium leading-none text-center cursor-pointer max-[480px]:py-2">CANCEL</p>
      <button type="button" class="btn1 shadow-[0_0_20px_rgba(255,107,53,0.3)] w-[254px] flex items-center justify-center gap-2 shrink-0 text-[#F4F4F4] text-[16px] font-['Sora'] leading-[1.5] bg-[#FF6B35] py-4 px-2.5 rounded cursor-pointer hover:brightness-[1.2] max-[640px]:w-full max-[640px]:max-w-[254px] max-[480px]:max-w-none">
        <p class="btn-label2 text-center">SUBMIT REVIEW</p>
        <div class="btn-icon-container w-[19px] shrink-0">
          <img src="/assets/personalScore/modal/btn-icon.png" />
        </div>
      </button>
    </div>
  </div>

</body>
</html>
