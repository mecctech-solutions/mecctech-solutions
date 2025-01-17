<template>
    <div class="ud-mb-6">
        <div class="ud-flex ud-flex-col ud-items-start ud-space-y-1">
            <span class="ud-text-lg ud-font-bold ud-text-black">{{ name }}</span>
            <span class="ud-text-sm ud-text-gray-600">{{ description }}</span>
        </div>
    </div>
</template>

<script setup>
defineProps({
    name: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: false, // Make it optional
    },
});
</script>

<style scoped></style>
