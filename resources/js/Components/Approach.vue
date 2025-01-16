<template>
    <section id="approach" :key="locale">
        <div class="ud-container">

            <div class="ud-pt-[120px] ud-pb-[90px] ud-border-t ud-border-[#E9ECF8]">
                <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                    <div class="ud-w-full ud-px-4">
                        <div
                            class="ud-max-w-[600px] ud-mx-auto ud-text-center ud-mb-[70px]"
                        >
                <span
                    class="
                    ud-font-semibold ud-text-lg ud-text-primary ud-block ud-mb-2
                  "
                >
                  {{ trans('approach.how_i_work') }}
                </span>
                            <h2
                                class="
                    ud-font-bold ud-text-black ud-text-3xl
                    sm:ud-text-4xl
                    md:ud-text-[45px]
                    ud-mb-5
                  "
                            >
                                {{ trans('approach.my_approach') }}
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                    <ApproachItem :title="trans('approach.requirements')" :text="trans('approach.requirements_text')" :icon="'ProfileHourGlass'"/>
                    <ApproachItem :title="trans('approach.tests')" :text="trans('approach.tests_text')" :icon="'Grid'"/>
                    <ApproachItem :title="trans('approach.development')" :text="trans('approach.development_text')" :icon="'Blocks'"/>
                </div>
                <div class="
                    ud-flex
                    ud-items-center
                    ud-flex-col
                    ">
                    <a
                        :href="page.props.appUrl + '/case-study'"
                        class="
                    ud-text-base
                    ud-font-semibold
                    ud-text-white
                    ud-bg-primary
                    ud-py-3
                    ud-px-8
                    ud-mr-4
                    hover:ud-shadow-signUp hover:ud-bg-opacity-90
                    ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
                  "
                    >
                        Case study
                    </a>
                </div>
            </div>

        </div>
    </section>
    <!-- ====== Services Section End  -->
</template>

<script setup>
import {computed} from "vue";
import {trans} from "laravel-vue-i18n";
import {usePage} from "@inertiajs/vue3";
import ProfileHourGlass from "@/Components/Icons/ProfileHourGlass.vue";
import ApproachItem from "@/Components/ApproachItem.vue";

const page = usePage();
const locale = computed(() => page.props.locale);

const approaches = [
    {
        title: trans('approach.requirements'),
        text: trans('approach.requirements_text'),
        iconPath:
            "M22.8335 14.0001C27.0002 14.0001 30.3335 17.3334 30.3335 21.5001C30.3335...",
        iconWidth: 35,
        iconHeight: 33,
    },
    {
        title: trans('approach.tests'),
        text: trans('approach.tests_text'),
        iconPath:
            "M18.6668 28.6666C18.6668 28.1666 18.6668 27.4999 18.8335 26.9999H10.3335...",
        iconWidth: 36,
        iconHeight: 36,
    },
    {
        title: trans('approach.development'),
        text: trans('approach.development_text'),
        iconPath:
            "M16.6667 0V13.3333H30V0H16.6667ZM0 30H13.3333V16.6667H0V30ZM0...",
        iconWidth: 30,
        iconHeight: 30,
    },
    {
        title: trans('approach.user_interface'),
        text: trans('approach.user_interface_text'),
        iconPath:
            "M20 0.166748C21.5471 0.166748 23.0308 0.78133 24.1248 1.87529...",
        iconWidth: 40,
        iconHeight: 25,
    },
];
</script>

<style scoped></style>
