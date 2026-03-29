<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Image } from 'ant-design-vue';
import Layout from '../Frontend/components/Layout.vue';
</script>
<template>
    <div>
        <Layout>
            <div class="error m-auto text-center">
                <div
                    class="error-img"
                    style="
                        display: flex;
                        justify-content: space-around;
                        margin-bottom: 20px;
                    "
                >
                    <Image
                        src="/img/image/error.png"
                        :width="500"
                        :preview="false"
                    />
                </div>
                <h1>Page not found!</h1>
                <Link href="/" class="theme-btn5" style="margin-top: 10px"
                    >Take me home</Link
                >
            </div>
        </Layout>
    </div>
</template>
