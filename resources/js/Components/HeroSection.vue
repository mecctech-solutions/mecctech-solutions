<template>
    <!-- ====== Hero Section Start -->
    <section
        id="home"
        class="
      ud-relative ud-z-10 ud-pt-[150px]
      lg:ud-pt-[100px]
      2xl:ud-flex
      ud-items-center
      2xl:ud-h-[700px]
    "
        :key="locale"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full lg:ud-w-1/2 ud-self-center ud-px-4">
                    <div>
                        <h1 class="ud-text-base ud-font-semibold ud-text-primary ud-mb-3">
                            {{ trans('home.hi') }}
                            <span
                                class="
                  ud-font-bold ud-text-black ud-text-3xl
                  sm:ud-text-3xl
                  md:ud-text-[45px]
                  ud-leading-tight
                  sm:ud-leading-tight
                  md:ud-leading-[50px]
                  ud-block ud-mt-1
                "
                            >
                {{ trans('home.name') }}
              </span>
                        </h1>
                        <h2
                            class="
                ud-font-medium ud-text-body-color ud-text-lg
                md:ud-text-xl
                ud-mb-5
              "
                        >
                            {{ trans('home.freelance') }}
                            <span class="ud-text-black">{{ trans('home.i_am') }} </span>
                        </h2>
                        <p
                            class="
                ud-max-w-[470px]
                ud-font-medium
                ud-text-body-color
                ud-text-base
                ud-leading-relaxed
                ud-mb-11
              "
                        >
                            {{ trans('home.headline') }}
                        </p>
                        <div class="ud-flex ud-items-center ud-gap-3 ud-flex-wrap sm:ud-flex-nowrap">
                            <PrimaryButton
                                :url="page.props.appUrl + '#contact'"
                                :text="trans('home.contact')"
                            ></PrimaryButton>
                            <a
                                href="#portfolio"
                                class="
                  ud-text-base
                  ud-font-semibold
                  ud-text-white
                  ud-bg-black
                  ud-py-3
                  ud-px-6
                  hover:ud-shadow-signUp hover:ud-bg-opacity-90
                  ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
                  ud-whitespace-nowrap
                "
                            >
                                {{ trans('home.learn_more') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="ud-w-full lg:ud-w-1/2 ud-self-end ud-px-4">
                    <div
                        class="
              ud-relative ud-mt-12
              lg:ud-mt-0
              ud-z-10
              2xl:ud-absolute 2xl:ud-bottom-0 2xl:ud-right-40
            "
                    >
                        <img
                            src="images/floris_new.png"
                            alt="image"
                            class="ud-max-w-full ud-mx-auto"
                        />
                        <span class="ud-absolute ud-lefter-[-8px] ud-bottom-2 ud--z-1"></span>
                    </div>
                </div>
            </div>
        </div>
        <div>
      <span class="ud-absolute ud-left-0 ud-top-64 ud--z-10">
        <svg
            width="48"
            height="95"
            viewBox="0 0 48 95"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
          <circle
              cx="0.5"
              cy="47.5"
              r="47.5"
              fill="url(#paint0_radial_6:121)"
          />
          <defs>
            <radialGradient
                id="paint0_radial_6:121"
                cx="0"
                cy="0"
                r="1"
                gradientUnits="userSpaceOnUse"
                gradientTransform="translate(0.5) rotate(90) scale(95)"
            >
              <stop stop-color="white" />
              <stop offset="0.569" stop-color="#e1cdce" />
              <stop offset="0.993" stop-color="#e29a9e" />
            </radialGradient>
          </defs>
        </svg>
      </span>
            <span class="ud-absolute ud-right-0 ud-bottom-0 ud--z-10">
        <svg
            width="491"
            height="490"
            viewBox="0 0 491 490"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
          <circle
              cx="356.5"
              cy="356.5"
              r="356.5"
              fill="url(#paint0_linear_6:37)"
          />
          <defs>
            <linearGradient
                id="paint0_linear_6:37"
                x1="356.5"
                y1="0"
                x2="356.5"
                y2="713"
                gradientUnits="userSpaceOnUse"
            >
              <stop stop-color="#e05b62" />
              <stop offset="1" stop-color="#e30613" />
            </linearGradient>
          </defs>
        </svg>
      </span>
        </div>
    </section>
    <!-- ====== Hero Section End -->
</template>

<script setup>
import {computed} from "vue";
import {usePage} from "@inertiajs/vue3";
import {trans} from "laravel-vue-i18n";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const page = usePage();
const locale = computed(() => page.props.locale);
</script>
