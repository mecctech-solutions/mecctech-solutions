<template>
    <!-- ====== About Section Start -->
    <section
        :key="locale"
        id="about"
        class="ud-pt-[145px] ud-pb-[120px] ud-relative ud-z-10"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div
                    class="
            ud-w-full
            lg:ud-w-1/2
            xl:ud-w-7/12
            ud-px-4 ud-mb-8
            lg:ud-mb-0
          "
                >
          <span
              class="
              ud-font-bold ud-text-primary ud-text-lg
              md:ud-text-xl
              ud-mb-3
            "
          >
            {{ trans('about.about_me') }}
          </span>
                    <h2
                        class="
              ud-max-w-[400px] ud-font-bold ud-text-black ud-text-3xl
              sm:ud-text-4xl
              md:ud-text-[45px]
              ud-leading-tight
              sm:ud-leading-tight
              md:ud-leading-tight
              ud-mb-5
            "
                    >
                        {{ trans('about.solving_problems') }}
                    </h2>
                    <p
                        class="
              ud-max-w-[570px] ud-font-medium ud-text-base ud-text-body-color
            "
                    >
                        {{ trans('about.about_me_text') }}
                    </p>
                </div>
                <div class="ud-w-full lg:ud-w-1/2 xl:ud-w-5/12 ud-px-4">
                    <h3
                        class="
              ud-font-semibold ud-text-black ud-text-2xl
              md:ud-text-3xl
              ud-mb-6
            "
                    >
                        {{ trans('about.connect') }}
                    </h3>
                    <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-10">
                        {{ trans('about.connect_text') }}
                    </p>
                    <div
                        class="ud-flex md:ud-flex-row ud-flex-col ud-items-center md:ud-items-start ud-space-y-10 md:ud-space-y-0 ud-space-x-12"
                    >
                        <div class="ud-space-y-8">
                            <PrimaryButton
                                :url="page.props.appUrl + '#contact'"
                                :text="trans('home.contact')"
                            ></PrimaryButton>
                            <div class="ud-flex ud-items-center">
                                <SocialLink
                                    border
                                    url="https://www.linkedin.com/in/florismeccanici/"
                                    type="linkedin"
                                />
                                <SocialLink
                                    border
                                    url="https://github.com/mecctech-solutions"
                                    type="github"
                                />
                            </div>
                        </div>
                        <div>
                            <a
                                class="ud-font-bold hover:ud-text-black ud-text-base ud-text-primary ud-mb-1"
                                href="mailto:florismeccanici@mecctech-solutions.nl"
                            >
                                florismeccanici@mecctech-solutions.nl
                            </a>
                            <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                                Delft, {{ trans('footer.netherlands') }}
                            </p>
                            <a
                                class="ud-font-bold hover:ud-text-black ud-text-base ud-text-primary ud-mb-1"
                                href="tel:+31681639449"
                            >
                                +31 6 81639449
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ud-absolute ud-right-0 ud-top-1/2 -translate-y-1/2 ud--z-50">
            <svg
                width="60"
                height="120"
                viewBox="0 0 60 120"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <circle cx="60" cy="60" r="60" fill="url(#paint0_radial_18:24)" />
                <defs>
                    <radialGradient
                        id="paint0_radial_18:24"
                        cx="0"
                        cy="0"
                        r="1"
                        gradientUnits="userSpaceOnUse"
                        gradientTransform="translate(60) rotate(90) scale(120)"
                    >
                        <stop stop-color="white" />
                        <stop offset="0.569" stop-color="#e1cdce" />
                        <stop offset="0.993" stop-color="#e29a9e" />
                    </radialGradient>
                </defs>
            </svg>
        </div>
    </section>
    <!-- ====== About Section End -->
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import {trans} from "laravel-vue-i18n";
import SocialLink from "@/Components/SocialLink.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const page = usePage();
const locale = computed(() => page.props.locale);
</script>
