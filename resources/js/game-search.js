/**
 * Game Carousel - Fixed version with precise pixel-based sliding
 * Prevents card clipping by calculating exact scroll distance
 */

class GameCarousel {
    constructor(containerSelector) {
        this.container = document.querySelector(containerSelector);
        if (!this.container) return;

        this.grid = this.container.querySelector('.gl06__grid');
        this.prevBtn = this.container.querySelector('.gl06__nav-btn--prev');
        this.nextBtn = this.container.querySelector('.gl06__nav-btn--next');

        if (!this.grid) return;

        this.currentIndex = 0;
        this.gap = 20; // Must match CSS gap value
        this.init();
    }

    init() {
        this.calculateMetrics();
        this.updatePosition();
        this.updateButtonStates();
        this.attachEventListeners();

        window.addEventListener('resize', () => {
            this.calculateMetrics();
            this.updatePosition();
            this.updateButtonStates();
        });
    }

    calculateMetrics() {
        const width = window.innerWidth;
        if (width <= 640) {
            this.cardsPerView = 1;
        } else if (width <= 1024) {
            this.cardsPerView = 3;
        } else {
            this.cardsPerView = 5; // Default Desktop: 5 Card
        }

        this.totalCards = this.grid.querySelectorAll('.carousel-card').length;
        this.maxIndex = Math.ceil(this.totalCards / this.cardsPerView) - 1;

        if (this.currentIndex > this.maxIndex) {
            this.currentIndex = Math.max(0, this.maxIndex);
        }

        // Calculate exact card width from first card
        const firstCard = this.grid.querySelector('.carousel-card');
        if (firstCard) {
            this.cardWidth = firstCard.offsetWidth;
        }
    }

    attachEventListeners() {
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prev());
        }

        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.next());
        }
    }

    prev() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.updatePosition();
            this.updateButtonStates();
        }
    }

    next() {
        if (this.currentIndex < this.maxIndex) {
            this.currentIndex++;
            this.updatePosition();
            this.updateButtonStates();
        }
    }

    updatePosition() {
        // Calculate exact pixel distance: (cardWidth + gap) � cardsPerView � currentIndex
        const slideDistance = (this.cardWidth + this.gap) * this.cardsPerView * this.currentIndex;
        this.grid.style.transform = `translateX(-${slideDistance}px)`;
    }

    updateButtonStates() {
        if (!this.prevBtn || !this.nextBtn) return;

        if (this.currentIndex <= 0) {
            this.prevBtn.disabled = true;
            this.prevBtn.classList.add('disabled');
        } else {
            this.prevBtn.disabled = false;
            this.prevBtn.classList.remove('disabled');
        }

        if (this.currentIndex >= this.maxIndex) {
            this.nextBtn.disabled = true;
            this.nextBtn.classList.add('disabled');
        } else {
            this.nextBtn.disabled = false;
            this.nextBtn.classList.remove('disabled');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new GameCarousel('.gl06__trending');
});
