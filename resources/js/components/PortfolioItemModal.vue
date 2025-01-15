<template>
    <div v-if="! is_mobile" class="ud-bg-white ud-z-10 centered ud-pb-20 ud-mt-10" v-click-outside="emitTurnOffModalEvent">
        <div class="ud-flex ud-justify-around ud-items-center">
            <i @click="previousImage" class="fa-solid fa-angle-left ud-text-xl md:ud-text-5xl ud-pt-5 ud-pb-5 ud-pr-10 ud-pl-10 ud-text-primary hover:ud-scale-125 ud-transform ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer"></i>
            <img class="uw-w-32 md:ud-w-200 md:ud-h-100 lg:ud-h-140 ud-object-scale-down" :src="current_image_url" alt="">
            <i @click="nextImage" class="fa-solid fa-angle-right ud-text-xl md:ud-text-5xl ud-p-5 ud-pr-10 ud-pl-10 ud-text-primary hover:ud-scale-125 ud-transform ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer"></i>
        </div>
        <div class="ud-text-left ud-p-5">
            <div class="ud-flex ud-items-center ud-space-x-3">
                <h1 class="ud-text-4xl ud-font-bold">{{ title }}</h1>
                <p v-for="tag in this.tags">{{ tag.name }}</p>
            </div>
            <ul class="ud-mt-4">
                <li class="ud-text-base ud-list-disc" v-for="bullet_point in this.bullet_points">
                    {{ locale === 'nl' ? bullet_point.text_nl : bullet_point.text_en }}
                </li>
            </ul>
        </div>
        <div class="ud-flex ud-flex-col ud-items-center">
            <div class="
            ud-text-base
            ud-font-semibold
            ud-text-white
            ud-bg-primary
            ud-py-3
            ud-px-8
            ud-mr-4
            hover:ud-shadow-signUp hover:ud-bg-opacity-90
            ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
            ud-cursor-pointer
            ">
                <a :href="website_url" class="ud-text-sm md:ud-text-xl"><i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i> SITE / CODE</a>
            </div>
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
            <div class="ud-mb-4">
                <h1 class="ud-text-2xl ud-font-bold">{{ title }}</h1>
                <div class="ud-flex ud-space-x-3 ud-text-sm">
                    <p v-for="tag in this.tags">{{ tag.name }}</p>
                </div>
            </div>

            <ul class="ud-space-y-3 ud-mt-4">
                <li class="ud-text-base ud-list-disc" v-for="bullet_point in this.bullet_points">
                    {{ locale === 'nl' ? bullet_point.text_nl : bullet_point.text_en }}
                </li>
            </ul>
        </div>
        <div class="ud-flex ud-flex-col ud-items-center">
            <div class="
            ud-text-base
            ud-font-semibold
            ud-text-white
            ud-bg-primary
            ud-py-3
            ud-px-8
            ud-mr-4
            hover:ud-shadow-signUp hover:ud-bg-opacity-90
            ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
            ud-cursor-pointer
            ">
                <a :href="website_url" class="ud-text-sm md:ud-text-xl"><i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i> SITE / CODE</a>
            </div>
        </div>
        <i @click="emitTurnOffModalEvent" class="fa-solid fa-xmark ud-cursor-pointer ud-p-5 ud-text-3xl ud-fixed ud-right-0 ud-bottom-0"></i>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'images', 'description', 'website_url', 'bullet_points'],
        data() {
            return {
                current_image_url: '',
                count: 0,
                current_image_index: 0,
                max_image_index: this.images.length,
                is_mobile: innerWidth <= 760
            }
        },
        created() {
            addEventListener('resize', () => {
                this.is_mobile = innerWidth <= 760
            });
            this.addSwipeEventListeners();
        },
        mounted() {
            this.current_image_url = this.images[this.current_image_index].url;
        },
        computed: {
            locale() {
                return this.$store.state.locale
            }
        },
        methods: {
            emitTurnOffModalEvent() {
                this.$emit('turn-off-modal');
            },
            nextImage() {
                let index = this.current_image_index + 1;

                if (index >= this.max_image_index) {
                    index = this.max_image_index;
                }

                this.current_image_index = index;
                this.current_image_url = this.images[this.current_image_index].url;
            },
            previousImage() {
                let index = this.current_image_index - 1;

                if (index < 0) {
                    index = this.current_image_index;
                }

                this.current_image_index = index;
                this.current_image_url = this.images[this.current_image_index].url;
            },
            addSwipeEventListeners() {
                window.addEventListener('touchstart', this.handleTouchStart);
                window.addEventListener('touchend', this.handleTouchEnd);
            },
            handleTouchStart() {
                this.touchStartX = event.changedTouches[0].screenX;
                this.touchStartY = event.changedTouches[0].screenY;
            },
            handleTouchEnd() {
                this.touchEndX = event.changedTouches[0].screenX;
                this.touchEndY = event.changedTouches[0].screenY;

                if (this.touchEndX < this.touchStartX) {
                    // 'Swiped Left'
                    this.nextImage();
                }

                if (this.touchEndX > this.touchStartX) {
                    // 'Swiped Right'
                    this.previousImage();
                }

                if (this.touchEndY < this.touchStartY) {
                    // 'Swiped Up'
                }

                if (this.touchEndY > this.touchStartY) {
                    // 'Swiped Down'
                }

                if (this.touchEndY === this.touchStartY) {
                    // 'Tap'
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
