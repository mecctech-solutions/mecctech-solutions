<template>
    <footer
        id="footer"
        class="ud-bg-black ud-pt-[100px] ud-pb-12 ud-relative ud-z-10"
        :key="locale"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud--mx-4">
                <div class="ud-w-full md:ud-w-1/2 lg:ud-w-4/12 ud-px-4">
                    <div class="ud-mb-10">
                        <h2
                            class="
                ud-font-bold
                ud-text-white
                ud-text-[44px]
                ud-leading-tight
                ud-mb-5
              "
                        >
                            {{ trans('footer.lets_talk') }}
                        </h2>
                        <h3
                            class="
                ud-font-bold ud-text-white ud-opacity-70 ud-text-2xl ud-mb-2
              "
                        >
                            {{ trans('footer.info') }}
                        </h3>
                        <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                            florismeccanici@mecctech-solutions.nl
                        </p>
                        <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                            Delft, {{ trans('footer.netherlands') }}
                        </p>
                        <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                            +31 6 81639449
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="
          ud-mt-10 ud-pt-12 ud-border-t ud-border-white ud-border-opacity-10
        "
            >
                <div class="ud-flex ud-items-center ud-justify-center ud-mb-5">
                    <SocialLink
                        url="https://www.linkedin.com/in/florismeccanici/"
                        type="linkedin"
                    />
                    <SocialLink
                        url="https://github.com/mecctech-solutions"
                        type="github"
                    />
                </div>
            </div>
        </div>
        <div
            class="ud-absolute ud-left-0 ud-bottom-0 ud--z-1"
            aria-label="shape"
            name="shape"
        >
            <span class="ud-hidden">shape</span>
        </div>
        <div
            class="ud-absolute ud-right-3 ud-top-3 ud--z-1"
            aria-label="shape"
            name="shape"
        >
            <span class="ud-hidden">shape</span>
        </div>
    </footer>
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import {trans} from "laravel-vue-i18n";
import SocialLink from "@/Components/SocialLink.vue";

const page = usePage();
const locale = computed(() => page.props.locale);
</script>
