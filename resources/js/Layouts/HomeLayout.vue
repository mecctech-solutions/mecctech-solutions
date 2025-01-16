<script setup>

import SiteHeader from "../Components/SiteHeader.vue";
import SiteFooter from "../Components/SiteFooter.vue";
import BackToTop from "../Components/BackToTop.vue";
import Whatsapp from "../Components/Whatsapp.vue";
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
