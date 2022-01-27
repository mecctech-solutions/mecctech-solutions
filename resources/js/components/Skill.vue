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
    </div>
</template>

<script>
    export default {
        props: ['description', 'title', 'svg_d'],
        mounted() {

        }
    }
</script>
