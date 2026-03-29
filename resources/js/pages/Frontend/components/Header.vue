<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
const page = usePage();
const services = computed(() => page.props.services);
</script>
<template>
    <header>
        <!-- <div class="header-top d-md-block d-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <a class="header1-call font-f-2" href="tel:+1 201 687 4255"><img src="/img/icons/phone.svg"
                                alt="">
                            +1 201 687 4255</a>
                        <a class="header1-call font-f-2" style="padding-left: 30px;"
                            :href="`mailto:${page.props.emails.info}`"><img style="margin-top: -5px;"
                                src="/img/icons/email.svg" alt="">{{page.props.emails.info}}</a>
                    </div>
                    <div class="col-lg-6 text-end">
                        <ul class="header-top-icons">
                            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="header-area header-area-all d-none d-lg-block" id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-elements _relative">
                            <div class="site-logo home1-site-logo">
                                <a href="/">
                                    <img
                                        style="max-width: 52%"
                                        src="/brand.webp"
                                        alt=""
                                    />
                                </a>
                            </div>
                            <div class="main-menu-ex main-menu-ex4">
                                <ul class="font-f-2">
                                    <li class="mega-dropdawn">
                                        <Link href="/">Home</Link>
                                    </li>
                                    <li class="mega-dropdawn">
                                        <Link href="/about-us">About Us</Link>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="#"
                                            >Services
                                            <i
                                                class="fa-solid fa-angle-down"
                                            ></i
                                        ></a>
                                        <ul
                                            class="sub-menu"
                                            style="width: 280px"
                                        >
                                            <li
                                                :key="`service_idx_${service.slug}`"
                                                v-for="service in services"
                                            >
                                                <Link
                                                    style="
                                                        text-transform: uppercase;
                                                    "
                                                    :href="`/services/details/${service.slug}`"
                                                    >{{ service.menu_name }}
                                                </Link>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="mega-dropdawn">
                                        <Link
                                            href="/services/details/air-tickets"
                                            >Air Tickets</Link
                                        >
                                    </li>
                                    <li class="mega-dropdawn">
                                        <Link href="/contact-us"
                                            >Contact Us</Link
                                        >
                                    </li>
                                </ul>
                            </div>
                            <div class="home2-header-buttons">
                                <div class="button2-all">
                                    <Link
                                        href="/apply-now"
                                        class="theme-btn1 font-f-2"
                                        >Apply Now</Link
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
