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
                            <a
                                :href="page.props.appUrl + '#contact'"
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
                                {{ trans('home.contact') }}
                            </a>
                            <div class="ud-flex ud-items-center">
                                <a
                                    href="https://www.linkedin.com/in/florismeccanici"
                                    class="
                    ud-w-9
                    ud-h-9
                    ud-mr-3
                    ud-rounded-full
                    ud-flex
                    ud-items-center
                    ud-justify-center
                    ud-border
                    ud-border-[#E5E8F2]
                    ud-text-body-color
                    hover:ud-bg-primary
                    hover:ud-border-primary
                    hover:ud-text-white
                  "
                                    aria-label="social-link"
                                    name="social-link"
                                >
                                    <svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 14 14"
                                        class="ud-fill-current"
                                    >
                                        <path
                                            d="M13.0214 0H1.02084C0.453707 0 0 0.451613 0 1.01613V12.9839C0 13.5258 0.453707 14 1.02084 14H12.976C13.5432 14 13.9969 13.5484 13.9969 12.9839V0.993548C14.0422 0.451613 13.5885 0 13.0214 0ZM4.15142 11.9H2.08705V5.23871H4.15142V11.9ZM3.10789 4.3129C2.42733 4.3129 1.90557 3.77097 1.90557 3.11613C1.90557 2.46129 2.45002 1.91935 3.10789 1.91935C3.76577 1.91935 4.31022 2.46129 4.31022 3.11613C4.31022 3.77097 3.81114 4.3129 3.10789 4.3129ZM11.9779 11.9H9.9135V8.67097C9.9135 7.90323 9.89082 6.8871 8.82461 6.8871C7.73571 6.8871 7.57691 7.74516 7.57691 8.60322V11.9H5.51254V5.23871H7.53154V6.16452H7.55423C7.84914 5.62258 8.50701 5.08065 9.52785 5.08065C11.6376 5.08065 12.0232 6.43548 12.0232 8.2871V11.9H11.9779Z"
                                        />
                                    </svg>
                                </a>
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

const page = usePage();
const locale = computed(() => page.props.locale);
</script>
