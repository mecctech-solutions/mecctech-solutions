<template>
    <div class="m-auto flex flex-col items-center">
        <img class="w-96" src="images/Mecctech_Solutions.png" alt="">
        <h1 class="text-4xl pb-28 mt-5 mr-4">E-commerce web applications.</h1>

        <p class="text-5xl">Hi, I'm <span class="text-mecctech-red font-bold">Floris Meccanici</span>.</p>
        <p class="text-3xl ml-10">I'm a <span class="typing"></span></p>
        <button @click="scrollToPortfolio" class="btn view-my-work-btn mt-24 text-2xl">View my work</button>
    </div>
</template>

<script>
    import Typed from "typed.js";

    export default {
        mounted() {
            console.log('Component mounted.');

            var typed = new Typed(".typing", {
                strings: ['full-stack web developer.', 'Laravel developer.', 'Vue.js developer.', 'freelancer.', 'software engineer.'],
                typeSpeed: 100,
                backSpeed: 60,
                loop: true
            });
        },
        methods : {
            scrollToPortfolio()
            {
                let el = document.getElementById('projects');
                el.scrollIntoView();
            }

        }
    }
</script>
