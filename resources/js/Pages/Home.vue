<script setup>
import HomeLayout from "../Layouts/HomeLayout.vue";
import {Head} from '@inertiajs/vue3'
import HeroSection from "../Components/HeroSection.vue";
import AboutMe from "../Components/AboutMe.vue";
import Skills from "../Components/Skills.vue";
import Approach from "../Components/Approach.vue";
import Portfolio from "../Components/Portfolio.vue";
import EducationAndExperience from "../Components/EducationAndExperience.vue";
import Clients from "../Components/Clients.vue";
import ContactForm from "../Components/ContactForm.vue";
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
