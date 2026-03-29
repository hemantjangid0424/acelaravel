<script setup lang="ts">
import Layout from '../components/Layout.vue';
</script>
<template>
  <Layout>
    
     <div class="page-hero-area _relative" style="background-image: url(/img/bg/page-bg.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto text-center">
                    <div class="page-hero-hadding">
                        <h1>Book Best Price International Air Tickets from USA - AceTravel USA</h1>
                        <div class="space16"></div>
                        <div class="page-hero-p">
                            <a href="{{ route('any', 'index1') }}">Home</a>
                            <span><i class="fa-solid fa-angle-right"></i></span>
                            <a href="{{ route('any', 'service') }}">Services</a>
                            <span><i class="fa-solid fa-angle-right"></i></span>
                            <p>Air Tickets</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img class="page-hero-element1 aniamtion-key-2" src="/img/shapes/page-header-element1.svg" alt="">
        <img class="page-hero-element2 aniamtion-key-3" src="/img/shapes/page-header-element2.svg" alt="">
        <img class="page-hero-element3 aniamtion-key-1" src="/img/shapes/page-header-element1.svg" alt="">
        <img class="page-hero-element4 aniamtion-key-2" src="/img/shapes/page-header-element2.svg" alt="">
    </div>
    <div>
        <div class="container p-5">
            <h4>Contact Us for Best Pricing on International Air Tickets!</h4>
            <p style="margin-top: 10px;">Looking for great deals on international flights? Reach out to us for the best pricing options tailored to your travel needs. Whether you’re planning a vacation, business trip, or any other journey abroad, our team is here to help you secure the most competitive rates.</p>
            <p style="margin-top: 20px;">Ways to Contact Us:</p>
            <p style="margin-top:40px;">
                <b>Email:</b>  For inquiries regarding international air tickets pricing, send us an email at <a href="mailto:info@acetravelsusa.com">info@acetravelsusa.com</a>. Our team will promptly get back to you with   personalized quotes and assistance.
                <br>
                Please mention
                <ul>
                    <li>No of Passengers</li>
                    <li>Date of Travel</li>
                    <li>Departing City</li>
                    <li>Arrival City</li>
                    <li>Class</li>
                </ul>
            </p>

            <p style="margin-top:40px;">
                <b>Phone:</b>   Prefer to speak with a travel expert directly? Give us a call at 201 687 4255. Our dedicated staff are available to discuss your travel plans and offer you the best deals on international flights.
                <br>
                <br>
                Don’t miss out on affordable fares and exclusive offers for your next international trip. Get in touch with us today to start planning your journey!
            </p>
        </div>
    </div>
  </Layout>
</template>