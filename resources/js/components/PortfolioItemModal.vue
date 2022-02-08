<template>
    <div class="flex justify-center items-center" v-click-outside="emitTurnOffModalEvent">
        <div class="bg-white z-10 absolute p-96 m-auto border-black border-2">
            TESTTEST
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'image_urls', 'description', 'website_url', 'view_modal'],
        mounted() {
            this.count = 0;
        },
        methods : {
            emitTurnOffModalEvent()
            {
                // Hack to prevent the click event from firing already as the component is rendered, closing it immediately
                if (this.count === 1)
                {
                    this.$emit('turn-off-modal');
                    this.count--;
                } else {
                    this.count++;
                }
            }
        }

    }
</script>

<style>

</style>
