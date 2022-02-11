<template>
    <div class="m-auto flex flex-col items-center">
        <img class="pb-32" src="images/Mecctech_Solutions.png" alt="">
        <p class="text-5xl">Hi, I'm <span class="text-mecctech-red font-bold">Floris Meccanici</span>.</p>
        <p class="text-3xl ml-10">I'm a <span class="typing"></span></p>
        <button @click="scrollToHeader" class="btn view-my-work-btn mt-20 text-2xl">View my work</button>
    </div>
</template>

<script>
    import Typed from "typed.js";

    export default {
        mounted() {
            console.log('Component mounted.');

            var typed = new Typed(".typing", {
                strings: ['full-stack web developer.', 'freelancer.', 'software engineer.', 'Laravel developer.', 'PHP developer.', 'Vue.js developer.'],
                typeSpeed: 100,
                backSpeed: 60,
                loop: true
            });
        },
        methods : {
            scrollToHeader() {
                var el = document.getElementById("header");
                console.log(el);
                el.scrollIntoView();
            }
        }
    }
</script>
