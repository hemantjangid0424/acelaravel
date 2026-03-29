<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import { message } from 'ant-design-vue';
import { Card, Form, FormItem, Input, Button, Upload, Modal, Image } from 'ant-design-vue';
import { PlusOutlined } from '@ant-design/icons-vue';

const { TextArea } = Input;
import { ref, computed } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { index as services } from '@/routes/services';
import { type BreadcrumbItem } from '@/types';

import '@vueup/vue-quill/dist/vue-quill.snow.css';


// ─── Props ───
type Service = {
    id: number;
    meta_title: string;
    meta_description: string;
    menu_name: string;
    title: string;
    description: string;
    documents_required: string;
    fees_and_charges: string;
};

const props = defineProps<{
    service?: Service; // optional — present only on edit
}>();

// ─── Mode ───
const isEdit = computed(() => !!props.service);

// ─── Breadcrumbs ───
const breadcrumbItems = computed<BreadcrumbItem[]>(() => [
    { title: 'Home', href: '/admin/dashboard' },
    { title: 'Services', href: services().url },
    { title: isEdit.value ? 'Edit' : 'Create' },
]);

// ─── Form (pre-filled when editing) ───
const form = useForm({
    image: props.service?.image ?? '',
    meta_title: props.service?.meta_title ?? '',
    meta_description: props.service?.meta_description ?? '',
    menu_name: props.service?.menu_name ?? '',
    title: props.service?.title ?? '',
    description: props.service?.description ?? '',
    documents_required: props.service?.documents_required ?? '',
    fees_and_charges: props.service?.fees_and_charges ?? '',
});

const formRef = ref();

// ─── Quill Toolbar ───
const quillToolbar = [
    [{ font: [] }],
    [{ size: ['small', false, 'large', 'huge'] }],
    [{ header: [1, 2, 3, 4, 5, 6, false] }],
    ['bold', 'italic', 'underline', 'strike'],
    [{ color: [] }, { background: [] }],
    [{ script: 'sub' }, { script: 'super' }],
    [{ list: 'ordered' }, { list: 'bullet' }, { list: 'check' }],
    [{ indent: '-1' }, { indent: '+1' }],
    [{ direction: 'rtl' }],
    [{ align: [] }],
    ['blockquote', 'code-block'],
    ['link', 'image', 'video', 'formula'],
    ['clean'],
];

// ─── Validation Rules ───
const metaTitleRules = [
    { required: true, message: 'Meta title is required.', trigger: 'blur' },
    { max: 160, message: 'Meta title must be at most 160 characters.', trigger: 'blur' },
];

const metaDescriptionRules = [
    { required: true, message: 'Meta description is required.', trigger: 'blur' },
    { max: 320, message: 'Meta description must be at most 320 characters.', trigger: 'blur' },
];

const serviceMenuNameRules = [
    { required: true, message: 'Service menu name is required.', trigger: 'blur' },
    { max: 255, message: 'Service menu name must be at most 255 characters.', trigger: 'blur' },
];

const serviceTitleRules = [
    { required: true, message: 'Service title is required.', trigger: 'blur' },
    { max: 255, message: 'Service title must be at most 255 characters.', trigger: 'blur' },
];

const serviceDescriptionRules = [
    {
        validator: (_rule: unknown, value: string) => {
            const stripped = value?.replace(/<[^>]*>/g, '').trim();
            if (!stripped) return Promise.reject('Service description is required.');
            return Promise.resolve();
        },
        trigger: 'blur',
    },
];

const quillRequiredRule = (label: string) => [
    {
        validator: (_rule: unknown, value: string) => {
            const stripped = value?.replace(/<[^>]*>/g, '').trim();
            if (!stripped) return Promise.reject(`${label} is required.`);
            return Promise.resolve();
        },
        trigger: 'blur',
    },
];

// ─── Submit (create or update) ───
const submit = () => {
    formRef.value
        .validate()
        .then(() => {
            if (isEdit.value) {
                form.transform((data) => ({ ...data, _method: 'PUT' })).post(
                    `/admin/services/${props.service!.id}`,
                    {
                        onSuccess: () => message.success('Service updated successfully'),
                        onError: () => message.error('Please fix the errors and try again.'),
                    },
                );
            } else {
                form.post('/admin/services', {
                    onSuccess: () => message.success('Service created successfully'),
                    onError: () => message.error('Please fix the errors and try again.'),
                });
            }
        })
        .catch(() => {
            message.error('Please fix all validation errors before submitting.');
        });
};

const serverError = computed(
    () => (field: string) => form.errors[field as keyof typeof form.errors],
);

const previewVisible = ref(false);
const previewImage = ref('');
const previewTitle = ref('');

