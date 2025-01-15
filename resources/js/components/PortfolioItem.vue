<template>
    <div class="ud-w-full md:ud-w-1/2 ud-px-4 item web app">
        <div class="ud-mb-12">
            <div
                class="
              ud-relative
              ud-group
              ud-mb-8
              ud-overflow-hidden
              ud-shadow-service
              ud-rounded-md
            "
            >
                <img
                    :src="this.main_image_url"
                    alt="image"
                    class="ud-w-full ud-h-60 ud-object-scale-down"
                />
                <div
                    class="
                ud-absolute
                ud-w-full
                ud-h-full
                ud-top-0
                ud-left-0
                ud-bg-primary
                ud-bg-opacity-[17%]
                ud-flex
                ud-items-center
                ud-justify-center
                ud-opacity-0
                ud-invisible
                group-hover:ud-opacity-100 group-hover:ud-visible
                ud-transition
              "
                >
                    <a
                        @click="this.toggleModal"
                        href="javascript:void(0)"
                        class="
                  glightbox
                  ud-w-10
                  ud-h-10
                  ud-flex
                  ud-items-center
                  ud-justify-center
                  ud-bg-primary
                  ud-text-white
                  ud-rounded-full
                "
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </div>
            </div>

            <h3 class="mt-6">
                <a
                    @click="this.toggleModal"
                    href="javascript:void(0)"
                    class="
                ud-font-semibold ud-text-black
                hover:ud-text-primary
                ud-text-xl ud-inline-block ud-mb-3
              "
                >
                    {{ this.title }}
                </a>
                <ul class="ud-text-sm ud-font-normal ud-flex ud-space-x-3">

                    <li v-for="tag in this.tags" href="">{{ tag.name }}</li>

                </ul>
            </h3>
            <div
                @click="this.toggleModal">
                <ul
                    class="ud-font-medium ud-text-base ud-text-body-color ud-cursor-pointer"
                >
                </ul>
            </div>
        </div>

        <portfolio-item-modal :title="this.title" :tags="this.tags" :images="this.images" :description="this.description" :website_url="this.website_url" :bullet_points="this.bullet_points" v-on:turn-off-modal="turnOffModal" v-if="view_modal"></portfolio-item-modal>

    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'images', 'description', 'website_url', 'bullet_points'],
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
