<template>
    <div>
        <div class="container">
            <img class="image" :src="main_image_url" alt="">
            <div class="overlay">
                <div class="text">
                    <h1 class="text-3xl">{{ title }}</h1>
                    <p>{{ tags.join(" / ") }}</p>
                    <button @click="toggleModal" class="text-2xl border-mecctech-red border-4 pl-5 pr-5 pt-1 pb-1 mt-5 hover:bg-mecctech-red hover:text-white transition transform ease-in-out duration-500">Learn More</button>
                </div>
            </div>
        </div>

        <transition name="fade">
            <portfolio-item-modal v-on:turn-off-modal="turnOffModal" v-if="view_modal"></portfolio-item-modal>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'image_urls', 'description', 'website_url', 'view_modal'],
        mounted() {
            this.view_modal = false;
        },
        methods : {
            toggleModal()
            {
                this.view_modal = this.view_modal !== true;
            },
            turnOffModal() {
                console.log("Turning off portfolio item modal");
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

    .image {
        display: block;
        width: 100%;
        height: auto;
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
