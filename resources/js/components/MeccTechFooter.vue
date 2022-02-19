<template>
    <div class="w-full text-black flex flex-col items-center justify-center h-80">
        <div class="flex p-10 items-center">
            <div class="grid grid-cols-3 gap-8 mb-5 mr-32">
                <i class="fa-brands fa-linkedin text-5xl hover:text-mecctech-red transition ease-in-out duration-500 cursor-pointer"></i>
                <i class="fa-brands fa-facebook text-5xl hover:text-mecctech-red transition ease-in-out duration-500 cursor-pointer"></i>
                <i class="fa-brands fa-instagram text-5xl hover:text-mecctech-red transition ease-in-out duration-500 cursor-pointer"></i>
            </div>

            <img @click="scrollToHome" class="w-32 hover:scale-110 transition duration-500 cursor-pointer" src="images/Mecctech_Solutions.png" alt="">
            <div class="flex flex-col items-left ml-10">
                <h1 class="font-bold">Floris Meccanici</h1>
                <h1 class="font-bold">MeccTech Solutions</h1>
                <h1 class="font-bold">+31681639449</h1>
                <h1 class="font-bold">KvK: 80904246</h1>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        mounted() {

        },
        methods : {
            scrollToHome() {
                document.getElementById('home').scrollIntoView();
            }
        }
    }
</script>
