<template>
    <div class="ud-flex ud-justify-center ud-space-x-2">
        <!-- First and Previous links -->
        <template v-for="(link, index) in visibleLinks" :key="index">
            <Link
                v-if="link.url"
                :href="link.url"
                class="ud-flex ud-items-center ud-px-4 ud-py-2 ud-rounded-md ud-nowrap"
                :class="{
                    'ud-bg-primary ud-text-white': link.active,
                    'ud-bg-gray-100 ud-text-gray-700 hover:ud-bg-gray-200': !link.active
                }"
                preserve-scroll
            >
                <span v-html="link.label"></span>
            </Link>
            <span 
                v-else-if="link.label === '...'" 
                class="ud-px-4 ud-py-2 ud-text-gray-700"
            >
                ...
            </span>
        </template>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { computed } from 'vue';

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

const props = defineProps<{
    links: PaginationLink[];
}>();

const visibleLinks = computed(() => {
    if (props.links.length <= 4) return props.links;

    const currentPageIndex = props.links.findIndex(link => link.active);
    const firstLink = props.links[0];
    const lastLink = props.links[props.links.length - 1];
    
    let visibleLinks: (PaginationLink | { label: string, url: null, active: false })[] = [];
    
    // Always include first and last links
    visibleLinks.push(firstLink);
    
    // Logic for showing pages around current page
    if (currentPageIndex <= 3) {
        // Near the start
        visibleLinks.push(...props.links.slice(1, 4));
        visibleLinks.push({ label: '...', url: null, active: false });
    } else if (currentPageIndex >= props.links.length - 4) {
        // Near the end
        visibleLinks.push({ label: '...', url: null, active: false });
        visibleLinks.push(...props.links.slice(-5, -1));
    } else {
        // In the middle
        visibleLinks.push({ label: '...', url: null, active: false });
        visibleLinks.push(...props.links.slice(currentPageIndex - 1, currentPageIndex + 2));
        visibleLinks.push({ label: '...', url: null, active: false });
    }
    
    visibleLinks.push(lastLink);
    
    // Replace Previous and Next labels with icons
    visibleLinks = visibleLinks.map(link => {
        console.log(link.label);
        
        if (link.label === '&laquo; Previous') {
            return { ...link, label: '<i class="fas fa-chevron-left"></i>' };
        } else if (link.label === 'Next &raquo;') {
            return { ...link, label: '<i class="fas fa-chevron-right"></i>' };
        }
        return link;
    });

    return visibleLinks;
});
</script> 

<style scoped>
.ud-nowrap {
    white-space: nowrap;
}
</style>