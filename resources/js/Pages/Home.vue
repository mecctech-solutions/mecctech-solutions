<script setup>
import HomeLayout from "../Layouts/HomeLayout.vue";
import {Head} from '@inertiajs/vue3'
import HeroSection from "../components/HeroSection.vue";
import AboutMe from "../components/AboutMe.vue";
import Skills from "../components/Skills.vue";
import Approach from "../components/Approach.vue";
import Portfolio from "../components/Portfolio.vue";
import EducationAndExperience from "../components/EducationAndExperience.vue";
import Clients from "../components/Clients.vue";
import ContactForm from "../components/ContactForm.vue";
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
