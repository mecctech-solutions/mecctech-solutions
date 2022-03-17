<template>
    <div class="flex flex-col items-center">
        <div class="p-10 mt-10 rounded-full flex flex-col items-center" style="background: #e30613">
            <svg style="width:50px; height:50px; color: #FFFFFF" viewBox="0 0 24 24">
                <path fill="currentColor" :d="this.svg_d" />
            </svg>
        </div>
        <div class="flex flex-col">
            <h1 class="m-auto text-3xl font-bold mt-3">{{ this.title }}</h1>
            <p class="mr-5 ml-5 text-center text-xl">{{ this.description }}</p>
        </div>
        <button @click="toggleMoreInformation" :class="{ more_information : 'bg-mecctech-red text-white' }" class="text-lg md:text-2xl border-mecctech-red border-4 pl-5 pr-5 pt-1 pb-1 mt-5 hover:bg-mecctech-red hover:text-white transition transform ease-in-out duration-500">
            More Information
        </button>
    </div>
</template>

<script>
    export default {
        props: ['description', 'title', 'svg_d'],
        data() {
            return {
                more_information : false
            }
        },
        mounted() {

        },
        methods : {
            toggleMoreInformation()
            {
                this.more_information = this.more_information !== true;
                this.$emit("moreInformationClicked", {
                    'title' : this.title,
                    'more_information' : this.more_information
                });
            },
            turnOffModal() {
                this.more_information = false;
            }
        }
    }
</script>
