<script setup lang="ts">
const props = defineProps({
    name: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <span
        class="ud-inline-block ud-px-2 ud-py-1 ud-text-sm ud-font-medium ud-text-gray-800 ud-bg-gray-200 ud-rounded-full ud-text-center ud-whitespace-nowrap"
    >
        {{ name }}
    </span>
</template>
