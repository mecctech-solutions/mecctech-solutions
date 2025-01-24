<template>
    <div class="ud-flex ud-justify-center ud-space-x-2">
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                :href="link.url"
                class="ud-px-4 ud-py-2 ud-rounded-md"
                :class="{
                    'ud-bg-primary ud-text-white': link.active,
                    'ud-bg-gray-100 ud-text-gray-700 hover:ud-bg-gray-200': !link.active
                }"
                preserve-scroll
                v-html="link.label"
            />
        </template>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

defineProps<{
    links: PaginationLink[];
}>();
</script> 