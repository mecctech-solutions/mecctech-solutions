<template>
    <nav id="header" class="sticky top-0 z-50">
        <ul class="flex space-x-5 bg-black text-xl text-white border-b border-b-4" style="border-color: #e30613;">
            <li id="header-home" @click="scrollToHome(); selectNavElement('home')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">HOME</li>
            <li id="header-about-me" @click="scrollToAboutMe(); selectNavElement('about-me')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">ABOUT ME</li>
            <li id="header-portfolio" @click="scrollToPortfolio(); selectNavElement('portfolio')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">PORTFOLIO</li>
            <li id="header-contact" @click="scrollToContactForm(); selectNavElement('contact')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">CONTACT</li>
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
            scrollToPortfolio() {
                let el = document.getElementById('projects');
                el.scrollIntoView();
            },
            scrollToContactForm() {
                let el = document.getElementById('contact');
                el.scrollIntoView();
            },
            scrollToAboutMe() {
                let el = document.getElementById('about-me');
                el.scrollIntoView();
            },
            selectNavElement(navElement) {
                this.makeAllNavElementsTextWhite();
                if (navElement === 'home')
                {
                    this.makeNavElementTextRed('header-home');
                } else if (navElement === 'about-me')
                {
                    this.makeNavElementTextRed('header-about-me');
                } else if (navElement === 'portfolio')
                {
                    this.makeNavElementTextRed('header-portfolio');
                } else if (navElement === 'contact')
                {
                    this.makeNavElementTextRed('header-contact');
                }
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
