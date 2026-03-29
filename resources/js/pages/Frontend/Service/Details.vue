<script setup lang="ts">
import { usePage, Head, Link } from '@inertiajs/vue3';
import { Image, Tabs, TabPane } from 'ant-design-vue';
import { ref } from 'vue';
import Layout from '../components/Layout.vue';

const page = usePage();
type Props = { service: object };
const activeKey = ref(1);

defineProps<Props>();
</script>
<template>
    <Layout>
        <Head>
            <title>
                {{ service.title != '' ? service.title : service.menu_name }} -
                {{ page.props.name }}
            </title>
            <meta name="description" :content="service.meta_description" />
            <meta name="robots" content="index, follow" />
            <link rel="canonical" :href="service.canonical" />
        </Head>
        <div
            class="page-hero-area _relative"
            style="background-image: url(/img/bg/page-bg.png)"
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto text-center">
                        <div class="page-hero-hadding">
                            <h1>
                                {{
                                    service.title != ''
                                        ? service.title
                                        : service.menu_name
                                }}
                                <br />
                                - {{ page.props.name }}
                            </h1>
                            <div class="space16"></div>
                            <div
                                class="page-hero-p"
                                style="margin-bottom: 20px"
                            >
                                <Link href="/">Home</Link>
                                <span
                                    ><i class="fa-solid fa-angle-right"></i
                                ></span>
                                <Link>Services</Link>
                                <span
                                    ><i class="fa-solid fa-angle-right"></i
                                ></span>
                                <p style="text-transform: uppercase">
                                    {{ service.menu_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img
                class="page-hero-element1 aniamtion-key-2"
                src="/img/shapes/page-header-element1.svg"
                alt=""
            />
            <img
                class="page-hero-element2 aniamtion-key-3"
                src="/img/shapes/page-header-element2.svg"
                alt=""
            />
            <img
                class="page-hero-element3 aniamtion-key-1"
                src="/img/shapes/page-header-element1.svg"
                alt=""
            />
            <img
                class="page-hero-element4 aniamtion-key-2"
                src="/img/shapes/page-header-element2.svg"
                alt=""
            />
        </div>
        <div>
            <div class="container p-5">
                <div class="home2-header-buttons" style="margin-bottom: 20px">
                    <div class="button2-all">
                        <Link
                            href="/apply-now"
                            style="width: 100%"
                            class="theme-btn1 font-f-2"
                            >Apply Now</Link
                        >
                    </div>
                </div>
                
                <div
                    v-if="service.image"
                    class="row"
                    style="
                        margin-bottom: 20px;
                        display: flex;
                        justify-content: space-around;
                    "
                >
                    <Image
                        :preview="false"
                        :src="service.image"
                        width="100%"
                        :height="500"
                        style="width: 100%; object-fit: contain;"
                    />
                </div>
                <Tabs v-model:activeKey="activeKey">
                    <TabPane :key="1" tab="Overview">
                        <div v-html="service.description"></div>
                    </TabPane>
                    <TabPane :key="2" tab="Documents Required">
                        <div v-html="service.documents_required"></div>
                    </TabPane>
                    <TabPane :key="3" tab="Fees & Charges">
                        <div v-html="service.fees_and_charges"></div>
                    </TabPane>
                </Tabs>
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

.ant-tabs .ant-tabs-tab + .ant-tabs-tab {
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
