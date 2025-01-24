<template>
    <div
        v-if="!isMobile"
        class="ud-bg-white ud-z-10 centered ud-pb-20 ud-mt-10"
        v-click-outside="emitTurnOffModalEvent"
    >
        <ImageCarousel
            :images="images"
            @updateCurrentImage="currentImageUrl = $event"
        ></ImageCarousel>
        <div class="ud-text-left ud-p-5 ud-m-8">
            <div class="ud-flex ud-items-center ud-space-x-3">
                <h1 class="ud-text-4xl ud-font-bold">{{ title }}</h1>
                <Tag v-for="tag in tags" :key="tag.name" :name="tag.name"/>
            </div>
            <ul class="ud-mt-4 ud-text-base ud-list-disc ud-list-inside">
                <li
                    v-for="bulletPoint in bulletPoints"
                    :key="bulletPoint.text_nl || bulletPoint.text_en"
                >
                    {{ locale === 'nl' ? bulletPoint.text_nl : bulletPoint.text_en }}
                </li>
            </ul>
        </div>
        <div class="ud-flex ud-flex-col ud-items-center ud-space-y-4">
            <div
                v-if="websiteUrl"
                class="
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
        "
            >
                <a :href="websiteUrl" class="ud-text-sm md:ud-text-xl">
                    <i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i>
                    Site / Code
                </a>
            </div>
            <div
                v-if="hasCaseStudy"
                class="
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
        "
            >
                <a
                    :href="route('case-studies.show', caseStudySlug)"
                    class="ud-text-sm md:ud-text-xl"
                    dusk="case-study-button"
                >
                    <i class="fa-solid fa-book-open ud-pr-5 ud-text-sm md:ud-text-xl"></i>
                    {{ trans('portfolio.view_case_study') }}
                </a>
            </div>
        </div>
    </div>
    <div
        v-else
        class="ud-fixed ud-z-50 ud-top-0 ud-h-full ud-m-0 ud-bg-white ud-left-0"
    >
        <ImageCarousel
            :images="images"
            @updateCurrentImage="currentImageUrl = $event">
        </ImageCarousel>
        <div class="ud-p-8 ud-mb-5">
            <div class="ud-mb-4">
                <h1 class="ud-text-2xl ud-font-bold">{{ title }}</h1>
                <div class="ud-flex ud-flex-wrap ud-gap-y-3 ud-gap-x-3">
                    <Tag v-for="tag in tags" :key="tag.name" :name="tag.name"/>
                </div>
            </div>
            <ul class="ud-space-y-3 ud-mt-4 ud-text-base ud-list-disc ud-list-inside">
                <li
                    v-for="bulletPoint in bulletPoints"
                    :key="bulletPoint.text_nl || bulletPoint.text_en"
                >
                    {{ locale === 'nl' ? bulletPoint.text_nl : bulletPoint.text_en }}
                </li>
            </ul>
        </div>
        <div class="ud-flex ud-flex-col ud-items-center ud-space-y-4">
            <div
                v-if="websiteUrl"
                class="
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
        "
            >
                <a :href="websiteUrl" class="ud-text-sm md:ud-text-xl">
                    <i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i>
                    Site / Code
                </a>
            </div>
            <div
                v-if="hasCaseStudy"
                class="
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
        "
            >
                <Link
                    :href="route('case-studies.show', caseStudySlug)"
                    class="ud-text-sm md:ud-text-xl"
                    dusk="case-study-button"
                    as="button"
                    preserve-scroll
                >
                    <i class="fa-solid fa-book-open ud-pr-5 ud-text-sm md:ud-text-xl"></i>
                    {{ trans('portfolio.view_case_study') }}
                </Link>
            </div>
        </div>
        <i
            @click="emitTurnOffModalEvent"
            class="fa-solid fa-xmark ud-text-mecctech-red-500 ud-cursor-pointer ud-p-5 ud-text-3xl ud-fixed ud-right-0 ud-top-0"
        ></i>
    </div>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import {Link, usePage} from "@inertiajs/vue3";
import ImageCarousel from "./ImageCarousel.vue";
import useScreenSize from "@/Composables/screensize.ts";
import {trans} from "laravel-vue-i18n";
import Tag from "@/Components/Tag.vue";
import {route} from "ziggy-js";

const props = defineProps({
    title: String,
    tags: Array,
    images: Array,
    description: String,
    websiteUrl: String,
    bulletPoints: Array,
    hasCaseStudy: {
        type: Boolean,
        default: false
    },
    caseStudySlug: {
        type: String,
        default: ''
    },
});

const emit = defineEmits(["turn-off-modal"]);

const page = usePage();
const locale = computed(() => page.props.locale);

const {isMobile} = useScreenSize();
const currentImageUrl = ref("");

onMounted(() => {
    currentImageUrl.value = props.images[0].full_url;
});

const emitTurnOffModalEvent = () => {
    emit("turn-off-modal");
};


</script>

<style scoped>
.centered {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
