<script setup>

import SiteHeader from "../components/SiteHeader.vue";
import SiteFooter from "../components/SiteFooter.vue";
import BackToTop from "../components/BackToTop.vue";
import Whatsapp from "../components/Whatsapp.vue";
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
