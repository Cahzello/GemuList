<div id="confirmDialog" class="fixed inset-0 z-[1200] flex items-center justify-center p-5 opacity-0 invisible transition-all duration-200 [&.is-active]:opacity-100 [&.is-active]:visible" role="dialog" aria-modal="true" aria-label="Confirmation" aria-hidden="true">
    <div class="absolute inset-0 bg-black/70" data-confirm-backdrop></div>

    <div class="relative w-full max-w-sm bg-primary border border-secondary/40 shadow-[0_20px_40px_-10px_rgba(0,0,0,0.6)] rounded-lg overflow-hidden">
        <div class="flex flex-col items-center gap-5 p-8 text-center">
            <div class="w-12 h-12 rounded-full bg-warning/15 text-warning flex items-center justify-center">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
                    <path d="M9.5 9a2.5 2.5 0 0 1 4.9.9c0 1.6-2.4 2.1-2.4 3.1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 16.5V16.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>

            <p class="m-0 font-inter font-semibold text-base text-surface whitespace-pre-line leading-relaxed">
                Are you sure you want to logout?
            </p>

            <div class="flex items-center gap-3 w-full">
                <button
                    type="button"
                    data-confirm-no
                    class="flex-1 h-[42px] rounded bg-input border border-input-border font-sora font-semibold text-sm text-surface hover:bg-[#333333] cursor-pointer transition-all duration-200"
                >
                    No
                </button>
                <button
                    type="button"
                    data-confirm-yes
                    class="flex-1 h-[42px] rounded bg-secondary hover:bg-[#E55A27] font-sora font-semibold text-sm text-white cursor-pointer shadow-[0_0_20px_rgba(255,107,53,0.35)] transition-all duration-200"
                >
                    Yes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dialog = document.getElementById('confirmDialog');
        if (!dialog) {
            return;
        }

        let targetForm = null;

        function openConfirm() {
            dialog.classList.add('is-active');
            dialog.setAttribute('aria-hidden', 'false');
        }

        function closeConfirm() {
            dialog.classList.remove('is-active');
            dialog.setAttribute('aria-hidden', 'true');
        }

        document.querySelectorAll('[data-confirm-trigger]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                targetForm = btn.closest('form');

                document.getElementById('userDropdown')?.classList.remove('active');
                document.getElementById('mobileMenu')?.classList.remove('active');

                openConfirm();
            });
        });

        dialog.querySelector('[data-confirm-yes]')?.addEventListener('click', function () {
            closeConfirm();

            if (targetForm) {
                targetForm.submit();
            }
        });

        dialog.querySelector('[data-confirm-no]')?.addEventListener('click', closeConfirm);
        dialog.querySelector('[data-confirm-backdrop]')?.addEventListener('click', closeConfirm);
    });
</script>
