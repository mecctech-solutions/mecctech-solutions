<template>
    <nav v-if="! this.isMobile" id="header" class="sticky top-0 z-50">
        <ul class="flex space-x-5 bg-black text-xl text-white border-b border-b-4" style="border-color: #e30613;">
            <li id="header-home" @click="scrollTo('home'); selectNavElement('home')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">HOME</li>
            <li id="header-about-me" @click="scrollTo('about-me'); selectNavElement('about-me')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">ABOUT ME</li>
            <li id="header-portfolio" @click="scrollTo('projects'); selectNavElement('portfolio')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">PORTFOLIO</li>
            <li id="header-contact" @click="scrollTo('contact'); selectNavElement('contact')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">CONTACT</li>
        </ul>
    </nav>
    <nav class="sticky top-0 z-50" v-else>
        <ul @click=this.toggleMobileNavbarCollapse class="flex bg-black text-white border-b border-b-4" style="border-color: #e30613;">
            <i class="fas fa-bars text-3xl p-3"></i>
        </ul>
        <ul class="bg-black text-white" v-show="collapseMobileNavbar === true">
            <li id="header-home" @click="scrollTo('home'); selectNavElement('home')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">HOME</li>
            <li id="header-about-me" @click="scrollTo('about-me'); selectNavElement('about-me')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">ABOUT ME</li>
            <li id="header-portfolio" @click="scrollTo('projects'); selectNavElement('portfolio')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">PORTFOLIO</li>
            <li id="header-contact" @click="scrollTo('contact'); selectNavElement('contact')" class="p-5 hover:text-mecctech-red ease-in-out duration-500 cursor-pointer">CONTACT</li>
        </ul>
    </nav>
</template>

<script>

    export default {
        data() {
            return {
                collapseMobileNavbar: false
            }
        },
        methods : {
            scrollTo(navElement) {
                let el = document.getElementById(navElement);
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
                document.getElementById('header-home').style.color = "#ffffff";
                document.getElementById('header-about-me').style.color = "#ffffff";
                document.getElementById('header-portfolio').style.color = "#ffffff";
                document.getElementById('header-contact').style.color = "#ffffff";
            },
            makeNavElementTextRed(elementName) {
                document.getElementById(elementName).style.color = "#e30613";
            },
            isMobile() {
                return screen.width <= 760;
            },
            toggleMobileNavbarCollapse() {
                this.collapseMobileNavbar = this.collapseMobileNavbar !== true;
            }
        }
    }
</script>
