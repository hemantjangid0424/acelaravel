<script setup lang="ts">
import { Row, Col, Button } from 'ant-design-vue';
import { TypographyTitle } from 'ant-design-vue';
import { defineProps } from 'vue';

defineProps<{
    title: string;
    createText?: string;
}>();

const emit = defineEmits(['create']);
</script>

<template>
    <!-- Header Row -->
    <Row justify="space-between" align="middle" class="mb-4">
        <Col>
            <TypographyTitle :level="2">{{ title }}</TypographyTitle>
        </Col>
        <Col v-if="createText">
            <Button type="primary" @click="$emit('create')">
                {{ createText }}
            </Button>
        </Col>
    </Row>

    <!-- Table Slot -->
    <Row>
        <Col :span="24">
            <slot />
        </Col>
    </Row>
</template>

<style scoped>
.mb-4 {
    margin-bottom: 16px;
}
</style>
