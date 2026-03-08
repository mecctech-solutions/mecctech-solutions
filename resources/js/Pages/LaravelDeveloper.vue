<script setup lang="ts">
import {Head, usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import {trans} from 'laravel-vue-i18n';
import HomeLayout from '../Layouts/HomeLayout.vue';
import HeroSection from '../Components/HeroSection.vue';
import AboutMeLaravel from '../Components/AboutMeLaravel.vue';
import Portfolio from '../Components/Portfolio.vue';
import Testimonials from '../Components/Testimonials.vue';
import Clients from '../Components/Clients.vue';
import Skills from '../Components/Skills.vue';
import ContactForm from '../Components/ContactForm.vue';

defineProps({
    portfolioItems: {
        type: Array,
        required: true,
    },
    testimonials: {
        type: Array,
        required: true,
    },
    clients: {
        type: Array,
        required: true,
    },
});

const page = usePage();
const locale = computed(() => page.props.locale);
</script>

<template>
    <Head :title="trans('laravel_developer.title')" />

    <HomeLayout>
        <HeroSection
            :label="trans('laravel_developer.hero_label')"
            :title="trans('laravel_developer.hero_title')"
            :body="trans('laravel_developer.hero_text')"
            :primary-button-text="trans('laravel_developer.cta_contact')"
            :primary-button-url="page.props.appUrl + '#contact'"
            :secondary-button-text="trans('laravel_developer.cta_tech_stack')"
            secondary-button-href="#skills"
        />
        <AboutMeLaravel />
        <Portfolio :portfolio-items="portfolioItems" />
        <Clients :clients="clients" />
        <Testimonials />
        <Skills />
        <ContactForm />
    </HomeLayout>
</template>
