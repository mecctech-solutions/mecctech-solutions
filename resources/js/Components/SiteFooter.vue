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
                    <a
                        href="https://www.linkedin.com/in/florismeccanici"
                        class="
              ud-flex
              ud-items-center
              ud-justify-center
              ud-w-8
              ud-h-8
              ud-founded-full
              ud-mx-2
              ud-text-body-color
              hover:ud-text-primary
            "
                        aria-label="social-link"
                        name="social-link"
                    >
                        <svg
                            width="32"
                            height="32"
                            viewBox="0 0 32 32"
                            class="ud-fill-current"
                        >
                            <path
                                d="M16 0C7.16479 0 0 7.16479 0 16C0 24.8352 7.16479 32 16 32C24.8352 32 32 24.8352 32 16C32 7.16479 24.8352 0 16 0ZM11.3506 24.1875H7.45386V12.4641H11.3506V24.1875ZM9.40234 10.8633H9.37695C8.06934 10.8633 7.22363 9.96313 7.22363 8.83813C7.22363 7.68774 8.09521 6.8125 9.42822 6.8125C10.7612 6.8125 11.5815 7.68774 11.6069 8.83813C11.6069 9.96313 10.7612 10.8633 9.40234 10.8633ZM25.4014 24.1875H21.5051V17.9158C21.5051 16.3396 20.9409 15.2646 19.531 15.2646C18.4546 15.2646 17.8135 15.9897 17.5317 16.6897C17.4287 16.9402 17.4036 17.2903 17.4036 17.6406V24.1875H13.5071C13.5071 24.1875 13.5581 13.564 13.5071 12.4641H17.4036V14.124C17.9214 13.3252 18.8479 12.189 20.9153 12.189C23.479 12.189 25.4014 13.8645 25.4014 17.4653V24.1875Z"
                            />
                        </svg>
                    </a>
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

const page = usePage();
const locale = computed(() => page.props.locale);
</script>
