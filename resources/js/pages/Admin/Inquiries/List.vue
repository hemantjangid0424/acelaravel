<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { Table, Modal, Descriptions, DescriptionsItem, Tag, Divider,Button } from 'ant-design-vue';
import { Eye } from 'lucide-vue-next';
import { computed, reactive } from 'vue';

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import GridLayout from '../Components/GridLayout.vue';


type Inquiry = {
    id: number;
    first_name: string;
    last_name: string;
    sex: string;
    email: string;
    phone: string;
    name_changed: boolean;
    dob: string;
    birth_city_state: string;
    service_applying_for: number | string;
    country_residence: string;
    state_residence: string;
    profession: string;
    work_address: string;
    marital_status: string;
    father_name: string;
    father_profession: string;
    father_nationality: string;
    mother_name: string;
    mother_profession: string;
    mother_nationality: string;
    spouse_name: string | null;
    spouse_profession: string | null;
    spouse_nationality: string | null;
    spouse_dob: string | null;
    port_entry_india: string | null;
    port_exit_india: string | null;
    reference_address_india: string | null;
    reference_name_india: string | null;
    reference_phone_india: string | null;
    police_station_india: string | null;
    emergency_contact_person: string | null;
    emergency_contact_number: string | null;
    sponsor_name: string | null;
    sponsor_address: string | null;
    status: string;
    created_at: string;
};

type Props = {
    inquiries: {
        data: Inquiry[];
        current_page: number;
        per_page: number;
        total: number;
    };
};

const props = defineProps<Props>();

const columns = [
    { title: 'First Name', dataIndex: 'first_name', key: 'first_name' },
    { title: 'Last Name', dataIndex: 'last_name', key: 'last_name' },
    { title: 'Service Applied For', dataIndex: 'service_applying_for', key: 'service_applying_for' },
    { title: 'Email', dataIndex: 'email', key: 'email' },
    { title: 'Phone', dataIndex: 'phone', key: 'phone' },
    { title: 'Action', dataIndex: 'action', key: 'action',width: '100px' },
];

const paginationConfig = computed(() => ({
    current: props.inquiries.current_page,
    pageSize: props.inquiries.per_page,
    total: props.inquiries.total,
    showSizeChanger: true,
    onChange: (page: number, pageSize: number) => {
        router.get('/admin/inquiries', { page, per_page: pageSize }, {
            preserveState: true,
            preserveScroll: true,
        });
    },
}));

const breadcrumbItems: BreadcrumbItem[] = [
    { title: 'Home', href: '/admin/dashboard' },
    { title: 'Inquiries' },
];

const viewModal = reactive<{ visible: boolean; data: Inquiry | null }>({
    visible: false,
    data: null,
});

const viewApplication = (record: Inquiry) => {
    viewModal.data = record;
    viewModal.visible = true;
};

const formatDate = (dateStr: string | null) => {
    if (!dateStr) return '—';
    return new Date(dateStr).toLocaleDateString('en-US', {
        year: 'numeric', month: 'long', day: 'numeric',
    });
};

const formatBoolean = (val: boolean | null) => {
    if (val === null || val === undefined) return '—';
    return val ? 'Yes' : 'No';
};

