<template>
    <div class="carousel-wrapper">
        <div class="carousel-track">
            <!-- All slides live in the DOM at once; CSS opacity fades between them -->
            <div
                v-for="(slide, i) in slides"
                :key="i"
                class="slide"
                :class="{ 'slide--active': i === currentIndex }"
                :style="{ backgroundImage: `url(${slide.image})` }"
            >
                <div class="overlay" />

                <div class="slide-content">
                    <p class="eyebrow">
                        <span class="accent-bar" />
                        {{ slide.eyebrow }}
                    </p>
                    <h1 class="headline">{{ slide.headline }}</h1>
                    <p class="description">{{ slide.description }}</p>
                    <button class="cta-btn" @click="handleCta(slide)">
                        {{ slide.ctaLabel }}
                        <span class="btn-arrow">→</span>
                    </button>
                </div>
            </div>

            <!-- Nav arrows sit above all slides -->
            <div class="nav-arrows">
                <button class="nav-btn" @click="prev" aria-label="Previous">
                    ←
                </button>
                <button class="nav-btn" @click="next" aria-label="Next">
                    →
                </button>
            </div>

            <!-- Dot indicators -->
            <div class="indicators">
                <button
                    v-for="(slide, i) in slides"
                    :key="i"
                    class="dot"
                    :class="{ active: i === currentIndex }"
                    @click="goTo(i)"
                    :aria-label="`Go to slide ${i + 1}`"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'HeroCarousel',

    data() {
        return {
            currentIndex: 0,
            autoplayInterval: null,
            slides: [
                {
                    eyebrow: "It's all about you",
                    headline:
                        "North America's Premier Streamlined. OCI. VISA, Passport services. Fast Easy Convenient",
                    description:
                        'We simplify the complex process of obtaining OCI cards, VISAs, and passport renewals so you can focus on what matters — your journey.',
                    ctaLabel: 'More About Us',
                    ctaLink: '#about',
                    image: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=1600&q=80',
                },
                {
                    eyebrow: 'Trusted by thousands',
                    headline:
                        'Hassle-Free OCI Card Applications. Handled with Care.',
                    description:
                        'Our expert team manages every step of your OCI application — from document verification to final submission — with precision and speed.',
                    ctaLabel: 'Apply for OCI',
                    ctaLink: '#oci',
                    image: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1600&q=80',
                },
                {
                    eyebrow: 'Fast turnaround',
                    headline: 'VISA Services That Keep Up With Your Schedule.',
                    description:
                        "Whether it's a tourist visa, business visa, or transit visa — we deliver fast, accurate processing so your plans never get delayed.",
                    ctaLabel: 'Explore VISA Services',
                    ctaLink: '#visa',
                    image: 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600&q=80',
                },
                {
                    eyebrow: 'Nationwide coverage',
                    headline:
                        'Passport Renewal & New Applications Made Simple.',
                    description:
                        'Skip the lines and confusion. Our streamlined passport service ensures your documents are prepared correctly the first time, every time.',
                    ctaLabel: 'Renew Your Passport',
                    ctaLink: '#passport',
                    image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1600&q=80',
                },
                {
                    eyebrow: 'Trusted by thousands',
                    headline:
                        'Hassle-Free OCI Card Applications. Handled with Care.',
                    description:
                        'Our expert team manages every step of your OCI application — from document verification to final submission — with precision and speed.',
                    ctaLabel: 'Apply for OCI',
                    ctaLink: '#oci',
                    image: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1600&q=80',
                },
            ],
        };
    },

    mounted() {
        this.startAutoplay();
    },

    beforeUnmount() {
        this.stopAutoplay();
    },

    methods: {
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
            this.resetAutoplay();
        },
        prev() {
            this.currentIndex =
                (this.currentIndex - 1 + this.slides.length) %
                this.slides.length;
            this.resetAutoplay();
        },
        goTo(i) {
            this.currentIndex = i;
            this.resetAutoplay();
        },
        handleCta(slide) {
            this.$emit('cta-clicked', slide);
        },
        startAutoplay() {
            this.autoplayInterval = setInterval(this.next, 6000);
        },
        stopAutoplay() {
            clearInterval(this.autoplayInterval);
        },
        resetAutoplay() {
            this.stopAutoplay();
            this.startAutoplay();
        },
    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.carousel-wrapper {
    width: 100%;
    font-family: 'Barlow', sans-serif;
}

