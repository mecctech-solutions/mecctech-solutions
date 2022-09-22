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
                    :src="this.$root.baseUrl() + '/' + this.main_image_url"
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
                        :href="this.$root.baseUrl() + '/' + this.main_image_url"
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
                        <svg
                            width="14"
                            height="14"
                            viewBox="0 0 14 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M14 8H8V14H6V8H0V6H6V0H8V6H14V8Z"
                                fill="white"
                            />
                        </svg>
                    </a>
                </div>
            </div>
            <h3 class="mt-6">
                <a
                    :href="this.$root.baseUrl() + '/portfolio/details'"
                    class="
                ud-font-semibold ud-text-black
                hover:ud-text-primary
                ud-text-xl ud-inline-block ud-mb-3
              "
                >
                    {{ this.title }}
                </a>
            </h3>
            <div>
                <p
                    class="ud-font-medium ud-text-base ud-text-body-color"
                    style="overflow: hidden;
                            display: -webkit-box;
                            -webkit-line-clamp: 3;
                             -webkit-box-orient: vertical;"
                >
                    {{ this.description }}
                </p>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'images', 'description', 'website_url'],
        data() {

        },
        mounted() {

        },
        methods : {

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
