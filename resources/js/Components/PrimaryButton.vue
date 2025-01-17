<script setup lang="ts">

const props = defineProps({
    url: String,
    text: String,
});

</script>

<template>
    <a
        :href="url"
        class="
                  ud-text-base
                  ud-font-semibold
                  ud-text-white
                  ud-bg-primary
                  ud-py-3
                  ud-px-8
                  ud-mr-4
                  hover:ud-shadow-signUp hover:ud-bg-opacity-90
                  ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
                "
    >
        {{ text }}
    </a>
</template>

<style scoped>

</style>
