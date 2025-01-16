<template>
    <!-- ====== Portfolio Section Start  -->
    <section
        id="portfolio"
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
                            :key="tag"
                            class="
                sm:font-semibold
                ud-text-sm
                sm:ud-text-base
                ud-block ud-py-2 ud-px-5
                md:ud-mx-2
                ud-mb-2 ud-rounded-full ud-text-body-color
                hover:ud-bg-primary hover:ud-text-white
              "
                            :class="{ active: isSelected(tag) }"
                            @click="selectTag(tag)"
                        >
                            {{ tag }}
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
                            v-for="(portfolioItem, index) in portfolioItems"
                            :key="index"
                            :title="locale === 'nl' ? portfolioItem.title_nl : portfolioItem.title_en"
                            :description="locale === 'nl' ? portfolioItem.description_nl : portfolioItem.description_en"
                            :tags="portfolioItem.tags"
                            :main_image_url="portfolioItem.main_image_url"
                            :website_url="portfolioItem.website_url"
                            :images="portfolioItem.images"
                            :bullet_points="portfolioItem.bullet_points"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Portfolio Section End  -->
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import axios from "axios";
import {usePage} from "@inertiajs/vue3";
import PortfolioItem from "./PortfolioItem.vue";
import {trans} from "laravel-vue-i18n";

const page = usePage();
const locale = computed(() => page.props.appUrl);

const tags = ["All", "Laravel", "Vue.js", "PHP", "Wordpress", "Python", "C++"];
const portfolioItems = ref([]);
const selectedTag = ref("All");

const getAllPortfolioItemsRoute = computed(() => route('all-portfolio-items')); // Replace with actual route

const fetchPortfolioItems = async (tag = "All") => {
    try {
        const route =
            tag === "All"
                ? getAllPortfolioItemsRoute.value
                : `${getAllPortfolioItemsRoute.value}?tag=${encodeURIComponent(tag)}`;
        const { data } = await axios.get(route);
        portfolioItems.value = data.payload.portfolio_items.data;
    } catch (error) {
        console.error("Error fetching portfolio items:", error);
    }
};

const isSelected = (tagName) => selectedTag.value === tagName;

const selectTag = (tagName) => {
    selectedTag.value = tagName;
    fetchPortfolioItems(tagName);
};

onMounted(() => {
    fetchPortfolioItems();
});
</script>

<style scoped></style>
