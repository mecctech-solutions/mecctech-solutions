<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import HomeLayout from "../Layouts/HomeLayout.vue";
import HeroSection from "../Components/HeroSection.vue";
import AboutMe from "../Components/AboutMe.vue";
import Skills from "../Components/Skills.vue";
import Approach from "../Components/Approach.vue";
import Portfolio from "../Components/Portfolio.vue";
import Testimonials from "../Components/Testimonials.vue";
import Clients from "../Components/Clients.vue";
import ContactForm from "../Components/ContactForm.vue";

const props = defineProps({
    portfolioItems: {
        type: Array,
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
        <HeroSection></HeroSection>
        <AboutMe></AboutMe>
        <Portfolio :portfolio-items="portfolioItems" />
        <Clients :clients="clients" />
        <Testimonials/>
        <Skills></Skills>
        <Approach></Approach>
        <ContactForm></ContactForm>
    </HomeLayout>
</template>

<style scoped>

</style>
