<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Card, CardMeta, Avatar, Row, Col } from 'ant-design-vue';
import Layout from '../components/Layout.vue';
import { router } from '@inertiajs/vue3';

type Props = { services: any };

defineProps<Props>();
</script>
<template>
    <Layout>

        <Head>

        </Head>
        <div class="page-hero-area _relative" style="background-image: url(/img/bg/page-bg.png)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto text-center">
                        <div class="page-hero-hadding">
                            <h1>
                                Services
                            </h1>
                            <div class="space16"></div>
                            <div class="page-hero-p" style="margin-bottom: 20px">
                                <Link href="/">Home</Link>
                                <span><i class="fa-solid fa-angle-right"></i></span>
                                <Link>Services</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img class="page-hero-element1 aniamtion-key-2" src="/img/shapes/page-header-element1.svg" alt="" />
            <img class="page-hero-element2 aniamtion-key-3" src="/img/shapes/page-header-element2.svg" alt="" />
            <img class="page-hero-element3 aniamtion-key-1" src="/img/shapes/page-header-element1.svg" alt="" />
            <img class="page-hero-element4 aniamtion-key-2" src="/img/shapes/page-header-element2.svg" alt="" />
        </div>
        <div>
            <div class="container p-5">
                <Row>
                    <Col :key="key" v-for="(service, key) in services" :lg="{ span: 6, offset: 2 }">
                        <Card hoverable style="margin-bottom: 20px;cursor: pointer;"
                            @click="router.visit(`/services/details/${service.slug}`)">
                            <template #cover >
                                <img v-if="service.image" :alt="service.menu_name" :src="service.image" />
                                <img v-else src="https://placehold.co/600x400?text=No+Image" :alt="service.menu_name">
                            </template>
                            <CardMeta :title="service.menu_name">
                            </CardMeta>
                        </Card>
                    </Col>
                </Row>
            </div>
        </div>
    </Layout>
</template>
<style>
.ant-tabs-tab {
    padding: 10px 20px !important;
    border-radius: 20px !important;
}

.ant-tabs-tab:hover,
.ant-tabs-tab div:hover {
    color: #ffa201 !important;
}

.ant-tabs-tab.ant-tabs-tab-active {
    background-color: #ffa201 !important;
    border: unset !important;
}

.ant-tabs-tab.ant-tabs-tab-active div {
    color: white !important;
}

.ant-tabs-ink-bar {
    background-color: unset !important;
}

.ant-tabs-nav::before {
    border-bottom: none !important;
}

.ant-tabs .ant-tabs-tab+.ant-tabs-tab {
    margin: 0 0 0 12px !important;
}
</style>
<style scoped>
/* For demo */
:deep(.slick-slide) {
    text-align: center;
    line-height: 160px;
    background: #364d79;
    overflow: hidden;
}

:deep(.slick-arrow.custom-slick-arrow) {
    width: 25px;
    height: 25px;
    font-size: 25px;
    color: #fff;
    background-color: rgba(31, 45, 61, 0.11);
    transition: ease all 0.3s;
    opacity: 0.3;
    z-index: 1;
}

:deep(.slick-arrow.custom-slick-arrow:before) {
    display: none;
}

:deep(.slick-arrow.custom-slick-arrow:hover) {
    color: #fff;
    opacity: 0.5;
}

:deep(.slick-slide h3) {
    color: #fff;
}
</style>
