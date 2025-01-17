<script setup lang="ts">

defineProps({
    type: {
        type: String,
        default: 'text',
    },
    name: String,
    placeholder: String,
    required: {
        type: Boolean,
        default: true,
    },
})
</script>

<template>
    <input
        :name="name"
        :type="type"
        :placeholder="placeholder"
        :required="required"
        class="input-field"
    />
</template>

<style scoped>

</style>
