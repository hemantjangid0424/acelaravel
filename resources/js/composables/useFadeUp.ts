import { ref, onMounted, onUnmounted, type Ref } from 'vue';

interface FadeUpOptions {
    /** Distance to translate from (in px). Default: 40 */
    distance?: number;
    /** Animation duration (in ms). Default: 600 */
    duration?: number;
    /** Animation delay (in ms). Default: 0 */
    delay?: number;
    /** Easing function. Default: 'cubic-bezier(0.16, 1, 0.3, 1)' */
    easing?: string;
    /** IntersectionObserver threshold (0–1). Default: 0.15 */
    threshold?: number;
    /** Only animate once. Default: true */
    once?: boolean;
}

interface FadeUpReturn {
    /** Bind this ref to the element you want to animate: `ref="target"` */
    target: Ref<HTMLElement | null>;
    /** Whether the element is currently visible */
    isVisible: Ref<boolean>;
    /** Manually trigger the fade-up animation */
    trigger: () => void;
    /** Reset the element back to its hidden state */
    reset: () => void;
}

/**
 * useFadeUp — animate an element from below into view when it enters the viewport.
 *
 * @example
 * ```vue
 * <script setup>
 * import { useFadeUp } from '@/composables/useFadeUp'
 *
 * const { target, isVisible } = useFadeUp({ delay: 200 })
 * </script>
 *
 * <template>
 *   <div ref="target">Hello world</div>
 * </template>
 * ```
 */
export function useFadeUp(options: FadeUpOptions = {}): FadeUpReturn {
    const {
        distance = 40,
        duration = 600,
        delay = 0,
        easing = 'cubic-bezier(0.16, 1, 0.3, 1)',
        threshold = 0.15,
        once = true,
    } = options;

    const target = ref<HTMLElement | null>(null);
    const isVisible = ref(false);

    let observer: IntersectionObserver | null = null;

    function applyHiddenStyles(el: HTMLElement) {
        el.style.opacity = '0';
        el.style.transform = `translateY(${distance}px)`;
        el.style.transition = 'none';
    }

    function applyVisibleStyles(el: HTMLElement) {
        // Force reflow so the transition fires correctly after setting hidden styles
        void el.offsetHeight;
        el.style.transition = `opacity ${duration}ms ${easing} ${delay}ms, transform ${duration}ms ${easing} ${delay}ms`;
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
    }

    function trigger() {
        if (!target.value) return;
        isVisible.value = true;
        applyVisibleStyles(target.value);
    }

    function reset() {
        if (!target.value) return;
        isVisible.value = false;
        applyHiddenStyles(target.value);
    }

    onMounted(() => {
        if (!target.value) return;

        // Set initial hidden state
        applyHiddenStyles(target.value);

        observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        trigger();
                        if (once && observer) {
                            observer.unobserve(entry.target);
                        }
                    } else if (!once) {
                        reset();
                    }
                });
            },
            { threshold },
        );

        observer.observe(target.value);
    });

    onUnmounted(() => {
        observer?.disconnect();
    });

    return { target, isVisible, trigger, reset };
}
