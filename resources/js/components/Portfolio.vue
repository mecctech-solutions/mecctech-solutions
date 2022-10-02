<template>

    <!-- ====== Portfolio Section Start  -->
    <section id="portfolio" class="ud-pt-[120px] ud-pb-[70px] ud-bg-[#f8f9ff]" :key="locale">
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div
                        class="ud-max-w-[600px] ud-mx-auto ud-text-center ud-mb-[50px]"
                    >
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
                            {{ $lang.get('portfolio.recent_projects') }}
                        </h2>
                        <p class="ud-font-medium ud-text-lg ud-text-body-color">
                            {{ $lang.get('portfolio.recent_projects_text') }}
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
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                "
                            :class="{'active' : this.isSelected('All')}"
                            @click="this.selectTag('All')"
                            data-filter="*"
                        >
                            All
                        </button>
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  hover:ud-bg-primary hover:ud-text-white
                "
                            :class="{'active' : this.isSelected('Laravel')}"
                            @click="this.selectTag('Laravel')"
                            data-filter=".web"
                        >
                            Laravel
                        </button>
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  hover:ud-bg-primary hover:ud-text-white
                "
                            :class="{'active' : this.isSelected('Vue.js')}"
                            @click="this.selectTag('Vue.js')"
                            data-filter=".graphics"
                        >
                            Vue.js
                        </button>
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  hover:ud-bg-primary hover:ud-text-white
                "
                            :class="{'active' : this.isSelected('Wordpress')}"
                            @click="this.selectTag('Wordpress')"
                            data-filter=".graphics"
                        >
                            Wordpress
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
                        <portfolio-item-v2 v-for="portfolio_item in this.portfolio_items" :title="locale === 'nl' ? portfolio_item.title.dutch : portfolio_item.title.english" :description="locale === 'nl' ? portfolio_item.description.dutch : portfolio_item.description.english" :tags="portfolio_item.tags" :main_image_url="portfolio_item.main_image.url" :website_url="portfolio_item.website_url" :images="portfolio_item.images" :bullet_points="portfolio_item.bullet_points"></portfolio-item-v2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Portfolio Section End  -->
</template>

<script>
export default {
    props: ["get_all_portfolio_items_route"],
    name: "RecentWorks",
    data() {
        return {
            portfolio_items: [],
            current_page : 1,
            selected_tag : 'All'
        }
    },
    components: {},
    mounted() {
        this.getAllPortfolioItems();
    },
    computed: {
        locale() {
            return this.$store.state.locale
        }
    },
    methods: {
        getAllPortfolioItems() {
            axios
                .get(this.get_all_portfolio_items_route)
                .then(( { data } ) => {
                    this.portfolio_items = data.payload.portfolio_items.data;
                });
        },
        getPortfolioItemsWithTag(tag) {
            axios
                .get(this.get_all_portfolio_items_route + "?tag=" + encodeURIComponent(tag))
                .then(( { data } ) => {
                    this.portfolio_items = data.payload.portfolio_items.data;
                });
        },
        isSelected(tagName)
        {
            return this.selected_tag === tagName;
        },
        selectTag(tagName)
        {
            this.selected_tag = tagName;
            if (tagName !== 'All')
            {
                this.getPortfolioItemsWithTag(tagName);
            } else {
                this.getAllPortfolioItems();
            }
        },

    }
}
</script>

<style scoped>

</style>
