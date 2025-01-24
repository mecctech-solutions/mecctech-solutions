<template>
    <div class="ud-w-full md:ud-w-1/2 ud-px-4 item web app">
        <div class="ud-mb-12">
            <div
                :dusk="'portfolio-item-' + id"
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
                    :src="mainImageUrl"
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
                        @click="toggleModal"
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
                    :dusk="'portfolio-item-toggle-modal-' + id"
                    @click="toggleModal"
                    href="javascript:void(0)"
                    class="
            ud-font-semibold ud-text-black
            hover:ud-text-primary
            ud-text-xl ud-inline-block ud-mb-3
          "
                >
                    {{ title }}
                </a>
                <ul class="ud-flex ud-space-x-3 ud-flex-wrap ud-gap-y-3">
                  <Tag v-for="tag in tags" :key="tag.name" :name="tag.name"></Tag>
                </ul>

            </h3>
            <div
                @click="toggleModal">
                <ul class="ud-font-medium ud-text-base ud-text-body-color ud-cursor-pointer"></ul>
            </div>
        </div>

        <PortfolioItemModal
            v-if="viewModal"
            :title="title"
            :tags="tags"
            :images="images"
            :description="description"
            :website-url="websiteUrl"
            :bullet-points="bulletPoints"
            :has-case-study="hasCaseStudy"
            :case-study-slug="caseStudySlug"
            @turn-off-modal="turnOffModal"
        />
    </div>
</template>

<script setup>
import {ref} from "vue";
import PortfolioItemModal from "./PortfolioItemModal.vue";
import Tag from "@/Components/Tag.vue";

const props = defineProps({
    title: String,
    tags: Array,
    mainImageUrl: String,
    images: Array,
    description: String,
    websiteUrl: String,
    bulletPoints: Array,
    hasCaseStudy: Boolean,
    caseStudySlug: String,
    id: Number,
});

const viewModal = ref(false);

const toggleModal = () => {
    viewModal.value = !viewModal.value;
};

const turnOffModal = () => {
    viewModal.value = false;
};
</script>

<style scoped>
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
    transition: 0.5s ease-in-out;
    background-color: #ffffff;
}

.container:hover .overlay {
    opacity: 1;
}

.text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
</style>