/* Fixed-height container — all slides stack inside it */
.carousel-track {
    position: relative;
    width: 100%;
    height: 620px;
    overflow: hidden;
}

/* Every slide is absolute, filling the track */
.slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;

    /* Start invisible and non-interactive */
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.7s ease;
}

/* Only the active slide is visible */
.slide--active {
    opacity: 1;
    pointer-events: auto;
}

/* Dark gradient overlay */
.overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(15, 12, 8, 0.92) 0%,
        rgba(15, 12, 8, 0.72) 55%,
        rgba(15, 12, 8, 0.2) 100%
    );
}

/* ── Content ── */
.slide-content {
    position: relative;
    z-index: 2;
    max-width: 680px;
    padding: 80px;
}

.eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.85rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: white !important;

    margin-bottom: 18px;
}

.accent-bar {
    display: inline-block;
    width: 3px;
    height: 18px;
    background: #f5a623;
    border-radius: 2px;
    flex-shrink: 0;
}

.headline {
    font-family: 'Barlow Condensed', sans-serif;
    font-size: clamp(2.2rem, 4.5vw, 3.8rem);
    font-weight: 800;
    line-height: 1.05;
    color: #ffffff;
    margin-bottom: 22px;
    letter-spacing: -0.01em;
}

.description {
    font-size: 1rem;
    line-height: 1.7;
    color: #c9c0b3;
    margin-bottom: 36px;
    max-width: 520px;
}

/* ── CTA Button ── */
.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 14px;
    padding: 16px 48px 16px 36px;
    background: #f5a623;
    color: #111;
    font-family: 'Barlow', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    clip-path: polygon(
        0 0,
        calc(100% - 12px) 0,
        100% 50%,
        calc(100% - 12px) 100%,
        0 100%
    );
    transition:
        background 0.2s ease,
        transform 0.15s ease,
        box-shadow 0.2s ease;
}

.cta-btn:hover {
    background: #ffba45;
    transform: translateX(4px);
    box-shadow: -6px 0 20px rgba(245, 166, 35, 0.35);
}

.btn-arrow {
    font-size: 1.1rem;
    transition: transform 0.2s ease;
}

.cta-btn:hover .btn-arrow {
    transform: translateX(4px);
}

/* ── Navigation Arrows ── */
.nav-arrows {
    position: absolute;
    right: 48px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.nav-btn {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: 1.5px solid rgba(255, 255, 255, 0.35);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(6px);
    color: #fff;
    font-size: 1.1rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition:
        background 0.2s,
        border-color 0.2s,
        transform 0.15s;
}

.nav-btn:hover {
    background: #f5a623;
    border-color: #f5a623;
    color: #111;
    transform: scale(1.08);
}

/* ── Dot Indicators ── */
.indicators {
    position: absolute;
    bottom: 28px;
    left: 80px;
    z-index: 10;
    display: flex;
    gap: 10px;
}

.dot {
    width: 28px;
    height: 3px;
    border-radius: 2px;
    border: none;
    background: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    padding: 0;
    transition:
        background 0.3s,
        width 0.3s;
}

.dot.active {
    background: #f5a623;
    width: 48px;
}

/* ── Responsive ── */
@media (max-width: 768px) {
    .carousel-track {
        height: 520px;
    }

    .slide-content {
        padding: 60px 28px;
    }

    .nav-arrows {
        right: 20px;
        top: auto;
        bottom: 60px;
        transform: none;
        flex-direction: row;
    }

    .indicators {
        left: 28px;
    }
}
</style>
