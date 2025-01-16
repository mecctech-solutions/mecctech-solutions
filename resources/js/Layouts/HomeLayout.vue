<script setup>

import SiteHeader from "../Components/SiteHeader.vue";
import SiteFooter from "../Components/SiteFooter.vue";
import BackToTop from "../Components/BackToTop.vue";
import Whatsapp from "../Components/Whatsapp.vue";
import {usePage} from "@inertiajs/vue3";

const page = usePage();
const appUrl = page.props.appUrl;
const locale = page.props.locale;

</script>

<template>
    <SiteHeader></SiteHeader>
    <slot/>
    <SiteFooter></SiteFooter>
    <BackToTop></BackToTop>
    <Whatsapp></Whatsapp>
</template>

<style scoped>

</style>
