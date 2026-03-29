<template>
  <div class="carousel-wrapper">
    <div class="carousel-track">
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

      <!-- Arrows -->
      <div class="nav-arrows">
        <button class="nav-btn" @click="prev">←</button>
        <button class="nav-btn" @click="next">→</button>
      </div>

      <!-- Dots -->
      <div class="indicators">
        <button
          v-for="(slide, i) in slides"
          :key="i"
          class="dot"
          :class="{ active: i === currentIndex }"
          @click="goTo(i)"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { router } from '@inertiajs/vue3'
// state
const currentIndex = ref(0)
const slides = ref([])
let autoplayInterval = null

// methods
const next = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.value.length
  resetAutoplay()
}

const prev = () => {
  currentIndex.value =
    (currentIndex.value - 1 + slides.value.length) % slides.value.length
  resetAutoplay()
}

const goTo = (i) => {
  currentIndex.value = i
  resetAutoplay()
}

const handleCta = () => {
  router.visit('/about-us')
}

const startAutoplay = () => {
  autoplayInterval = setInterval(next, 6000)
}

const stopAutoplay = () => {
  clearInterval(autoplayInterval)
}

const resetAutoplay = () => {
  stopAutoplay()
  startAutoplay()
}

// lifecycle
onMounted(() => {
  const images = [
    '/img/home/slideimage1.webp',
    '/img/home/slideimage2.webp',
    '/img/home/slideimage3.webp',
    '/img/home/slideimage4.webp',
    '/img/home/slideimage5.webp',
    '/img/home/slideimage6.webp',
  ]

  slides.value = images.map((img) => ({
    eyebrow: "It's all about you",
    headline:
      'North America’s Premier Streamlined OCI, VISA, Passport services',
    description: 'Fast, Easy, Convenient',
    ctaLabel: 'More About Us',
    ctaLink: '#about',
    image: img,
  }))

  startAutoplay()
})

onBeforeUnmount(() => {
  stopAutoplay()
})
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
