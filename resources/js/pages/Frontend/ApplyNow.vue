<script setup lang="ts">
import { useForm, usePage, Link } from '@inertiajs/vue3';
import {
    Form,
    FormItem,
    Input,
    Row,
    Col,
    RadioGroup,
    Radio,
    Select,
    Button,
    DatePicker,
    Card,
    Alert,
    message,
    Result,
} from 'ant-design-vue';
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';

import Layout from './components/Layout.vue';

const RECAPTCHA_SITE_KEY = '6LdSl4wsAAAAAPaXdIEVtdrWnq-XdZd37cGTvPOc';

onMounted(() => {
    if (document.getElementById('recaptcha-script')) return;
    const script = document.createElement('script');
    script.id = 'recaptcha-script';
    script.src = `https://www.google.com/recaptcha/api.js?render=${RECAPTCHA_SITE_KEY}`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
});

onBeforeUnmount(() => {
    const badge = document.querySelector(
        '.grecaptcha-badge',
    ) as HTMLElement | null;
    if (badge) badge.style.visibility = 'hidden';
});

const formRef = ref();
const captchaError = ref(false);

const form = useForm({
    first_name: '',
    last_name: '',
    sex: '',
    email: '',
    phone: '',
    name_changed: '',
    dob: '',
    birth_city_state: '',
    service_applying_for: '',
    country_residence: '',
    state_residence: '',
    profession: '',
    work_address: '',
    marital_status: '',
    // Spouse fields
    spouse_name: '',
    spouse_profession: '',
    spouse_nationality: '',
    spouse_dob: '',
    // Parents
    father_name: '',
    mother_name: '',
    father_profession: '',
    mother_profession: '',
    father_nationality: '',
    mother_nationality: '',
    port_entry_india: '',
    port_exit_india: '',
    reference_address_india: '',
    reference_name_india: '',
    reference_phone_india: '',
    police_station_india: '',
    emergency_contact_person: '',
    emergency_contact_number: '',
    sponsor_name: '',
    sponsor_address: '',
    recaptcha_token: '',
});

const page = usePage();
const errorMsg = computed(() => page.props.flash?.error);
const successMsg = computed(() => page.props.flash?.success);
const services = computed(() => page.props.services);

// Show spouse fields only when married
const isMarried = computed(() => form.marital_status === 'married');

// When marital status changes, clear spouse fields & their errors if not married
const onMaritalStatusChange = () => {
    form.clearErrors('marital_status');
    if (form.marital_status !== 'married') {
        form.spouse_name = '';
        form.spouse_profession = '';
        form.spouse_nationality = '';
        form.spouse_dob = '';
        form.clearErrors(
            'spouse_name',
            'spouse_profession',
            'spouse_nationality',
            'spouse_dob',
        );
    }
};

const getRecaptchaToken = (): Promise<string> => {
    return new Promise((resolve, reject) => {
        if (!window.grecaptcha) {
            reject(
                new Error(
                    'reCAPTCHA not loaded yet. Please wait and try again.',
                ),
            );
            return;
        }
        window.grecaptcha.ready(() => {
            window.grecaptcha
                .execute(RECAPTCHA_SITE_KEY, { action: 'apply_now' })
                .then(resolve)
                .catch(reject);
        });
    });
};

const submit = async () => {
    captchaError.value = false;
    try {
        const token = await getRecaptchaToken();
        if (!token) {
            captchaError.value = true;
            message.error('reCAPTCHA verification failed. Please try again.');
            return;
        }
        form.recaptcha_token = token;
        form.post('/apply-now', {
            onError: () => {
                if (form.errors.recaptcha_token) {
                    captchaError.value = true;
                }
            },
        });
    } catch (err: any) {
        captchaError.value = true;
        message.error(
            err?.message ??
                'reCAPTCHA could not be loaded. Please refresh and try again.',
        );
    }
};
</script>

