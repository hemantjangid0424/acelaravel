<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Form, FormItem, Alert } from 'ant-design-vue';
import { ref } from 'vue';
import Layout from './components/Layout.vue';

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const formRules = {
    name: [{ required: true, message: 'Name is required', trigger: 'blur' }],
    email: [
        { required: true, message: 'Email is required', trigger: 'blur' },
        { type: 'email', message: 'Enter a valid email', trigger: 'blur' },
    ],
    message: [
        { required: true, message: 'Message is required', trigger: 'blur' },
    ],
};

const formRef = ref();

const validateField = (field: string) => {
    formRef.value?.validateFields([field]);
};

const submit = () => {
    formRef.value
        .validate()
        .then(() => {
            form.post('/contact-us');
        })
        .catch(() => { });
};
</script>

<template>
    <Layout>
        <div class="contact7" style="background-color: #f3f6f6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hadding2 contact7-hadding">
                            <span class="span">Contact Us</span>
                            <div class="space16"></div>
                            <h1>Write a Message</h1>
                            <div class="space16"></div>
                            <p>
                                Whether you have questions about our services,
                                want to book a consultation, or need visa
                                application,
                            </p>
                            <div class="space8"></div>

                            <template v-if="
                                $page.props.flash.success ||
                                $page.props.flash.error
                            ">
                                <Alert v-if="$page.props.flash.success" :message="$page.props.flash.success"
                                    type="success" show-icon />
                                <Alert v-else-if="$page.props.flash.error" :message="$page.props.flash.error"
                                    type="error" show-icon />
                            </template>

                            <Form v-else ref="formRef" :model="form" :rules="formRules" layout="vertical">
                                <div class="contact7-form">
                                    <FormItem name="name" style="margin-bottom: 0px">
                                        <div class="contact7-input">
                                            <input v-model="form.name" type="text" placeholder="Your Name"
                                                maxlength="255" @blur="validateField('name')"
                                                @input="validateField('name')" />
                                        </div>
                                    </FormItem>

                                    <FormItem name="email">
                                        <div class="contact7-input">
                                            <input v-model="form.email" type="email" placeholder="Your Email"
                                                maxlength="255" @blur="validateField('email')"
                                                @input="validateField('email')" />
                                        </div>
                                    </FormItem>

                                    <FormItem name="message">
                                        <div class="contact7-input">
                                            <textarea v-model="form.message" cols="30" rows="3"
                                                placeholder="Write a Message*" @blur="validateField('message')" @input="
                                                    validateField('message')
                                                    "></textarea>
                                        </div>
                                    </FormItem>

                                    <div class="space32"></div>
                                    <button class="theme-btn5 font-f-7" :disabled="form.processing" @click="submit">
                                        {{
                                            form.processing
                                                ? 'Sending...'
                                                : 'Claim Your Visa Journey!'
                                        }}
                                    </button>
                                </div>
                            </Form>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="/img/image/contact-page.png" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-map-page">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d49751534.609877914!2d-152.57496410000002!3d40.440017200000014!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3c378e3079ec5%3A0x88358507c7e7070c!2sAce%20Travels%20USA!5e0!3m2!1sen!2sin!4v1774635577890!5m2!1sen!2sin"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </Layout>
</template>
<style scoped>
:deep(.ant-form-item) {
    margin-bottom: 0px !important;
}
</style>
