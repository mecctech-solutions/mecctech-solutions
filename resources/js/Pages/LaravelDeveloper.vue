<script setup lang="ts">
import {Head, usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import {trans} from 'laravel-vue-i18n';
import HomeLayout from '../Layouts/HomeLayout.vue';
import HeroSection from '../Components/HeroSection.vue';
import AboutMeLaravel from '../Components/AboutMeLaravel.vue';
import Portfolio from '../Components/Portfolio.vue';
import Testimonials from '../Components/Testimonials.vue';
import Clients from '../Components/Clients.vue';
import Skills from '../Components/Skills.vue';
import ContactForm from '../Components/ContactForm.vue';

defineProps({
    portfolioItems: {
        type: Array,
        required: true,
    },
    testimonials: {
        type: Array,
        required: true,
    },
    clients: {
        type: Array,
        required: true,
    },
});

const page = usePage();
const locale = computed(() => page.props.locale);
</script>

<template>
    <Head :title="trans('laravel_developer.title')" />

    <HomeLayout>
        <HeroSection
            :label="trans('laravel_developer.hero_label')"
            :title="trans('laravel_developer.hero_title')"
            :body="trans('laravel_developer.hero_text')"
            :primary-button-text="trans('laravel_developer.cta_contact')"
            :primary-button-url="page.props.appUrl + '#contact'"
            :secondary-button-text="trans('laravel_developer.cta_tech_stack')"
            secondary-button-href="#skills"
        />
        <AboutMeLaravel />
        <Portfolio :portfolio-items="portfolioItems" />
        <Clients :clients="clients" />
        <Testimonials />

        <!-- What to expect -->
        <section
            class="ud-py-[80px] ud-border-t ud-border-[#E9ECF8]"
            :key="'what-' + locale"
        >
            <div class="ud-container">
                <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                    <div class="ud-w-full ud-px-4">
                        <div class="ud-max-w-[600px] ud-mb-12">
                            <h2
                                class="ud-font-bold ud-text-black ud-text-2xl sm:ud-text-3xl md:ud-text-4xl ud-mb-3"
                            >
                                {{ trans('laravel_developer.section_what_title') }}
                            </h2>
                            <p class="ud-font-medium ud-text-body-color ud-text-base">
                                {{ trans('laravel_developer.section_what_intro') }}
                            </p>
                        </div>
                        <ul
                            class="ud-grid ud-grid-cols-1 md:ud-grid-cols-2 ud-gap-4 ud-list-none ud-pl-0"
                        >
                            <li
                                class="ud-font-medium ud-text-body-color ud-text-base ud-flex ud-items-start ud-gap-2"
                            >
                                <span
                                    class="ud-text-primary ud-font-bold ud-shrink-0"
                                    aria-hidden="true"
                                    >→</span
                                >
                                {{ trans('laravel_developer.what_architecture') }}
                            </li>
                            <li
                                class="ud-font-medium ud-text-body-color ud-text-base ud-flex ud-items-start ud-gap-2"
                            >
                                <span
                                    class="ud-text-primary ud-font-bold ud-shrink-0"
                                    aria-hidden="true"
                                    >→</span
                                >
                                {{ trans('laravel_developer.what_testing') }}
                            </li>
                            <li
                                class="ud-font-medium ud-text-body-color ud-text-base ud-flex ud-items-start ud-gap-2"
                            >
                                <span
                                    class="ud-text-primary ud-font-bold ud-shrink-0"
                                    aria-hidden="true"
                                    >→</span
                                >
                                {{ trans('laravel_developer.what_ci') }}
                            </li>
                            <li
                                class="ud-font-medium ud-text-body-color ud-text-base ud-flex ud-items-start ud-gap-2"
                            >
                                <span
                                    class="ud-text-primary ud-font-bold ud-shrink-0"
                                    aria-hidden="true"
                                    >→</span
                                >
                                {{ trans('laravel_developer.what_code') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- How I work -->
        <section
            class="ud-py-[80px] ud-border-t ud-border-[#E9ECF8] ud-bg-[#FAFAFA]"
            :key="'how-' + locale"
        >
            <div class="ud-container">
                <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                    <div class="ud-w-full ud-px-4 ud-mb-12">
                        <div class="ud-max-w-[600px]">
                            <h2
                                class="ud-font-bold ud-text-black ud-text-2xl sm:ud-text-3xl md:ud-text-4xl ud-mb-3"
                            >
                                {{ trans('laravel_developer.section_how_title') }}
                            </h2>
                            <p class="ud-font-medium ud-text-body-color ud-text-base">
                                {{ trans('laravel_developer.section_how_intro') }}
                            </p>
                        </div>
                    </div>
                    <div class="ud-w-full ud-px-4">
                        <div class="ud-grid ud-grid-cols-1 md:ud-grid-cols-3 ud-gap-8">
                            <div class="ud-bg-white ud-p-6 ud-rounded-lg ud-shadow-sm ud-border ud-border-[#E9ECF8]">
                                <h3 class="ud-font-bold ud-text-black ud-text-lg ud-mb-3">
                                    {{ trans('laravel_developer.how_new_title') }}
                                </h3>
                                <p class="ud-font-medium ud-text-body-color ud-text-sm ud-leading-relaxed">
                                    {{ trans('laravel_developer.how_new_text') }}
                                </p>
                            </div>
                            <div class="ud-bg-white ud-p-6 ud-rounded-lg ud-shadow-sm ud-border ud-border-[#E9ECF8]">
                                <h3 class="ud-font-bold ud-text-black ud-text-lg ud-mb-3">
                                    {{ trans('laravel_developer.how_existing_title') }}
                                </h3>
                                <p class="ud-font-medium ud-text-body-color ud-text-sm ud-leading-relaxed">
                                    {{ trans('laravel_developer.how_existing_text') }}
                                </p>
                            </div>
                            <div class="ud-bg-white ud-p-6 ud-rounded-lg ud-shadow-sm ud-border ud-border-[#E9ECF8]">
                                <h3 class="ud-font-bold ud-text-black ud-text-lg ud-mb-3">
                                    {{ trans('laravel_developer.how_team_title') }}
                                </h3>
                                <p class="ud-font-medium ud-text-body-color ud-text-sm ud-leading-relaxed">
                                    {{ trans('laravel_developer.how_team_text') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tech stack -->
        <Skills />

        <!-- Contact -->
        <ContactForm />
    </HomeLayout>
</template>
