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
    modelValue: [String, Number, null],
})
</script>

<template>
    <input
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :placeholder="placeholder"
        :required="required"
        class="input-field"
    />
</template>

<style scoped>

</style>
