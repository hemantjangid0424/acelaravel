<script setup lang="ts">
import { usePage,Link } from '@inertiajs/vue3';
import { computed } from 'vue';
const page = usePage();
const services = computed(() => page.props.services);
</script>
<template>
    <!-- Modal -->
    <div class="modal fade  modal-xl" id="staticBackdrop" 
        tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><b>PAYMENT & REFUND POLICY</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Thank you for your trust in our services.
                        Service fee Payment must be made full in advance.
                        Service fee payment is only for our services and we do not take any guarantee of time duration
                        or
                        definite approval of your Visa or any other documents applied through us.
                        All Credit Card or online payments are subject to 3% processing charges (nonrefundable).
                        Any payments made to the embassy or consulates through us will need to be dealt directly with
                        the
                        concerned Embassy/Consulate or third-party vendor (authorized to collect payments for the
                        Consulate/Embassy).
                        Embassy/Consulate payments for required services must be paid only through applicant’s personal
                        credit card or other authorized mode of payment.
                        We do not charge or collect embassy/consulate payments directly.
                        50% of the service fee will be refunded If the service is cancelled by the applicant within 24
                        hours of
                        the payment.
                        NO REFUND will be provided if service is cancelled by the applicant for any reasons after 24
                        hours of
                        the service fee payment.
                        Eligible refunds will be processed within 7 days of the request raised or service cancelled.
                        Refunds will be processed through the same mode used for the payment initially by the applicant.
                    </p>
                    <br>
                    <b>Best Wishes</b> <br>
                    <b>Ace Travels USA</b>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-area padding-top font-f-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-footer mr50 hadding2">
                        <div class="site-logo home1-site-logo">
                            <a href="#"><img src="/brand.webp" alt="" />
                            </a>
                        </div>

                        <div class="space30"></div>
                        <div class="hadding1">
                            <p class="font-f-2">
                            <div class="button2-all">
                                <a href="javascript:void(0)" type="button" class="theme-btn1 font-f-2"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Payment Policy</a>
                            </div>
                            </p>
                        </div>
                    </div>
                    <div class="space24"></div>
                    <!-- <div class="social social1">
                        <ul>
                            <li>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-brands fa-github"></i></a>
                            </li>
                        </ul>
                    </div> -->

                </div>
                <div class="col-lg col-sm-6 col-6 hadding2">
                    <div class="single-footer single-footer3">
                        <h3 class="font-f-2">
                            Explore
                        </h3>
                        <div>
                            <ul class="font-f-2">
                                <li><Link href="/"><span><i class="fa-solid fa-plane"></i></span> Home</Link></li>
                                <li><Link href="/about-us"><span><i class="fa-solid fa-plane"></i></span> About Us</Link></li>
                                <li><Link href="/contact-us"><span><i class="fa-solid fa-plane"></i></span> Contact Us</Link></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-6 hadding2">
                    <div class="single-footer single-footer3">
                        <h3 class="font-f-2">
                            Services
                        </h3>
                        <div>
                            <ul class="font-f-2">
                                <li><Link :href="`/services/details/${service.slug}`" v-for="service in services" ><span><i class="fa-solid fa-plane"></i></span> {{service.menu_name}}</Link></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 hadding2">
                    <div class="single-footer-contact single-footer">
                        <h3 class="font-f-2">
                            Get in touch
                        </h3>
                        <div class="padding-left20">
                            <div class="hadding1">
                                <p style="color: #181A1C;">1463 Finnegans Lane Ste E North Brunswick New Jersey 08902</p>
                            </div>

                            <div class="contact-icon-box2">
                                <div class="contact-icon">
                                    <img src="/img/icons/contact1-icon2.svg" alt="">
                                </div>
                                <div class="contact-icon-h">
                                    <a href="tel:+1 732 347 9222" class="font-f-2">+1 732 347 9222</a>
                                </div>
                            </div>

                            <div class="contact-icon-box2">
                                <div class="contact-icon">
                                    <img src="/img/icons/contact1-icon1.svg" alt="">
                                </div>
                                <div class="contact-icon-h">
                                    <a :href="`mailto:${page.props.emails.info}`" class="font-f-2">{{page.props.emails.info}}</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row align-items-center copyright2">
                <div class="col-lg-12 text-center hadding1">
                    <p class="font-f-2">
                        © {{ new Date().getFullYear() }} {{page.props.appName}}. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>