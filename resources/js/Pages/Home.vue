<script setup>


import {Head} from '@inertiajs/vue3'
import HomeLayout from "../Layouts/HomeLayout.vue";
import HeroSection from "../Components/HeroSection.vue";
import AboutMe from "../Components/AboutMe.vue";
import Skills from "../Components/Skills.vue";
import Approach from "../Components/Approach.vue";
import Portfolio from "../Components/Portfolio.vue";
import Clients from "../Components/Clients.vue";
import EducationAndExperience from "../Components/EducationAndExperience.vue";
import ContactForm from "../Components/ContactForm.vue";

const props = defineProps({
    portfolioItems: Array,
});
</script>

<template>
    <HomeLayout>
    <Head title="Home"></Head>
        <HeroSection></HeroSection>
        <AboutMe></AboutMe>
        <Skills></Skills>
        <Approach></Approach>
        <Portfolio></Portfolio>
        <Clients></Clients>
        <EducationAndExperience></EducationAndExperience>
        <ContactForm></ContactForm>
    </HomeLayout>

</template>

<style scoped>

</style>
