<script setup lang="ts">
import Footer from './Footer.vue';
import Header from './Header.vue';
import MobileHeader from './MobileHeader.vue';
</script>
<template>
    <div>
        <div class="paginacontainer">
            <div class="progress-wrap">
                <svg
                    class="progress-circle svg-content"
                    width="100%"
                    height="100%"
                    viewBox="-1 -1 102 102"
                >
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                </svg>
            </div>
        </div>
        <Header />
        <MobileHeader />
        <slot />
        <Footer />
    </div>
</template>
