<template>
    <div class="bg-white z-10 p-96 border-black border-2 centered" v-click-outside="emitTurnOffModalEvent">
        TESTTEST
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
    .centered {
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
    }
</style>
