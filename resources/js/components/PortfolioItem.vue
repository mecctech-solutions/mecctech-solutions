<template>
    <div class="flex flex-col justify-left p-10">
        <h1 class="font-bold text-3xl">{{ title }}</h1>
        <img src="{{ main_image_url }}" alt="">
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'image_urls', 'description', 'website_url'],
        mounted() {

        }
    }
</script>
