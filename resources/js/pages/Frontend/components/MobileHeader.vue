<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
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
                        <Link href="/"
                            ><img
                                style="max-width: 55%"
                                src="/brand.webp"
                                alt=""
                        /></Link>
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
            <Link href="/"
                ><img style="max-width: 55%" src="/brand.webp" alt=""
            /></Link>
        </div>
        <div class="menu-close" @click="toggleSidebar(false)">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-nav">
            <li class="has-dropdown"><Link href="/">Home </Link></li>
            <li class="has-dropdown"><Link href="/about-us">About Us </Link></li>
            <li class="has-dropdown"><Link href="/services">Services</Link></li>
            <!-- <li class="has-dropdown"><Link href="/">Air Tickets</Link></li> -->
            <li class="has-dropdown"><Link href="/contact-us">Contact Us</Link></li>
            <li>
                <Link
                    class="mobile-menu-button hash-nav"
                    href="/apply-now"
                    >Apply Now</Link
                >
            </li>
        </div>
    </div>
</template>
