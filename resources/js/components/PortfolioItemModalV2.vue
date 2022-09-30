<template>
    <div v-if="! is_mobile" class="ud-bg-white ud-z-10 centered ud-pb-20 ud-mt-10" v-click-outside="emitTurnOffModalEvent">
        <div class="ud-flex ud-justify-around ud-items-center">
            <i @click="previousImage" class="fa-solid fa-angle-left ud-text-xl md:ud-text-5xl ud-pt-5 ud-pb-5 ud-pr-10 ud-pl-10 ud-text-primary hover:ud-scale-125 ud-transform ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer"></i>
            <img class="uw-w-32 md:ud-w-200 md:ud-h-140 ud-object-scale-down" :src="current_image_url" alt="">
            <i @click="nextImage" class="fa-solid fa-angle-right ud-text-xl md:ud-text-5xl ud-p-5 ud-pr-10 ud-pl-10 ud-text-primary hover:ud-scale-125 ud-transform ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer"></i>
        </div>
        <div class="ud-text-left ud-p-10 ud-mb-10">
            <h1 class="ud-text-4xl ud-font-bold">{{ title }}</h1>
            <ul>
                <li class="ud-text-base" v-for="bullet_point in this.bullet_points">
                    {{ bullet_point.english }}
                </li>
            </ul>
        </div>

        <div class="ud-w-1/6 ud-inline ud-bg-primary md:ud-pt-6 ud-pt-3 md:ud-pb-5 ud-pb-3 md:ud-pr-10 ud-pr-5 md:ud-pl-10 ud-pl-5 md:ud-mt-32 ud-mt-8 ud-ml-10 ud-mr-10 hover:ud-bg-white hover:ud-text-primary ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer ud-text-white">
            <a :href="website_url" class="ud-text-sm md:ud-text-xl"><i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i> VIEW SITE / CODE</a>
        </div>
    </div>
    <div v-else-if="is_mobile" class="ud-fixed ud-z-50 ud-top-0 ud-h-full ud-m-0 ud-bg-white ud-left-0">
        <div class="ud-flex ud-flex-col ud-items-center">
            <img class="ud-w-full ud-h-60 ud-object-scale-down" :src="current_image_url" alt="">
            <div class="ud-flex ud-space-x-2 ud-mt-10">
                <i @click="this.current_image_url = image.url" v-for="image in images" :class="{ 'ud-text-primary' : image.url === this.current_image_url, 'ud-text-black' : image.url !== this.current_image_url }" class="fas fa-circle ud-cursor-pointer"></i>
            </div>
        </div>

        <div class="ud-p-5 ud-mb-5">
            <h1 class="ud-text-2xl ud-font-bold">{{ title }}</h1>
            <ul>
                <li class="ud-text-base" v-for="bullet_point in this.bullet_points">
                    {{ bullet_point.english }}
                </li>
            </ul>
        </div>
        <div class="ud-flex ud-justify-between ud-bottom-0">
            <div>
                <a :href="website_url" class="ud-text-sm md:ud-text-xl ud-bg-primary ud-pt-3 ud-pb-3 ud-pr-5 ud-pl-5 ud-ml-4"><i class="fa-solid fa-desktop pr-5 text-sm md:text-xl"></i> VIEW SITE / CODE</a>
            </div>
        </div>
        <i @click="emitTurnOffModalEvent" class="fa-solid fa-xmark ud-cursor-pointer ud-p-5 ud-text-3xl ud-fixed ud-right-0 ud-bottom-0"></i>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'images', 'description', 'website_url', 'bullet_points'],
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
