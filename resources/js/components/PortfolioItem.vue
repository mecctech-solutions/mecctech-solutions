<template>
    <div class="">
        <h1>{{ title }}</h1>
        <p>{{ description}}</p>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'image_urls', 'description', 'website_url'],
        mounted() {

        }
    }
</script>
