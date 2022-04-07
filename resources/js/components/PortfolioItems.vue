<template>
    <div class="flex flex-col items-center">
        <h1 class="text-4xl font-bold mt-10">{{ $lang.get('sections.projects') }}</h1>
        <div class="border-t border-4 border-black mt-5 w-1/16"></div>

        <div class="grid grid-cols-1 md:grid-cols-3 pl-16 pr-16 lg:pl-96 lg:pr-96 mt-20">
            <portfolio-item v-for="portfolio_item in this.portfolio_items" :title="locale === 'nl' ? portfolio_item.title.dutch : portfolio_item.title.english" :description="locale === 'nl' ? portfolio_item.description.dutch : portfolio_item.description.english" :tags="portfolio_item.tags" :main_image_url="portfolio_item.main_image.url" :website_url="portfolio_item.website_url" :images="portfolio_item.images"></portfolio-item>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["get_all_portfolio_items_route", "get_portfolio_items_with_tag_route"],
        computed: {
            locale() {
                return this.$store.state.locale
            }
        },
        data() {
            return {
                portfolio_items: []
            }
        },
        mounted() {
            this.getAllPortfolioItems();
        },
        methods: {
            getAllPortfolioItems() {
                axios
                    .get(this.get_all_portfolio_items_route)
                    .then(( { data } ) => {
                        this.portfolio_items = data.payload.portfolio_items;
                    });
            },
            getPortfolioItemsWithTag(tag) {
                axios
                    .get(this.get_portfolio_items_with_tag_route + "/" + tag)
                    .then(( { data } ) => {
                        this.portfolio_items = data.payload.portfolio_items
                    });
            }
        }

    }
</script>
