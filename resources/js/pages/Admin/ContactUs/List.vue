<script setup lang="ts">
import { Head, router} from '@inertiajs/vue3';
import { Table, Modal, Descriptions, DescriptionsItem, Tag } from 'ant-design-vue';
import { Eye } from 'lucide-vue-next';
import { reactive,computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import GridLayout from '../Components/GridLayout.vue';

type Contact = {
    key: string | number;
    name: string;
    email: string;
    message?: string;
    phone?: string;
    subject?: string;
    created_at?: string;
    [key: string]: any;
};

type Props = {
    contacts: Contact[];
    current_page: number;
    per_page: number;
    total: number;
};

const props = defineProps<Props>();

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name'
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email'
    },
    {
        title: 'Action',
        dataIndex: 'action',
        key: 'action',
        width: '100px'
    },
];

const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Home', href: '/admin/dashboard' },
    { title: 'Contacts' },
];

const viewModal = reactive<{ visible: boolean; data: Contact | null }>({
    visible: false,
    data: null,
});

const viewApplication = (record: Contact) => {
    viewModal.data = record;
    viewModal.visible = true;
};
const paginationConfig = computed(() => ({
    current: props.contacts.current_page,
    pageSize: props.contacts.per_page,
    total: props.contacts.total,
    showSizeChanger: true,
    onChange: (page: number, pageSize: number) => {
        router.get('/admin/contacts', { page, per_page: pageSize }, {
            preserveState: true,
            preserveScroll: true,
        });
    },
}));
</script>

<template>
    <Head title="Contact Us" />

    <!-- Detail Modal -->
    <Modal
        :open="viewModal.visible"
        title="Message Details"
        width="700px"
        :footer="null"
        @cancel="viewModal.visible = false"
    >
        <template v-if="viewModal.data">
            <Descriptions
                bordered
                :column="1"
                size="middle"
                layout="horizontal"
            >
                <DescriptionsItem label="Name">
                    {{ viewModal.data.name }}
                </DescriptionsItem>

                <DescriptionsItem label="Email">
                    <a :href="`mailto:${viewModal.data.email}`">
                        {{ viewModal.data.email }}
                    </a>
                </DescriptionsItem>

                <DescriptionsItem v-if="viewModal.data.phone" label="Phone">
                    {{ viewModal.data.phone }}
                </DescriptionsItem>

                <DescriptionsItem v-if="viewModal.data.subject" label="Subject">
                    {{ viewModal.data.subject }}
                </DescriptionsItem>

                <DescriptionsItem v-if="viewModal.data.message" label="Message">
                    <div style="white-space: pre-wrap;">{{ viewModal.data.message }}</div>
                </DescriptionsItem>

                <DescriptionsItem v-if="viewModal.data.created_at" label="Received At">
                    {{ viewModal.data.created_at }}
                </DescriptionsItem>
            </Descriptions>
        </template>
    </Modal>

    <AppLayout :breadcrumbs="breadcrumbItems">
        <GridLayout title="Contact Us">
            <Table :columns="columns" :data-source="props.contacts.data" bordered :pagination="paginationConfig" row-key="id">
                <template #bodyCell="{ column, record }">
                    <template v-if="column.key === 'action'">
                        <a href="javascript:void(0)" @click="viewApplication(record)">
                            <Eye />
                        </a>
                    </template>
                </template>
            </Table>
        </GridLayout>
    </AppLayout>
</template>