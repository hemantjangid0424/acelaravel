<script setup lang="ts">
import { usePage, Head, Link } from '@inertiajs/vue3';
import { Image, Tabs, TabPane } from 'ant-design-vue';
import { ref, computed } from 'vue';
import Layout from '../components/Layout.vue';

interface Service {
  title?: string;
  menu_name: string;
  meta_description?: string;
  canonical?: string;
  image?: string;
  description?: string;
  documents_required?: string;
  fees_and_charges?: string;
}

interface PageProps {
  name: string;
}

const page = usePage<PageProps>();
const props = defineProps<{ service: Service }>();

const activeKey = ref<number>(1);

// ✅ Core SEO values
const title = computed(() => props.service.title || props.service.menu_name);
const brand = computed(() => page.props.name || '');

const fullTitle = computed(() => `${title.value} | ${brand.value}`);


const description = computed(() =>
  props.service.meta_description || `${title.value} - ${brand.value}`
);

const canonical = computed(() => props.service.canonical || '');
</script>

<template>
  <Layout>
    <Head>
      <!-- ✅ PRIMARY SEO -->
      <title>{{ fullTitle }}</title>
      <meta name="description" :content="description" />
      <meta name="robots" content="index, follow" />
      <link rel="canonical" :href="canonical" />

      <meta property="og:type" content="website" />
      <meta property="og:title" :content="fullTitle" />
      <meta property="og:description" :content="description" />
      <meta property="og:image" v-if="service.image" :content="service.image" />
      <meta property="og:url" :content="canonical" />

      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" :content="fullTitle" />
      <meta name="twitter:description" :content="description" />
      <meta name="twitter:image" v-if="service.image" :content="service.image" />
      
    </Head>

    <!-- HERO -->
    <div class="page-hero-area _relative" style="background-image: url(/img/bg/page-bg.png)">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 m-auto text-center">
            <div class="page-hero-hadding">

              <!-- ✅ H1 -->
              <h1>{{ title }}</h1>

              <!-- ✅ Breadcrumb -->
              <div class="page-hero-p" style="margin-bottom: 20px">
                <Link href="/">Home</Link>
                <span> › </span>

                <Link href="/services">Services</Link>
                <span> › </span>

                <span>{{ service.menu_name }}</span>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="container p-5">

      <!-- CTA -->
      <Link href="/apply-now" class="theme-btn1 font-f-2" style="width: 100%">
        Apply Now
      </Link>

      <!-- IMAGE -->
      <div v-if="service.image" class="row" style="margin: 20px 0">
        <Image
          :preview="false"
          :src="service.image"
          :alt="title"
          width="100%"
          :height="500"
          style="object-fit: contain;"
        />
      </div>

      <!-- TABS -->
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