<template>
    <Layout>
        <div
            class="page-hero-area _relative"
            style="background-image: url(/img/bg/page-bg.png)"
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto text-center">
                        <div class="page-hero-hadding">
                            <h1>
                                Apply Now for Travel & Immigration Services in
                                USA - {{ page.props.name }}
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
                                <p>Apply Now</p>
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

        <div class="apply-container">
            <Result
                v-if="successMsg"
                status="success"
                title="Thank you for your Application!"
                sub-title="We will get back to you soon.."
            >
            </Result>
            <template v-else>
                <Alert
                    type="info"
                    show-icon
                    message="📝 Please complete the form carefully. Fields marked * are required."
                    style="margin-bottom: 30px"
                />
                <Alert
                    v-if="captchaError"
                    type="error"
                    show-icon
                    message="🤖 reCAPTCHA verification failed. Please try submitting again."
                    style="margin-bottom: 20px"
                    closable
                    @close="captchaError = false"
                />
                <Alert
                    v-if="form.errors.recaptcha_token || errorMsg"
                    type="error"
                    show-icon
                    :message="form.errors.recaptcha_token || errorMsg"
                    style="margin-bottom: 20px"
                />
                <Form
                    layout="vertical"
                    :model="form"
                    ref="formRef"
                    scrollToFirstError
                >
                    <Card title="🧑 Personal Information" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="First Name *"
                                    :validate-status="
                                        form.errors.first_name ? 'error' : ''
                                    "
                                    :help="form.errors.first_name"
                                >
                                    <Input
                                        v-model:value="form.first_name"
                                        @input="form.clearErrors('first_name')"
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Last Name *"
                                    :validate-status="
                                        form.errors.last_name ? 'error' : ''
                                    "
                                    :help="form.errors.last_name"
                                >
                                    <Input
                                        v-model:value="form.last_name"
                                        @input="form.clearErrors('last_name')"
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <FormItem
                            label="Sex *"
                            :validate-status="form.errors.sex ? 'error' : ''"
                            :help="form.errors.sex"
                        >
                            <RadioGroup
                                v-model:value="form.sex"
                                @change="form.clearErrors('sex')"
                            >
                                <Radio value="male">Male</Radio>
                                <Radio value="female">Female</Radio>
                                <Radio value="transgender">Transgender</Radio>
                            </RadioGroup>
                        </FormItem>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Email *"
                                    :validate-status="
                                        form.errors.email ? 'error' : ''
                                    "
                                    :help="form.errors.email"
                                >
                                    <Input
                                        v-model:value="form.email"
                                        @input="form.clearErrors('email')"
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Phone *"
                                    :validate-status="
                                        form.errors.phone ? 'error' : ''
                                    "
                                    :help="form.errors.phone"
                                >
                                    <Input
                                        v-model:value="form.phone"
                                        @input="form.clearErrors('phone')"
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Have you ever changed your name? *"
                                    :validate-status="
                                        form.errors.name_changed ? 'error' : ''
                                    "
                                    :help="form.errors.name_changed"
                                >
                                    <RadioGroup
                                        v-model:value="form.name_changed"
                                        @change="
                                            form.clearErrors('name_changed')
                                        "
                                    >
                                        <Radio :value="1">Yes</Radio>
                                        <Radio :value="0">No</Radio>
                                    </RadioGroup>
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Date of Birth *"
                                    :validate-status="
                                        form.errors.dob ? 'error' : ''
                                    "
                                    :help="form.errors.dob"
                                >
                                    <DatePicker
                                        style="width: 100%"
                                        v-model:value="form.dob"
                                        @change="form.clearErrors('dob')"
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="City and State of Birth *"
                                    :validate-status="
                                        form.errors.birth_city_state
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.birth_city_state"
                                >
                                    <Input
                                        v-model:value="form.birth_city_state"
                                        @input="
                                            form.clearErrors('birth_city_state')
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Service Applying For *"
                                    :validate-status="
                                        form.errors.service_applying_for
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.service_applying_for"
                                >
                                    <Select
                                        v-model:value="
                                            form.service_applying_for
                                        "
                                        @change="
                                            form.clearErrors(
                                                'service_applying_for',
                                            )
                                        "
                                    >
                                        <Select.Option
                                            v-for="service in services"
                                            :value="service.menu_name"
                                            >{{
                                                service.menu_name
                                            }}</Select.Option
                                        >
                                    </Select>
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <Card title="🏠 Residence Information" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Country of Residence *"
                                    :validate-status="
                                        form.errors.country_residence
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.country_residence"
                                >
                                    <Select
                                        v-model:value="form.country_residence"
                                        @change="
                                            form.clearErrors(
                                                'country_residence',
                                            )
                                        "
                                    >
                                        <Select.Option value="india"
                                            >India</Select.Option
                                        >
                                        <Select.Option value="usa"
                                            >USA</Select.Option
                                        >
                                    </Select>
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="State of Residence *"
                                    :validate-status="
                                        form.errors.state_residence
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.state_residence"
                                >
                                    <Input
                                        v-model:value="form.state_residence"
                                        @input="
                                            form.clearErrors('state_residence')
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Profession *"
                                    :validate-status="
                                        form.errors.profession ? 'error' : ''
                                    "
                                    :help="form.errors.profession"
                                >
                                    <Input
                                        v-model:value="form.profession"
                                        @input="form.clearErrors('profession')"
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Work Address *"
                                    :validate-status="
                                        form.errors.work_address ? 'error' : ''
                                    "
                                    :help="form.errors.work_address"
                                >
                                    <Input.TextArea
                                        rows="3"
                                        v-model:value="form.work_address"
                                        @input="
                                            form.clearErrors('work_address')
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <Card title="❤️ Marital Status" class="form-card">
                        <FormItem
                            :validate-status="
                                form.errors.marital_status ? 'error' : ''
                            "
                            :help="form.errors.marital_status"
                        >
                            <RadioGroup
                                v-model:value="form.marital_status"
                                @change="onMaritalStatusChange"
                            >
                                <Radio value="married">Married</Radio>
                                <Radio value="single">Single</Radio>
                                <Radio value="divorcee">Divorcee</Radio>
                                <Radio value="widower">Widower</Radio>
                            </RadioGroup>
                        </FormItem>

                        <!-- Spouse fields — only visible when married -->
                        <transition name="fade-slide">
                            <div v-if="isMarried">
                                <div class="spouse-section-title">
                                    💑 Spouse Information
                                </div>
                                <Row :gutter="24">
                                    <Col :span="12">
                                        <FormItem
                                            label="Spouse Name *"
                                            :validate-status="
                                                form.errors.spouse_name
                                                    ? 'error'
                                                    : ''
                                            "
                                            :help="form.errors.spouse_name"
                                        >
                                            <Input
                                                v-model:value="form.spouse_name"
                                                @input="
                                                    form.clearErrors(
                                                        'spouse_name',
                                                    )
                                                "
                                            />
                                        </FormItem>
                                    </Col>
                                    <Col :span="12">
                                        <FormItem
                                            label="Spouse Profession *"
                                            :validate-status="
                                                form.errors.spouse_profession
                                                    ? 'error'
                                                    : ''
                                            "
                                            :help="
                                                form.errors.spouse_profession
                                            "
                                        >
                                            <Input
                                                v-model:value="
                                                    form.spouse_profession
                                                "
                                                @input="
                                                    form.clearErrors(
                                                        'spouse_profession',
                                                    )
                                                "
                                            />
                                        </FormItem>
                                    </Col>
                                </Row>
                                <Row :gutter="24">
                                    <Col :span="12">
                                        <FormItem
                                            label="Spouse Nationality *"
                                            :validate-status="
                                                form.errors.spouse_nationality
                                                    ? 'error'
                                                    : ''
                                            "
                                            :help="
                                                form.errors.spouse_nationality
                                            "
                                        >
                                            <Input
                                                v-model:value="
                                                    form.spouse_nationality
                                                "
                                                @input="
                                                    form.clearErrors(
                                                        'spouse_nationality',
                                                    )
                                                "
                                            />
                                        </FormItem>
                                    </Col>
                                    <Col :span="12">
                                        <FormItem
                                            label="Spouse Date of Birth *"
                                            :validate-status="
                                                form.errors.spouse_dob
                                                    ? 'error'
                                                    : ''
                                            "
                                            :help="form.errors.spouse_dob"
                                        >
                                            <DatePicker
                                                style="width: 100%"
                                                v-model:value="form.spouse_dob"
                                                @change="
                                                    form.clearErrors(
                                                        'spouse_dob',
                                                    )
                                                "
                                            />
                                        </FormItem>
                                    </Col>
                                </Row>
                            </div>
                        </transition>
                    </Card>

                    <Card title="👨‍👩‍👧 Parents Information" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Father's Name *"
                                    :validate-status="
                                        form.errors.father_name ? 'error' : ''
                                    "
                                    :help="form.errors.father_name"
                                >
                                    <Input
                                        v-model:value="form.father_name"
                                        @input="form.clearErrors('father_name')"
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Mother's Name *"
                                    :validate-status="
                                        form.errors.mother_name ? 'error' : ''
                                    "
                                    :help="form.errors.mother_name"
                                >
                                    <Input
                                        v-model:value="form.mother_name"
                                        @input="form.clearErrors('mother_name')"
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Father's Profession *"
                                    :validate-status="
                                        form.errors.father_profession
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.father_profession"
                                >
                                    <Input
                                        v-model:value="form.father_profession"
                                        @input="
                                            form.clearErrors(
                                                'father_profession',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Mother's Profession *"
                                    :validate-status="
                                        form.errors.mother_profession
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.mother_profession"
                                >
                                    <Input
                                        v-model:value="form.mother_profession"
                                        @input="
                                            form.clearErrors(
                                                'mother_profession',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Father's Nationality *"
                                    :validate-status="
                                        form.errors.father_nationality
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.father_nationality"
                                >
                                    <Input
                                        v-model:value="form.father_nationality"
                                        @input="
                                            form.clearErrors(
                                                'father_nationality',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Mother's Nationality *"
                                    :validate-status="
                                        form.errors.mother_nationality
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.mother_nationality"
                                >
                                    <Input
                                        v-model:value="form.mother_nationality"
                                        @input="
                                            form.clearErrors(
                                                'mother_nationality',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <Card title="✈️ Travel Information" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Port of Entry in India"
                                    :validate-status="
                                        form.errors.port_entry_india
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.port_entry_india"
                                >
                                    <Input
                                        v-model:value="form.port_entry_india"
                                        @input="
                                            form.clearErrors('port_entry_india')
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Port of Exit in India"
                                    :validate-status="
                                        form.errors.port_exit_india
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.port_exit_india"
                                >
                                    <Input
                                        v-model:value="form.port_exit_india"
                                        @input="
                                            form.clearErrors('port_exit_india')
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <Card title="📍 Reference in India" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Reference Address in India"
                                    :validate-status="
                                        form.errors.reference_address_india
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.reference_address_india"
                                >
                                    <Input
                                        v-model:value="
                                            form.reference_address_india
                                        "
                                        @input="
                                            form.clearErrors(
                                                'reference_address_india',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Reference Name in India"
                                    :validate-status="
                                        form.errors.reference_name_india
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.reference_name_india"
                                >
                                    <Input
                                        v-model:value="
                                            form.reference_name_india
                                        "
                                        @input="
                                            form.clearErrors(
                                                'reference_name_india',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>

                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Reference Phone No in India"
                                    :validate-status="
                                        form.errors.reference_phone_india
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.reference_phone_india"
                                >
                                    <Input
                                        v-model:value="
                                            form.reference_phone_india
                                        "
                                        @input="
                                            form.clearErrors(
                                                'reference_phone_india',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Police Station for Address in India"
                                    :validate-status="
                                        form.errors.police_station_india
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.police_station_india"
                                >
                                    <Input
                                        v-model:value="
                                            form.police_station_india
                                        "
                                        @input="
                                            form.clearErrors(
                                                'police_station_india',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <Card title="📞 Emergency Contact" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Emergency Contact Person"
                                    :validate-status="
                                        form.errors.emergency_contact_person
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.emergency_contact_person"
                                >
                                    <Input
                                        v-model:value="
                                            form.emergency_contact_person
                                        "
                                        @input="
                                            form.clearErrors(
                                                'emergency_contact_person',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Emergency Contact Number"
                                    :validate-status="
                                        form.errors.emergency_contact_number
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.emergency_contact_number"
                                >
                                    <Input
                                        v-model:value="
                                            form.emergency_contact_number
                                        "
                                        @input="
                                            form.clearErrors(
                                                'emergency_contact_number',
                                            )
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <Card title="💰 Sponsor Details" class="form-card">
                        <Row :gutter="24">
                            <Col :span="12">
                                <FormItem
                                    label="Sponsor Name"
                                    :validate-status="
                                        form.errors.sponsor_name ? 'error' : ''
                                    "
                                    :help="form.errors.sponsor_name"
                                >
                                    <Input
                                        v-model:value="form.sponsor_name"
                                        @input="
                                            form.clearErrors('sponsor_name')
                                        "
                                    />
                                </FormItem>
                            </Col>
                            <Col :span="12">
                                <FormItem
                                    label="Sponsor Address"
                                    :validate-status="
                                        form.errors.sponsor_address
                                            ? 'error'
                                            : ''
                                    "
                                    :help="form.errors.sponsor_address"
                                >
                                    <Input
                                        v-model:value="form.sponsor_address"
                                        @input="
                                            form.clearErrors('sponsor_address')
                                        "
                                    />
                                </FormItem>
                            </Col>
                        </Row>
                    </Card>

                    <p class="recaptcha-notice">
                        This site is protected by reCAPTCHA and the Google
                        <a
                            href="https://policies.google.com/privacy"
                            target="_blank"
                            >Privacy Policy</a
                        >
                        and
                        <a
                            href="https://policies.google.com/terms"
                            target="_blank"
                            >Terms of Service</a
                        >
                        apply.
                    </p>

                    <FormItem style="margin-top: 30px">
                        <Button
                            type="primary"
                            size="large"
                            block
                            :loading="form.processing"
                            @click="submit"
                        >
                            🚀 Submit Application
                        </Button>
                    </FormItem>
                </Form>
            </template>
        </div>
    </Layout>
</template>

<style scoped>
.apply-container {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
}

.form-card {
    margin-bottom: 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
}

.recaptcha-notice {
    font-size: 12px;
    color: #888;
    text-align: center;
    margin-bottom: 10px;
}

.recaptcha-notice a {
    color: #1677ff;
    text-decoration: none;
}

/* ── Spouse section label ── */
.spouse-section-title {
    font-size: 14px;
    font-weight: 600;
    color: #555;
    margin: 16px 0 16px;
    padding: 10px 14px;
    background: #f9f0ff;
    border-left: 4px solid #722ed1;
    border-radius: 6px;
}

/* ── Smooth show/hide animation ── */
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.35s ease;
    overflow: hidden;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
    opacity: 0;
    max-height: 0;
    transform: translateY(-8px);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
    opacity: 1;
    max-height: 600px;
    transform: translateY(0);
}
</style>
<style>
.anticon.anticon-check-circle {
    color: #ffa201 !important;
}
</style>
