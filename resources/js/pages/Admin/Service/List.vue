<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Table } from 'ant-design-vue';
import { Edit } from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { create as serviceCreate } from '@/routes/services';
import { type BreadcrumbItem } from '@/types';
import GridLayout from '../Components/GridLayout.vue';

type Props = {
    services: object;
};

defineProps<Props>();

const columns = [
    { title: 'Title', dataIndex: 'menu_name', key: 'menu_name' },
    { title: 'Action', dataIndex: 'action', key: 'action' },
];

const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Home', href: '/admin/dashboard' },
    { title: 'Services' },
];

const handleCreate = () => {
    router.visit(serviceCreate().url);
};

const handleEdit = (id) => {
    router.visit(`/admin/services/${id}/edit`);
};
</script>

<template>
    <Head title="Services" />

    <AppLayout :breadcrumbs="breadcrumbItems">
        <GridLayout
            title="Services"
            createText="Create Service"
            @create="handleCreate"
        >
            <Table
                :columns="columns"
                :data-source="services"
                row-key="key"
                bordered
            >
            <template #bodyCell="{ column, record }">
                    <template v-if="column.key === 'action'">
                        <a href="javascript:void(0)" @click="handleEdit(record.id)">
                            <Edit />
                        </a>
                    </template>
                </template>
            </Table>
        </GridLayout>
    </AppLayout>
</template>
