<script setup lang="ts">
import { ref } from 'vue';
const sidebarActive = ref(false);
const toggleSidebar = (value) => {
    sidebarActive.value = value;
};
</script>
<template>
    <div class="mobile-header mobile-header-3 d-block d-lg-none">
        <div class="container-fluid">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">
                        <a href="{{ route('any', 'index1')}}"
                            ><img
                                style="max-width: 55%"
                                src="/brand.webp"
                                alt=""
                        /></a>
                    </div>
                    <div class="mobile-nav-icon" @click="toggleSidebar(true)">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="mobile-sidebar d-block d-lg-none"
        :class="{ 'mobile-menu-active': sidebarActive }"
    >
        <div class="menu-close-logo">
            <a href="{{ route('any', 'index1')}}"
                ><img style="max-width: 55%" src="/brand.webp" alt=""
            /></a>
        </div>
        <div class="menu-close" @click="toggleSidebar(false)">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-nav">
            <li class="has-dropdown"><a href="#">Home </a></li>
            <li class="has-dropdown"><a href="#">About Us </a></li>
            <li class="has-dropdown"><a href="#">Services</a></li>
            <li class="has-dropdown"><a href="#">Air Tickets</a></li>
            <li class="has-dropdown"><a href="#">Contact Us</a></li>
            <li>
                <a
                    class="mobile-menu-button hash-nav"
                    href="{{ route('any', 'contact')}}"
                    >Apply Now</a
                >
            </li>
        </div>
    </div>
</template>
