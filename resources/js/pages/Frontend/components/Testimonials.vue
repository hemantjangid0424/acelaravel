<template>
  <div class="testimonial1 _relative sp3">
    <div class="container">

      <div class="row">
        <div class="col-lg-6 m-auto text-center">
          <div class="hadding1">
            <span class="font-f-2">Testimonials</span>
            <div class="space16"></div>
            <h1 class="font-f-1">Your Trusted Partner for Visa Consulting</h1>
          </div>
        </div>
      </div>

      <div
        class="testimonial-wrapper"
        @mouseenter="stopAutoplay"
        @mouseleave="startAutoplay"
      >

        <div class="track-outer">
          <div
            class="track"
            :style="trackStyle"
            @transitionend="onTransitionEnd"
          >
            <!--
              4 cards always:
                index 0 → ghost prev   (hidden left)
                index 1 → visible left
                index 2 → visible right
                index 3 → ghost next   (hidden right)

              Track = 200% wide, each card = 50% of outer = 25% of track
              At rest   → translateX(-25%)  shows cards 1 & 2
              Next anim → translateX(-50%)  slides left 1 card
              Prev anim → translateX(0%)    slides right 1 card
            -->
            <div
              v-for="(item, i) in renderList"
              :key="`${item.id}-slot-${i}`"
              class="t-card"
            >
              <p class="message">"{{ item.message }}"</p>
              <div class="user">
                <div>
                  <h4>{{ item.name }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Dots — one per card -->
        <div class="dots">
          <span
            v-for="(_, i) in testimonials"
            :key="i"
            class="dot"
            :class="{ active: current === i }"
            @click="goToDot(i)"
          />
        </div>

        <!-- Nav -->
        <div class="nav-buttons">
          <button @click="go('prev')" :disabled="animating">&#8592;</button>
          <button @click="go('next')" :disabled="animating">&#8594;</button>
        </div>

      </div>
    </div>

    <img class="service1-shape aniamtion-key-2" src="/img/shapes/service1-shape.svg" alt="" />
  </div>
</template>

<script setup>
import { message } from 'ant-design-vue'
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'

/* ─── Data ──────────────────────────────────────────────── */
const testimonials = [
  {
    name: 'Shefali Soni',
    message: 'Team Visa Consulting made my dream of studying abroad a reality! From the initial consultation to the final approval, their team was incredibly supportive and knowledgeable. They guided me through every step ensuring I had all necessary documents.',
  },
  {
    name: 'Shobha Vohra',
    message: 'Best experience ever! Was assisted in getting my e-visa. Received incredible customer service and received my e-visa in less than 24 hours. Highly recommend!',
  },
  {
    name: 'Pavan Rekha',
    message: 'Extremely knowledgeable and timely. Very respectful in requesting information needed for the work to be done and communicating the updates.',
  },
  {
    name: 'Anu Sharma',
    message: 'A professional travel agency with competitive pricing. Booked my family vacation to Europe through them an no complaints. Thorough in all respect. Also got my son\'s oci done through them. Highly recommended.',
  },
  {
    name : 'Juan G Correa',
    message : 'Good service and very helpful with any issues'
  },
  {
    name : 'Mona Sarnathan',
    message : 'Ace travels handled my request very professionally They are super knowledgeable and guided me through the process for my visa and OCI needs very efficiently. I recommend Ace travels for all your travel documentation needs.'
  },
  {
    name : 'Neeraj Sharma',
    message : 'Got the best price for tickets to India, plus a huge help with my OCI card. I have to thank the entire team for expediting my OCI process and helping me reach India in time. Everyone is super nice, patient and helpful! Wishing them all the very best.'
  },
  {
    name : 'Daisy Petrov',
    message : 'They were super helpful and made planning my trip to India stress free. I would use again and highly recommended to anyone for their future travels.'
  },
  {
    name : 'Jhansi Naveena Kurma',
    message : 'Ace travels really helped me with my Indian passport renewal. I tried on my own twice and got it rejected twice. They helped me get my passport renewed and explained the process with patience. Definitely recommend Ace Travels for any visa/passport related issues/concerns.'
  }
]

/* ─── State ─────────────────────────────────────────────── */
const n         = testimonials.length
const current   = ref(0)   // index of the LEFT visible card
const animating = ref(false)
const direction = ref('next')

/* ─── Helpers ───────────────────────────────────────────── */
function wrap(i) {
  return ((i % n) + n) % n
}

/*
  Always 4 cards in the DOM:
    [prev-ghost | visible-L | visible-R | next-ghost]
*/
const renderList = computed(() => [
  testimonials[wrap(current.value - 1)],  // ghost left
  testimonials[wrap(current.value)],       // visible left  ← current
  testimonials[wrap(current.value + 1)],  // visible right
  testimonials[wrap(current.value + 2)],  // ghost right
])

/*
  Track is 200% of outer width.
  Each card = 25% of track = 50% of outer.

  translateX is % of the TRACK (not outer).
    At rest   → -25%  (ghost-left hidden, cards 1&2 visible)
    Next anim → -50%  (slide left 1 card)
    Prev anim →   0%  (slide right 1 card)
*/
const BASE     = -25   // resting position (% of track)
const STEP     = 25    // one card width   (% of track)
const txValue  = ref(BASE)

const trackStyle = computed(() => ({
  width:      '200%',
  transform:  `translateX(${txValue.value}%)`,
  transition: animating.value
    ? 'transform 0.45s cubic-bezier(0.4, 0, 0.2, 1)'
    : 'none',
}))

/* ─── Navigate ──────────────────────────────────────────── */
function go(dir) {
  if (animating.value) return
  direction.value = dir
  animating.value = true
  // Slide left (next) or right (prev) by exactly 1 card
  txValue.value = dir === 'next' ? BASE - STEP : BASE + STEP
}

function onTransitionEnd() {
  // Advance current by ±1
  current.value   = wrap(current.value + (direction.value === 'next' ? 1 : -1))
  animating.value = false
  // Snap back to rest — no transition (animating is false)
  txValue.value   = BASE
}

/* ─── Dot navigation ────────────────────────────────────── */
function goToDot(index) {
  if (animating.value || index === current.value) return
  direction.value = index > current.value ? 'next' : 'prev'
  // Position renderList so target ends up in visible-L after one step
  current.value   = wrap(index - (direction.value === 'next' ? 1 : -1))
  go(direction.value)
}

/* ─── Autoplay ──────────────────────────────────────────── */
let timer = null

function startAutoplay() {
  stopAutoplay()
  timer = setInterval(() => go('next'), 4000)
}

function stopAutoplay() {
  clearInterval(timer)
  timer = null
}

onMounted(startAutoplay)
onBeforeUnmount(stopAutoplay)
</script>

<style scoped>
.testimonial1 {
  background-color: #fffbfb;
  padding: 80px 0;
}

.testimonial-wrapper {
  margin-top: 48px;
}

/* Clips the ghost cards on both sides */
.track-outer {
  overflow: hidden;
  width: 100%;
}

/* 200% wide — 4 cards each at 25% of this = 50% of outer */
.track {
  display: flex;
  will-change: transform;
}

/* Each card = 25% of track (track=200%) = 50% of outer */
.t-card {
  flex: 0 0 25%;
  box-sizing: border-box;
  padding: 36px 28px;
  background: #fff;
  border-radius: 12px;
}

/* Gap between cards */
.t-card:nth-child(2) { margin-right: 12px; }
.t-card:nth-child(3) { margin-left: 12px; }

.google-logo {
  height: 26px;
  margin-bottom: 20px;
  display: block;
}

.message {
  font-size: 16px;
  line-height: 1.8;
  color: #555;
  margin: 0 0 28px;
}

.user {
  display: flex;
  align-items: center;
  gap: 14px;
}

.avatar {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  object-fit: cover;
  flex-shrink: 0;
}

h4 {
  margin: 0 0 2px;
  font-size: 16px;
  font-weight: 700;
  color: #111;
}

.country {
  margin: 0;
  font-size: 14px;
  color: #888;
}

/* Dots */
.dots {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: 32px;
}

.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #ddd;
  cursor: pointer;
  transition: background 0.3s, width 0.3s;
}

.dot.active {
  background: #111;
  width: 22px;
  border-radius: 4px;
}

/* Nav */
.nav-buttons {
  display: flex;
  justify-content: center;
  gap: 14px;
  margin-top: 16px;
}

.nav-buttons button {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  border: 1.5px solid #ddd;
  background: #fff;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.25s, color 0.25s, border-color 0.25s;
}

.nav-buttons button:hover:not(:disabled) {
  background: #111;
  color: #fff;
  border-color: #111;
}

.nav-buttons button:disabled {
  opacity: 0.35;
  cursor: not-allowed;
}

/* Mobile: show 1 card */
@media (max-width: 768px) {
  /* Each card = 50% of track = 100% of outer */
  .t-card {
    flex: 0 0 50%;
  }

  .t-card:nth-child(2),
  .t-card:nth-child(3) {
    margin: 0;
  }
}
</style>