const printInquiry = () => {
    if (!viewModal.data) return;
    const d = viewModal.data;

    const val = (v: string | number | boolean | null | undefined, capitalize = false) => {
        if (v === null || v === undefined || v === '') return '<span style="color:#aaa;">—</span>';
        if (typeof v === 'boolean') return v ? 'Yes' : 'No';
        const str = String(v);
        return capitalize ? str.charAt(0).toUpperCase() + str.slice(1) : str;
    };

    const section = (icon: string, title: string, rows: [string, string, string?, string?][]) => {
        const cells = rows.map(([label1, value1, label2, value2]) => {
            if (label2 !== undefined) {
                return `<tr><th>${label1}</th><td>${value1}</td><th>${label2}</th><td>${value2}</td></tr>`;
            }
            return `<tr><th colspan="1">${label1}</th><td colspan="3">${value1}</td></tr>`;
        }).join('');

        return `
            <div class="section">
                <div class="section-title">${icon} ${title}</div>
                <table>
                    <tbody>${cells}</tbody>
                </table>
            </div>
        `;
    };

    const html = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Inquiry Details — ${d.first_name} ${d.last_name}</title>
            <style>
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    color: #222;
                    padding: 28px 32px;
                    line-height: 1.5;
                }
                .header { margin-bottom: 20px; border-bottom: 2px solid #333; padding-bottom: 12px; }
                .header h1 { font-size: 20px; margin-bottom: 6px; }
                .header .meta { font-size: 11px; color: #666; margin-top: 4px; }
                .status-badge {
                    display: inline-block;
                    padding: 2px 12px;
                    border-radius: 12px;
                    font-size: 11px;
                    font-weight: 700;
                    text-transform: capitalize;
                }
                .section { margin-bottom: 18px; page-break-inside: avoid; }
                .section-title {
                    font-size: 12px;
                    font-weight: 700;
                    color: #444;
                    background: #f0f0f0;
                    padding: 5px 10px;
                    margin-bottom: 0;
                    border: 1px solid #ddd;
                    border-bottom: none;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 6px 10px;
                    vertical-align: top;
                    word-break: break-word;
                    overflow-wrap: break-word;
                }
                th {
                    background: #fafafa;
                    font-weight: 600;
                    width: 22%;
                    color: #555;
                    white-space: nowrap;
                }
                td {
                    width: 28%;
                }
                @page { margin: 15mm; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Inquiry Details</h1>
                <span class="status-badge">${d.status}</span>
                <div class="meta">Submitted: ${formatDate(d.created_at)} &nbsp;|&nbsp; ID: #${d.id}</div>
            </div>

            ${section('👤', 'Personal Information', [
                ['First Name',          val(d.first_name),          'Last Name',            val(d.last_name)],
                ['Sex',                 val(d.sex, true),           'Date of Birth',        val(formatDate(d.dob))],
                ['Email',               val(d.email),               'Phone',                val(d.phone)],
                ['Name Ever Changed',   val(d.name_changed),        'City & State of Birth',val(d.birth_city_state)],
                ['Service Applying For',val(d.service_applying_for, true), '', ''],
            ])}

            ${section('🏠', 'Residence Information', [
                ['Country of Residence', val(d.country_residence, true), 'State of Residence', val(d.state_residence, true)],
                ['Profession',           val(d.profession),              'Work Address',        val(d.work_address)],
            ])}

            ${section('❤️', 'Marital Status', [
                ['Marital Status',      val(d.marital_status, true), 'Spouse Name',          val(d.spouse_name)],
                ['Spouse Profession',   val(d.spouse_profession),    'Spouse Nationality',   val(d.spouse_nationality)],
                ['Spouse Date of Birth',val(formatDate(d.spouse_dob)), '', ''],
            ])}

            ${section('👨‍👩‍👧', 'Parents Information', [
                ["Father's Name",        val(d.father_name),        "Mother's Name",        val(d.mother_name)],
                ["Father's Profession",  val(d.father_profession),  "Mother's Profession",  val(d.mother_profession)],
                ["Father's Nationality", val(d.father_nationality), "Mother's Nationality", val(d.mother_nationality)],
            ])}

            ${section('✈️', 'Travel Information', [
                ['Port of Entry in India', val(d.port_entry_india), 'Port of Exit in India', val(d.port_exit_india)],
            ])}

            ${section('📍', 'Reference in India', [
                ['Reference Name',    val(d.reference_name_india),    'Reference Phone',   val(d.reference_phone_india)],
                ['Reference Address', val(d.reference_address_india), 'Police Station',    val(d.police_station_india)],
            ])}

            ${section('🚨', 'Emergency Contact', [
                ['Contact Person', val(d.emergency_contact_person), 'Contact Number', val(d.emergency_contact_number)],
            ])}

            ${section('💼', 'Sponsor Details', [
                ['Sponsor Name', val(d.sponsor_name), 'Sponsor Address', val(d.sponsor_address)],
            ])}
        </body>
        </html>
    `;

    const printWindow = window.open('', '_blank', 'width=960,height=800');
    if (!printWindow) return;
    printWindow.document.write(html);
    printWindow.document.close();
    printWindow.focus();
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 400);
};

</script>

<template>
    <Head title="Inquiries" />

    <Modal
        :open="viewModal.visible"
        title="Inquiry Details"
        width="1000px"
        @cancel="viewModal.visible = false"
    >
        <template #footer>
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <Button type="primary" @click="printInquiry">
                    Print
                </Button>
            </div>
        </template>
        <template v-if="viewModal.data">
            <div class="modal-body">
              <div id="inquiry-print-area">

                <!-- Status Badge -->
                <div style="margin-bottom: 16px;">
                    <span style="color: #999; font-size: 12px; margin-left: 8px;">
                        Submitted: {{ formatDate(viewModal.data.created_at) }}
                    </span>
                </div>

                <!-- Personal Information -->
                <Divider orientation="left">👤 Personal Information</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="First Name">{{ viewModal.data.first_name || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Last Name">{{ viewModal.data.last_name || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Sex" style="text-transform: capitalize;">{{ viewModal.data.sex || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Date of Birth">{{ formatDate(viewModal.data.dob) }}</DescriptionsItem>
                    <DescriptionsItem label="Email">{{ viewModal.data.email || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Phone">{{ viewModal.data.phone || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Name Ever Changed">{{ formatBoolean(viewModal.data.name_changed) }}</DescriptionsItem>
                    <DescriptionsItem label="City & State of Birth">{{ viewModal.data.birth_city_state || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Service Applying For" :span="2">{{ viewModal.data.service_applying_for || '—' }}</DescriptionsItem>
                </Descriptions>

                <!-- Residence Information -->
                <Divider orientation="left">🏠 Residence Information</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Country of Residence">{{ viewModal.data.country_residence || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="State of Residence">{{ viewModal.data.state_residence || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Profession">{{ viewModal.data.profession || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Work Address">{{ viewModal.data.work_address || '—' }}</DescriptionsItem>
                </Descriptions>

                <!-- Marital Status -->
                <Divider orientation="left">❤️ Marital Status</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Marital Status" style="text-transform: capitalize;">{{ viewModal.data.marital_status || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Spouse Name">{{ viewModal.data.spouse_name || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Spouse Profession">{{ viewModal.data.spouse_profession || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Spouse Nationality">{{ viewModal.data.spouse_nationality || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Spouse Date of Birth" :span="2">{{ formatDate(viewModal.data.spouse_dob) }}</DescriptionsItem>
                </Descriptions>

                <!-- Parents Information -->
                <Divider orientation="left">👨‍👩‍👧 Parents Information</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Father's Name">{{ viewModal.data.father_name || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Mother's Name">{{ viewModal.data.mother_name || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Father's Profession">{{ viewModal.data.father_profession || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Mother's Profession">{{ viewModal.data.mother_profession || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Father's Nationality">{{ viewModal.data.father_nationality || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Mother's Nationality">{{ viewModal.data.mother_nationality || '—' }}</DescriptionsItem>
                </Descriptions>

                <!-- Travel Information -->
                <Divider orientation="left">✈️ Travel Information</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Port of Entry in India">{{ viewModal.data.port_entry_india || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Port of Exit in India">{{ viewModal.data.port_exit_india || '—' }}</DescriptionsItem>
                </Descriptions>

                <!-- Reference in India -->
                <Divider orientation="left">📍 Reference in India</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Reference Name">{{ viewModal.data.reference_name_india || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Reference Phone">{{ viewModal.data.reference_phone_india || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Reference Address" :span="2">{{ viewModal.data.reference_address_india || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Police Station" :span="2">{{ viewModal.data.police_station_india || '—' }}</DescriptionsItem>
                </Descriptions>

                <!-- Emergency Contact -->
                <Divider orientation="left">🚨 Emergency Contact</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Contact Person">{{ viewModal.data.emergency_contact_person || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Contact Number">{{ viewModal.data.emergency_contact_number || '—' }}</DescriptionsItem>
                </Descriptions>

                <!-- Sponsor Details -->
                <Divider orientation="left">💼 Sponsor Details</Divider>
                <Descriptions bordered :column="2" size="small">
                    <DescriptionsItem label="Sponsor Name">{{ viewModal.data.sponsor_name || '—' }}</DescriptionsItem>
                    <DescriptionsItem label="Sponsor Address">{{ viewModal.data.sponsor_address || '—' }}</DescriptionsItem>
                </Descriptions>

              </div><!-- end #inquiry-print-area -->
            </div>
        </template>
    </Modal>

    <AppLayout :breadcrumbs="breadcrumbItems">
        <GridLayout title="Inquiries">
            <Table
                :columns="columns"
                :data-source="props.inquiries.data"
                :pagination="paginationConfig"
                row-key="id"
                bordered
            >
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

<style scoped>
.modal-body {
    max-height: 75vh;
    overflow-y: auto;
    padding-right: 8px;
}
</style>