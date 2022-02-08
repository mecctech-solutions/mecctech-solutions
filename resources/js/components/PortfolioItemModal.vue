<template>
    <div class="flex justify-center items-center" @mouseleave="this.$emit('turn-off-modal')">
        <div class="bg-white z-10 absolute p-96 m-auto border-black border-2">
            TESTTEST
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'image_urls', 'description', 'website_url', 'view_modal'],
        mounted() {
        },
        methods : {

        }

    }
</script>

<style>

</style>
