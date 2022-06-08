<template>
    <div class="flex flex-col items-center">
        <h1 class="text-4xl font-bold mt-10">{{ $lang.get('sections.projects') }}</h1>
        <div class="border-t border-4 border-black mt-5 w-1/16"></div>

        <div>
            <ul class="grid md:grid-cols-4 grid-cols-2 m-10 text-xl">
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('All')}" @click="this.selectTag('All')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-all">{{ $lang.get('tags.all') }}</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('Laravel')}" @click="this.selectTag('Laravel')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-laravel">Laravel</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('Vue.js')}" @click="this.selectTag('Vue.js')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-vue">Vue.js</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('E-commerce')}" @click="this.selectTag('E-commerce')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-vue">E-commerce</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('Python')}" @click="this.selectTag('Python')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-python">Python</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('C++')}" @click="this.selectTag('C++')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-c++">C++</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('C#')}" @click="this.selectTag('C#')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-c#">C#</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('C')}" @click="this.selectTag('C')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-arduino">C</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('Matlab')}" @click="this.selectTag('Matlab')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-matlab">Matlab</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('Courses')}" @click="this.selectTag('Courses')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-matlab">{{ $lang.get('tags.courses') }}</li>
                <li :class="{'bg-mecctech-red text-white' : this.isSelected('Books')}" @click="this.selectTag('Books')" class="pl-10 pr-10 pt-3 pb-3 cursor-pointer" id="tag-matlab">{{ $lang.get('tags.books') }}</li>
            </ul>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-24 pl-16 pr-16 lg:pl-96 lg:pr-96 mt-20">
            <portfolio-item v-for="portfolio_item in this.portfolio_items" :title="locale === 'nl' ? portfolio_item.title.dutch : portfolio_item.title.english" :description="locale === 'nl' ? portfolio_item.description.dutch : portfolio_item.description.english" :tags="portfolio_item.tags" :main_image_url="portfolio_item.main_image.url" :website_url="portfolio_item.website_url" :images="portfolio_item.images"></portfolio-item>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["get_all_portfolio_items_route"],
        computed: {
            locale() {
                return this.$store.state.locale
            }
        },
        data() {
            return {
                portfolio_items: [],
                current_page : 1,
                selected_tag : 'All'
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
            }
        }

    }
</script>
