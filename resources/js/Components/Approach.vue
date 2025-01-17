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
                    <ApproachItem v-for="item in approachItems" :key="item.title" :title="item.title" :text="item.text" :icon="item.icon" :subtitle="item.subtitle" />
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
import ApproachItem from "@/Components/ApproachItem.vue";

const page = usePage();
const locale = computed(() => page.props.locale);

const approachItems = computed(() => [
    {
        title: trans('approach.approach.discovery.title'),
        subtitle: trans('approach.approach.discovery.subtitle'),
        text: trans('approach.approach.discovery.text'),
        icon: 'ProfileHourGlass',
    },
    {
        title: trans('approach.approach.planning_design.title'),
        subtitle: trans('approach.approach.planning_design.subtitle'),
        text: trans('approach.approach.planning_design.text'),
        icon: 'Draft',
    },
    {
        title: trans('approach.approach.development.title'),
        subtitle: trans('approach.approach.development.subtitle'),
        text: trans('approach.approach.development.text'),
        icon: 'Blocks',
    },
    {
        title: trans('approach.approach.testing_qa.title'),
        subtitle: trans('approach.approach.testing_qa.subtitle'),
        text: trans('approach.approach.testing_qa.text'),
        icon: 'Checkmark',
    },
    {
        title: trans('approach.approach.deployment_delivery.title'),
        subtitle: trans('approach.approach.deployment_delivery.subtitle'),
        text: trans('approach.approach.deployment_delivery.text'),
        icon: 'Rocket',
    },
    {
        title: trans('approach.approach.support_iteration.title'),
        subtitle: trans('approach.approach.support_iteration.subtitle'),
        text: trans('approach.approach.support_iteration.text'),
        icon: 'Repeat',
    },
]);
</script>

<style scoped></style>