const handleImageRemove = () => {
    form.image = null
}
const handleImageUpload = (File: File) => {
    form.image = File
    return false;
}

function getBase64(file: File) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

const handleImagePreview = async (file) => {
    if (!file.url && !file.preview) {
        file.preview = (await getBase64(file.originFileObj)) as string;
    }
    previewImage.value = file.url || file.preview;
    previewVisible.value = true;
    previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
};
</script>

<template>
    <Head :title="isEdit ? 'Edit Service' : 'Create Service'" />
    <Image v-if="previewVisible" :src="previewImage" />
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Form ref="formRef" layout="vertical" :model="form" @finish="submit" scroll-to-first-error>
            <Card style="margin-bottom: 10px" title="Service Details">
                <Card v-if="typeof form.image == 'string' && form.image != ''"
                    style="margin-bottom: 10px;text-align: center;">
                    <Image height="300px" width="" :src="form.image" />
                    <br />
                    <Button
                        type="primary"
                        danger
                        style="margin-top: 12px"
                        @click="handleImageRemove"
                    >
                        Remove Image
                    </Button>
                </Card>
                <Upload v-else list-type="picture-card" :max-count="1" :before-upload="handleImageUpload"
                    @preview="handleImagePreview" @remove="handleImageRemove">
                    <div v-if="!form.image">
                        <PlusOutlined />
                        <div style="margin-top: 8px">Upload</div>
                    </div>
                </Upload>
                <FormItem label="Menu name" name="menu_name" :rules="serviceMenuNameRules"
                    :validate-status="serverError('menu_name') ? 'error' : undefined" :help="serverError('menu_name')">
                    <Input v-model:value="form.menu_name" placeholder="Enter Menu name" show-count :maxlength="255" />
                </FormItem>

                <FormItem label="Service Title" name="title" :rules="serviceTitleRules"
                    :validate-status="serverError('title') ? 'error' : undefined" :help="serverError('title')">
                    <Input v-model:value="form.title" placeholder="Enter service title" show-count :maxlength="255" />
                </FormItem>

                <FormItem label="Service Description" name="description" :rules="serviceDescriptionRules"
                    :validate-status="serverError('description') ? 'error' : undefined"
                    :help="serverError('description')">
                    <QuillEditor v-model:content="form.description" content-type="html" :toolbar="quillToolbar" />
                </FormItem>
            </Card>

            <!-- ─── Meta Section ─── -->
            <Card style="margin-bottom: 10px" title="Meta Section">
                <FormItem label="Meta Title" name="meta_title" :rules="metaTitleRules"
                    :validate-status="serverError('meta_title') ? 'error' : undefined"
                    :help="serverError('meta_title')">
                    <Input v-model:value="form.meta_title" placeholder="Enter meta title (max 160 chars)" show-count
                        :maxlength="160" />
                </FormItem>

                <FormItem label="Meta Description" name="meta_description" :rules="metaDescriptionRules"
                    :validate-status="serverError('meta_description') ? 'error' : undefined"
                    :help="serverError('meta_description')">
                    <TextArea v-model:value="form.meta_description" :rows="3"
                        placeholder="Enter meta description (max 320 chars)" show-count :maxlength="320" />
                </FormItem>
            </Card>

            <!-- ─── Documents Required ─── -->
            <Card style="margin-bottom: 10px" title="Documents Required">
                <FormItem name="documents_required" :rules="quillRequiredRule('Documents required')"
                    :validate-status="serverError('documents_required') ? 'error' : undefined"
                    :help="serverError('documents_required')">
                    <QuillEditor v-model:content="form.documents_required" content-type="html"
                        :toolbar="quillToolbar" />
                </FormItem>
            </Card>

            <!-- ─── Fees & Charges ─── -->
            <Card style="margin-bottom: 10px" title="Fees & Charges">
                <FormItem name="fees_and_charges" :rules="quillRequiredRule('Fees & charges')"
                    :validate-status="serverError('fees_and_charges') ? 'error' : undefined"
                    :help="serverError('fees_and_charges')">
                    <QuillEditor v-model:content="form.fees_and_charges" content-type="html" :toolbar="quillToolbar" />
                </FormItem>
            </Card>

            <!-- ─── Submit ─── -->
            <FormItem>
                <Button type="primary" html-type="submit" :loading="form.processing">
                    {{ isEdit ? 'Update Service' : 'Create Service' }}
                </Button>
            </FormItem>
        </Form>
    </AppLayout>
</template>
<style>
.ant-upload-list-item-container,
.ant-upload-select-picture-card {
    width: 100% !important;
    height: 300px !important;
}
</style>