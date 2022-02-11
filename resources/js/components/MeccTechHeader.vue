<template>
    <nav id="header">
        <ul class="flex space-x-5 bg-black text-xl text-white border-b border-b-4" style="border-color: #e30613;">
            <li id="header-home" @click="scrollToHome(); makeAllNavElementsTextWhite(); makeNavElementTextRed('header-home')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">HOME</li>
            <li id="header-about-me" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">ABOUT ME</li>
            <li class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">PORTFOLIO</li>
            <li class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">CONTACT</li>
        </ul>
    </nav>
</template>

<script>

    export default {
        mounted() {

        },
        methods : {
            scrollToHome() {
                let el = document.getElementById('home');
                el.scrollIntoView();
            },
            makeAllNavElementsTextWhite() {
                document.getElementById('header-home').style.color = "#fffff";
                document.getElementById('header-about-me').style.color = "#ffffff";
                document.getElementById('header-portfolio').style.color = "#ffffff";
                document.getElementById('header-contact').style.color = "#ffffff";
            },
            makeNavElementTextRed(elementName) {
                document.getElementById(elementName).style.color = "#e30613";
            }
        }
    }
</script>
