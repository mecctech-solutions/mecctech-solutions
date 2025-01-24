<template>
    <!-- ====== Portfolio Section Start  -->
    <section
        id="portfolio"
        dusk="portfolio"
        class="ud-pt-[120px] ud-pb-[70px] ud-bg-[#f8f9ff]"
        :key="locale"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div class="ud-max-w-[600px] ud-mx-auto ud-text-center ud-mb-[50px]">
            <span
                class="
                ud-font-semibold ud-text-lg ud-text-primary ud-block ud-mb-2
              "
            >
              Portfolio
            </span>
                        <h2
                            class="
                ud-font-bold ud-text-black ud-text-3xl
                sm:ud-text-4xl
                md:ud-text-[45px]
                ud-mb-5
              "
                        >
                            {{ trans('portfolio.recent_projects') }}
                        </h2>
                        <p class="ud-font-medium ud-text-lg ud-text-body-color">
                            {{ trans('portfolio.recent_projects_text') }}
                        </p>
                    </div>
                </div>
                <div class="ud-w-full ud-px-4">
                    <div
                        class="
              portfolio-buttons
              ud-flex ud-flex-wrap ud-items-center ud-justify-center ud-mb-12
            "
                    >
                        <button
                            v-for="tag in tags"
                            :key="tag.name"
                            class="
                sm:font-semibold
                ud-text-sm
                sm:ud-text-base
                ud-block ud-py-2 ud-px-5
                md:ud-mx-2
                ud-mb-2 ud-rounded-full ud-text-body-color
                hover:ud-bg-primary hover:ud-text-white
              "
                            :class="{ active: isSelected(tag.name) }"
                            @click="selectTag(tag.name)"
                        >
                            {{ tag.name }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="portfolio-container ud-flex ud-justify-center ud--mx-4">
                <div class="ud-w-full xl:ud-w-10/12 ud-px-4">
                    <div
                        class="
              items-wrapper
              ud-flex ud-flex-wrap ud-justify-center ud-mx-[-16px]
            "
                    >
                        <PortfolioItem
                            v-for="item in portfolioItems"
                            :key="item.id"
                            :id="item.id"
                            :title="locale === 'nl' ? item.title_nl : item.title_en"
                            :tags="item.tags"
                            :main-image-url="item.main_image_full_url"
                            :images="item.images"
                            :description="locale === 'nl' ? item.description_nl : item.description_en"
                            :website-url="item.website_url"
                            :bullet-points="item.bullet_points"
                            :has-case-study="item.has_case_study"
                            :case-study-slug="item.case_study_slug"
                        />

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Portfolio Section End  -->
</template>

<script setup lang="ts">
import {computed, Ref, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import PortfolioItem from "./PortfolioItem.vue";
import {trans} from "laravel-vue-i18n";
import {route} from "ziggy-js";
import TagData = App.Data.TagData;

const page = usePage();
const tags: Array<TagData> = page.props.tags;
const allTag: TagData = { name: "All", visible: true };

const locale: string = computed(() => page.props.locale).value;

tags.unshift(allTag);

const portfolioItems: Ref = ref(page.props.portfolioItems);
const selectedTag: Ref = ref(allTag.name);

const currentPage: Ref = ref(1);
const itemsPerPage = 10;
const totalItems: Ref = ref(page.props.totalItems);

const isSelected = (tagName: string) => selectedTag.value === tagName;

const selectTag = (tagName: string) => {
    selectedTag.value = tagName;
    router.get(route('home'), { tag: tagName }, {
        preserveScroll: true,
        preserveState: true,
        onSuccess: (page) => {
            portfolioItems.value = page.props.portfolioItems;
        }
    });
};

</script>

<style scoped></style>
