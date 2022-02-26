<template>
    <div v-if="! is_mobile" class="bg-white z-10 centered pb-20 mt-10" v-click-outside="emitTurnOffModalEvent">
        <div class="flex justify-around items-center">
            <i @click="previousImage" class="fa-solid fa-angle-left text-xl md:text-5xl pt-5 pb-5 pr-10 pl-10 text-mecctech-red hover:scale-125 transform transition ease-in-out duration-500 cursor-pointer"></i>
            <img class="w-32 md:w-200 md:h-140 object-scale-down" :src="current_image_url" alt="">
            <i @click="nextImage" class="fa-solid fa-angle-right text-xl md:text-5xl p-5 pr-10 pl-10 text-mecctech-red hover:scale-125 transform transition ease-in-out duration-500 cursor-pointer"></i>
        </div>
        <div class="text-left p-10 mb-10">
            <h1 class="text-4xl font-bold">{{ title }}</h1>
            <p>{{ description }}</p>
        </div>

        <div class="w-1/6 inline bg-mecctech-red md:pt-6 pt-3 md:pb-5 pb-3 md:pr-10 pr-5 md:pl-10 pl-5 md:mt-32 mt-8 ml-10 mr-10 hover:bg-white hover:text-mecctech-red transition ease-in-out duration-500 cursor-pointer text-white">

            <a :href="website_url" class="text-sm md:text-xl"><i class="fa-solid fa-desktop pr-5 text-sm md:text-xl"></i> VIEW SITE</a>
        </div>
    </div>
    <div v-else-if="is_mobile" class="absolute top-0 lef-0 h-full w-full z-500">
        <img :src="current_image_url" alt="">
        <div>
            <h1>{{ title }}</h1>
            <p>{{ description }}</p>
        </div>
        <div class="flex justify-between">
            <a :href="website_url" class="text-sm md:text-xl"><i class="fa-solid fa-desktop pr-5 text-sm md:text-xl"></i> VIEW SITE</a>
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'images', 'description', 'website_url'],
        data()  {
            return {
                current_image_url: '',
                count: 0,
                current_image_index: 0,
                max_image_index: this.images.length,
                is_mobile : innerWidth <= 760
            }
        },
        created() {
            addEventListener('resize', () => {
                this.is_mobile = innerWidth <= 760
            })
        },
        mounted() {
            this.current_image_url = this.images[this.current_image_index].url;
        },
        methods : {
            emitTurnOffModalEvent()
            {
                this.$emit('turn-off-modal');
            },
            nextImage() {
                let index = this.current_image_index + 1;

                if (index >= this.max_image_index)
                {
                    index = this.max_image_index;
                }

                this.current_image_index = index;
                this.current_image_url = this.images[this.current_image_index].url;
            },
            previousImage() {
                let index = this.current_image_index - 1;

                if (index < 0)
                {
                    index = this.current_image_index;
                }

                this.current_image_index = index;
                this.current_image_url = this.images[this.current_image_index].url;
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
