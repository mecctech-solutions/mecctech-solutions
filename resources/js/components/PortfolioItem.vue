<template>
    <div class="md:mb-20 mb-32">
        <div class="container">
            <img class="w-full h-40 object-scale-down block" :src="main_image_url" alt="">
            <div class="overlay">
                <div class="text">
                    <h1 class="text-lg md:text-3xl">{{ title }}</h1>
                    <p class="text-md md:text-xl">{{ tags.join(" / ") }}</p>
                    <button @click="toggleModal" class="text-lg md:text-2xl border-mecctech-red border-4 pl-5 pr-5 pt-1 pb-1 mt-5 hover:bg-mecctech-red hover:text-white transition transform ease-in-out duration-500">Learn More</button>
                </div>
            </div>
        </div>

        <portfolio-item-modal :title="this.title" :tags="this.tags" :images="this.images" :description="this.description" :website_url="this.website_url" v-on:turn-off-modal="turnOffModal" v-if="view_modal"></portfolio-item-modal>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'images', 'description', 'website_url'],
        data() {
            return {
                view_modal: false
            }
        },
        mounted() {

        },
        methods : {
            toggleModal()
            {
                this.view_modal = this.view_modal !== true;
            },
            turnOffModal() {
                this.view_modal = false;
            }
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

    .container {
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .5s ease-in-out;
        background-color: #FFFFFF;
    }

    .container:hover .overlay {
        opacity: 1;
    }

    .text {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
