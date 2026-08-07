@php
    $alert = session('alert');
@endphp

@if ($alert !== null && isset($alert['message']))
    <div
        x-data="{ open: true }"
        x-show="open"
        x-transition.opacity.duration.200ms
        class="fixed inset-0 z-[1000] flex items-center justify-center p-5"
        role="dialog"
        aria-modal="true"
        aria-label="{{ $alert['type'] === 'information' ? 'Information' : 'Alert' }}"
    >
        <div class="absolute inset-0 bg-black/70" @click="open = false"></div>

        <div class="relative w-full max-w-sm bg-primary border border-secondary/40 shadow-[0_20px_40px_-10px_rgba(0,0,0,0.6)] rounded-lg overflow-hidden">
            <div class="flex flex-col items-center gap-5 p-8 text-center">
                @if (($alert['type'] ?? 'alert') === 'information')
                    <div class="w-12 h-12 rounded-full bg-success/15 text-success flex items-center justify-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 11V16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M12 8V8.25" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                @else
                    <div class="w-12 h-12 rounded-full bg-danger/15 text-danger flex items-center justify-center">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 7.5V13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M12 16.5V16.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                @endif

                <p class="m-0 font-inter font-semibold text-base text-surface whitespace-pre-line leading-relaxed">
                    {{ $alert['message'] }}
                </p>

                <button
                    type="button"
                    @click="open = false"
                    class="min-w-[120px] h-[42px] rounded bg-secondary hover:bg-[#E55A27] font-sora font-semibold text-sm text-white cursor-pointer hover:-translate-y-0.5 active:translate-y-0 shadow-[0_0_20px_rgba(255,107,53,0.35)] transition-all duration-200"
                >
                    OK
                </button>
            </div>
        </div>
    </div>
@endif
