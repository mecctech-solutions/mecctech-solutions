<template>
    <div class="flex flex-col items-center">
        <h1 class="text-4xl font-bold mt-10">PROJECTS</h1>
        <div class="border-t border-4 border-black mt-5 w-1/16"></div>

        <div class="grid grid-cols-2">
            <portfolio-item v-for="portfolio_item in this.portfolio_items" :title="portfolio_item.title" :description="portfolio_item.description" :tags="portfolio_item.tags" :main_image_url="portfolio_item.main_image.url" :website_url="portfolio_item.website_url" :image_urls="portfolio_item.image_urls"></portfolio-item>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["get_all_portfolio_items_route", "get_portfolio_items_with_tag_route", "portfolio_items"],
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
