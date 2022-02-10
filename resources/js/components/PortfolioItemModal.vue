<template>
    <div class="bg-white z-10 p-96 border-black border-2 centered" v-click-outside="emitTurnOffModalEvent">
        <div>
            <img class="" :src="current_image_url" alt="">
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'images', 'description', 'website_url'],
        data()  {
            return {
                current_image_url: '',
                count: 0
            }
        },
        mounted() {
            this.current_image_url = this.images[0].url;
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
