<template>
    <div class="flex flex-col items-center">
        <h1 class="text-4xl font-bold mt-10">HOW I WORK</h1>
        <div class="border-t border-4 border-black mt-5 w-1/16"></div>

        <skills></skills>

        <div class="m-10 flex flex-col md:flex-row justify-center items-center md:space-x-20">
            <img class="rounded-full p-10" src="images/floris.jpeg" alt="">

            <div class="flex flex-col items-center md:w-1/4">
                <h1 class="text-3xl font-bold mt-10 mb-5">Who am I?</h1>
                <p class="text-2xl text-center md:text-left">I'm a full-stack web developer and freelancer specialized in writing e-commerce software in Laravel / PHP and Vue.js. Count on me to write extensible and maintainable web applications for your e-commerce business, thus increasing your revenue.</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['description', 'title', 'svg_d', 'view_box'],
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
