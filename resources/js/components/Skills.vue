<template>
    <div class="grid grid-cols-1 mt-5" :class="[ this.more_information ? 'md:grid-cols-3' : 'md:grid-cols-3' ]">
        <skill v-if="! this.more_information || this.more_information_skill === 'Requirements'" @more-information-clicked="handleMoreInformationClicked" description="I make sure it is clear what you want me to build." explanation="" title="Requirements" svg_d="M362.7 19.32C387.7-5.678 428.3-5.678 453.3 19.32L492.7 58.75C517.7 83.74 517.7 124.3 492.7 149.3L444.3 197.7L314.3 67.72L362.7 19.32zM421.7 220.3L188.5 453.4C178.1 463.8 165.2 471.5 151.1 475.6L30.77 511C22.35 513.5 13.24 511.2 7.03 504.1C.8198 498.8-1.502 489.7 .976 481.2L36.37 360.9C40.53 346.8 48.16 333.9 58.57 323.5L291.7 90.34L421.7 220.3z" view_box="0 0 512 512"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Design'" @more-information-clicked="handleMoreInformationClicked" description="Visually appealing, dynamic and responsive user interface" explanation="" title="Design" svg_d="M224 0H336C362.5 0 384 21.49 384 48V256H0V48C0 21.49 21.49 0 48 0H64L96 64L128 0H160L192 64L224 0zM384 288V320C384 355.3 355.3 384 320 384H256V448C256 483.3 227.3 512 192 512C156.7 512 128 483.3 128 448V384H64C28.65 384 0 355.3 0 320V288H384zM192 464C200.8 464 208 456.8 208 448C208 439.2 200.8 432 192 432C183.2 432 176 439.2 176 448C176 456.8 183.2 464 192 464z" view_box="0 0 384 512"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Functionality'" @more-information-clicked="handleMoreInformationClicked" description="Logic behind the scenes that is extensible and maintainable" explanation="" title="Functionality" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z" view_box="0 0 24 24"></skill>

        <!--  Dummy div to force text on third column -->
        <div v-if="this.more_information">
            <img v-show="this.more_information_skill === 'Functionality'" src="images/use_case.svg" alt="Functionality example Laravel" class="p-5">
        </div>

        <div v-if="this.more_information && this.more_information_skill === 'Requirements'" class="block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                Through the use of so called domain stories I sketch out the application you want me to build, before writing any software. In the image below you see an example domain story that is part of a larger warehouse management system. After agreeing on the domain story, I make a design of the software and write acceptance tests with <code>phpunit</code> in Laravel.
            </p>
            <img src="images/Processing_an_order.dst.svg" alt="Domain story example" class="p-5">
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === 'Design'" class="block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                Before writing any front end software I sketch a design in Figma according to your requirements. This way we can iterate on the design easily. After agreeing on the design, I start coding the user interface using HTML5, TailwindCSS and Vue.js. The user interface is always responsive (scales with different screen sizes) and I make them dynamic using Vue.js.
            </p>
            <img src="images/supra_solutions_figma.png" alt="Design using Figma example" class="p-5">
        </div>

        <div v-else-if="this.more_information && this.more_information_skill === 'Functionality'" class="block pl-20 pr-20 md:pr-32 pt-10 text-xl">
            <p>
                I am specialized in using Laravel to write the backbone of the application. My software is readable, scalable, extensible and maintainable. I achieve this by applying techniques like Domain Driven Design, Clean Architecture, Test Driven Development and Software Design Patterns.
            </p>
        </div>
    </div>
</template>

<script>
    import Skill from './Skill'

    export default {
        props: [],
        data() {
            return {
                more_information : false,
                more_information_skill : ''
            }
        },
        components: {
            Skill
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
