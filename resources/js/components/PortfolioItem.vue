<template>
    <div class="flex flex-col justify-left border-2 border-black" @mouseover="view_image = false" @mouseleave="view_image = true">
        <transition name="fade">
            <img v-show="this.view_image" :src="main_image_url" alt="">
            <div v-show="! this.view_image" class="flex flex-col justify-left items-center">
                <h1 class="text-3xl">{{ title }}</h1>
                <p>{{ tags.join(" / ") }}</p>
                <button class="text-3xl border-mecctech-red border-4 pt-3 pb-3 pr-10 pl-10 hover:bg-mecctech-red hover:text-white transition transform ease-in-out duration-500">Learn More</button>
            </div>
        </transition>

    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'image_urls', 'description', 'website_url', 'view_image'],
        mounted() {
            this.view_image = true;
        },
        methods : {

        }

    }
</script>

<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>
