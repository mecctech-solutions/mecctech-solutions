<template>
    <div class="grid grid-cols-1 md:grid-cols-3 mt-5" :class="{ more_information : 'md:grid-cols-2' }">
        <skill v-if="! this.more_information || this.more_information_skill === 'Requirements'" @more-information-clicked="handleMoreInformationClicked" description="I make sure it is clear what you want me to build." explanation="" title="Requirements" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Design'" @more-information-clicked="handleMoreInformationClicked" description="Visually appealing, dynamic and responsive user interface" explanation="" title="Design" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z"></skill>
        <skill v-if="! this.more_information || this.more_information_skill === 'Functionality'" @more-information-clicked="handleMoreInformationClicked" description="Logic behind the scenes that is extensible and maintainable" explanation="" title="Functionality" svg_d="M3,16H12V21H3V16M2,10H8V15H2V10M9,10H15V15H9V10M16,10H22V15H16V10M13,16H21V21H13V16M3,4H11V9H3V4M12,4H21V9H12V4Z"></skill>
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
