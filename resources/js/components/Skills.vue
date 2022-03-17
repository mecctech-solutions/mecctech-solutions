<template>
    <div class="grid grid-cols-1 mt-5" :class="[ this.more_information ? 'md:grid-cols-3' : 'md:grid-cols-3' ]">
        <skill v-if="! this.more_information || this.more_information_skill === 'Requirements'" @more-information-clicked="handleMoreInformationClicked" description="I make sure it is clear what you want me to build." explanation="" title="Requirements" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Design'" @more-information-clicked="handleMoreInformationClicked" description="Visually appealing, dynamic and responsive user interface" explanation="" title="Design" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Functionality'" @more-information-clicked="handleMoreInformationClicked" description="Logic behind the scenes that is extensible and maintainable" explanation="" title="Functionality" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z"></skill>

        <!--  Dummy div to force text on third column -->
        <div v-if="this.more_information">
            <img v-show="this.more_information_skill === 'Functionality'" src="images/use_case.svg" alt="Functionality example Laravel" class="p-5">
        </div>

        <div v-if="this.more_information && this.more_information_skill === 'Requirements'" class="block pl-20 pr-32 pt-10 text-xl">
            <p>
                Through the use of so called domain stories I sketch out the application you want me to build, before writing any software. In the image below you see an example domain story that is part of a larger warehouse management system. After agreeing on the domain story, I make a design of the software and write acceptance tests with <code>phpunit</code> in Laravel.
            </p>
            <img src="images/Processing_an_order.dst.svg" alt="Domain story example" class="p-5">
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === 'Design'" class="block pl-20 pr-32 pt-10 text-xl">
            <p>
                Before writing any front end software I sketch a design in Figma according to your requirements. This way we can iterate on the design easily. After agreeing on the design, I start coding the user interface using HTML5, TailwindCSS and Vue.js. The user interface is always responsive (scales with different screen sizes) and I make them dynamic using Vue.js.
            </p>
            <img src="images/supra_solutions_figma.png" alt="Design using Figma example" class="p-5">
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === 'Functionality'" class="block pl-20 pr-32 pt-10 text-xl">
            <p>
                I am specialized in using Laravel to write the backbone of the application. My software is readable, scalable, extensible and maintainable. I achieve this by applying techniques like Domain Driven Design, Clean Architecture, Test Driven Development and Software Design Patterns.
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: [],
        data() {
            return {
                more_information : false,
                more_information_skill : ''
            }
        },
        mounted() {

        },
        methods : {
            handleMoreInformationClicked(input) {
                let title = input['title'];
                let moreInformation = input['more_information'];

                this.more_information = moreInformation;

                if (moreInformation)
                {
                    this.more_information_skill = title;
                } else {
                    this.more_information_skill = '';
                }
            }
        }
    }
</script>
