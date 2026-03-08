<script setup lang="ts">
import {Head, usePage} from '@inertiajs/vue3';
import {trans} from 'laravel-vue-i18n';
import HomeLayout from "../Layouts/HomeLayout.vue";
import HeroSection from "../Components/HeroSection.vue";
import AboutMe from "../Components/AboutMe.vue";
import Skills from "../Components/Skills.vue";
import Portfolio from "../Components/Portfolio.vue";
import Testimonials from "../Components/Testimonials.vue";
import Clients from "../Components/Clients.vue";
import ContactForm from "../Components/ContactForm.vue";

const page = usePage();

const props = defineProps({
    portfolioItems: {
        type: Object,
        required: true
    },
    testimonials: {
        type: Array,
        required: true
    },
    clients: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <Head title="Home" />

    <HomeLayout>
        <HeroSection
            :label="trans('home.hi')"
            :title="trans('home.name')"
            :body="trans('home.headline')"
            :primary-button-text="trans('home.contact')"
            :primary-button-url="page.props.appUrl + '#contact'"
            :secondary-button-text="trans('home.learn_more')"
            secondary-button-href="#portfolio"
        >
            <template #subtitle>
                {{ trans('home.freelance') }}
                <span class="ud-text-black">{{ trans('home.i_am') }}</span>
            </template>
        </HeroSection>
        <AboutMe></AboutMe>
        <Portfolio :portfolio-items="portfolioItems" />
        <Clients :clients="clients" />
        <Testimonials/>
        <Skills></Skills>
<!--        <Approach></Approach>-->
        <ContactForm></ContactForm>
    </HomeLayout>
</template>

<style scoped>

</style>
