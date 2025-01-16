<script setup lang="ts">
import {defineProps} from 'vue';

const props = defineProps({
    imageUrl: String,
    imageAlt: String,
    websiteUrl: String
});
</script>

<template>
    <a
        :href="websiteUrl"
        target="_blank"
        rel="nofollow noreferrer"
        class="
                ud-flex ud-items-center ud-justify-center ud-max-w-[120px]
                lg:ud-max-w-[130px]
                xl:ud-max-w-[150px]
                2xl:ud-max-w-[160px]
                ud-mx-3
                sm:ud-mx-4
                xl:ud-mx-6
                2xl:ud-mx-8
                ud-py-[15px] ud-grayscale
                hover:ud-grayscale-0
                ud-opacity-60
                hover:ud-opacity-100
                ud-transition
              "
    >
        <img :src="imageUrl" :alt="imageAlt" />
    </a>
</template>

<style scoped>

</style>
