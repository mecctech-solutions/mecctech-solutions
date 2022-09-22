<template>
    <!-- ====== Page Title Section Start -->
    <section
        class="
        ud-relative
        ud-z-10
        ud-pt-[150px]
        ud-pb-[90px]
        ud-mb-20
        ud-overflow-hidden
        ud-mt-20
      "
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-items-center ud-mx-[-16px]">
                <div class="ud-w-full md:ud-w-8/12 lg:ud-w-7/12 ud-px-4">
                    <div class="ud-max-w-[570px] ud-mb-12 md:ud-mb-0">
                        <h1
                            class="
                  ud-font-bold ud-text-black ud-text-2xl
                  sm:ud-text-3xl
                  ud-mb-5
                "
                        >
                            Portfolio Details Page
                        </h1>
                        <p
                            class="
                  ud-font-medium
                  ud-text-base
                  ud-text-body-color
                  ud-leading-relaxed
                "
                        >
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In
                            varius eros eget sapien consectetur ultrices. Ut quis dapibus
                            libero.
                        </p>
                    </div>
                </div>
                <div class="ud-w-full md:ud-w-4/12 lg:ud-w-5/12 ud-px-4">
                    <div class="ud-text-end">
                        <ul class="ud-flex ud-items-center md:ud-justify-end">
                            <li class="ud-flex ud-items-center">
                                <a
                                    href="/"
                                    class="
                      ud-font-medium ud-text-base ud-text-body-color ud-pr-1
                      hover:ud-text-primary
                    "
                                >
                                    Home
                                </a>
                                <span
                                    class="
                      ud-block
                      ud-w-2
                      ud-h-2
                      ud-border-t-2
                      ud-border-r-2
                      ud-border-body-color
                      ud-rotate-45
                      ud-mr-3
                    "
                                ></span>
                            </li>
                            <li class="ud-font-medium ud-text-base ud-text-primary">
                                Portfolio Details
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <span class="ud-absolute ud-bottom-0 ud-left-0 ud-z-[-1]">
          <svg
              width="730"
              height="206"
              viewBox="0 0 730 206"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
          >
            <rect
                opacity="0.08"
                width="136.991"
                height="563.705"
                transform="matrix(0.632736 0.774368 0.774368 -0.632736 -201.278 330.677)"
                fill="url(#paint0_linear_0:1)"
            />
            <rect
                opacity="0.05"
                width="345.355"
                height="563.705"
                transform="matrix(0.632736 0.774368 0.774368 -0.632736 74 330.677)"
                fill="url(#paint1_linear_0:1)"
            />
            <defs>
              <linearGradient
                  id="paint0_linear_0:1"
                  x1="68.4956"
                  y1="0"
                  x2="68.4956"
                  y2="563.705"
                  gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#4A6CF7" />
                <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
              </linearGradient>
              <linearGradient
                  id="paint1_linear_0:1"
                  x1="172.678"
                  y1="0"
                  x2="172.678"
                  y2="563.705"
                  gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#4A6CF7" />
                <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </span>
            <span class="ud-absolute ud-top-0 ud-right-0 ud-z-[-1]">
          <svg
              width="405"
              height="206"
              viewBox="0 0 405 206"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
          >
            <rect
                opacity="0.08"
                width="289.718"
                height="563.705"
                transform="matrix(-0.707107 -0.707107 -0.707107 0.707107 603.461 -125.138)"
                fill="url(#paint0_linear_54:595)"
            />
            <defs>
              <linearGradient
                  id="paint0_linear_54:595"
                  x1="144.859"
                  y1="0"
                  x2="144.859"
                  y2="563.705"
                  gradientUnits="userSpaceOnUse"
              >
                <stop stop-color="#4A6CF7" />
                <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
              </linearGradient>
            </defs>
          </svg>
        </span>
        </div>
    </section>
    <!-- ====== Page Title Section End -->

    <!-- ====== Blog Section Start -->
    <section class="ud-pb-20">
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud--mx-5">
                <div class="ud-w-full lg:ud-w-8/12 ud-px-5">
                    <div>
                        <div class="ud-rounded-sm ud-mb-8">
                            <img
                                :src="this.$root.baseUrl() + '/images/portfolio/portfolio-details.jpg'"
                                alt="image"
                                class="ud-w-full ud-object-cover ud-object-center"
                            />
                        </div>
                        <h3
                            class="
                  ud-font-bold ud-text-black ud-text-2xl
                  sm:ud-text-4xl
                  lg:ud-text-3xl
                  ud-mb-7
                "
                        >
                            Professional graphics design
                        </h3>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-8
                "
                        >
                            Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat.
                        </p>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-10
                "
                        >
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            enim lobortis scelerisque fermentum. Neque sodales ut etiam sit
                            amet. Ligula ullamcorper proin libero nunc consequat interdum
                            varius. Quam pellentesque nec nam.
                        </p>
                        <h4
                            class="
                  ud-font-bold ud-text-xl
                  sm:ud-text-2xl
                  lg:ud-text-xl
                  xl:ud-text-2xl
                  ud-text-black ud-mb-8
                "
                        >
                            <span class="ud-text-primary">01.</span> Marketing solutions
                        </h4>
                        <ul class="ud-list ud-list-inside ud-list-disc ud-mb-7">
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    Consectetur adipiscing elit in voluptate velit.
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    Mattis vulputate cupidatat.
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    Vulputate enim nulla aliquet porttitor odio pellentesque
                  </span>
                            </li>
                            <li
                                class="
                    ud-text-base
                    sm:ud-text-lg
                    lg:ud-text-base
                    xl:ud-text-lg
                    ud-text-primary ud-mb-3
                  "
                            >
                  <span class="ud-text-body-color">
                    Ligula ullamcorper malesuada proin
                  </span>
                            </li>
                        </ul>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-10
                "
                        >
                            Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                            cupidatat.
                        </p>
                        <h4
                            class="
                  ud-font-bold ud-text-xl
                  sm:ud-text-2xl
                  lg:ud-text-xl
                  xl:ud-text-2xl
                  ud-text-black ud-mb-8
                "
                        >
                            <span class="ud-text-primary">02.</span> Branding solutions
                        </h4>
                        <p
                            class="
                  ud-text-base
                  sm:ud-text-lg
                  lg:ud-text-base
                  xl:ud-text-lg
                  ud-text-body-color ud-mb-8
                "
                        >
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis
                            enim lobortis scelerisque fermentum. Neque sodales ut etiam sit
                            door telium sieat amet.
                        </p>
                    </div>
                </div>
                <div class="ud-w-full lg:ud-w-4/12 ud-px-5">
                    <div
                        class="
                ud-bg-[#F8F9FF] ud-border ud-border-[#D7DFFF] ud-py-9 ud-px-6
                sm:ud-p-9
                lg:ud-px-6
                xl:ud-px-5
                ud-rounded-sm ud-mb-10
              "
                    >
                        <h3 class="ud-font-bold ud-text-primary ud-text-[22px] ud-mb-7">
                            Project Info
                        </h3>
                        <ul>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap ud-mb-3">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    Category
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    Branding, Design
                  </span>
                            </li>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap ud-mb-3">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    Date
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    June, 21, 2024
                  </span>
                            </li>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap ud-mb-3">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    Tags
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    Business, Consulting
                  </span>
                            </li>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap ud-mb-3">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    Website
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    www.yoursite.com
                  </span>
                            </li>
                            <li class="ud-flex lg:ud-flex-wrap xl:ud-flex-nowrap">
                  <span
                      class="
                      ud-max-w-[90px]
                      ud-w-full
                      ud-font-medium
                      ud-text-black
                      ud-text-base
                      ud-flex
                      ud-justify-between
                    "
                  >
                    Location
                    <span class="ud-text-body-color">:</span>
                  </span>
                                <span
                                    class="
                      ud-w-full
                      ud-font-medium
                      ud-text-body-color
                      ud-text-base
                      ud-pl-5
                      lg:ud-pl-0
                      xl:ud-pl-5
                    "
                                >
                    New York, USA
                  </span>
                            </li>
                        </ul>
                    </div>
                    <div
                        class="
                ud-bg-[#F8F9FF] ud-border ud-border-[#D7DFFF] ud-py-9 ud-px-6
                sm:ud-p-9
                lg:ud-px-6
                xl:ud-px-5
                ud-rounded-sm
              "
                    >
                        <h3 class="ud-font-bold ud-text-primary ud-text-[22px] ud-mb-7">
                            Downoad Files
                        </h3>
                        <ul>
                            <li class="ud-flex ud-mb-4">
                                <button
                                    class="
                      ud-w-full
                      ud-flex
                      ud-items-center
                      ud-font-medium
                      ud-text-base
                      ud-text-white
                      ud-bg-primary
                      ud-py-3
                      ud-px-5
                      ud-rounded-sm
                    "
                                >
                    <span class="ud-pr-2">
                      <svg
                          width="21"
                          height="21"
                          viewBox="0 0 21 21"
                          class="ud-fill-current"
                      >
                        <path
                            d="M5.00327 2.6569C4.56125 2.65777 4.13767 2.83419 3.82572 3.14736C3.51377 3.46053 3.339 3.88479 3.33986 4.32682L3.3659 17.6601C3.36676 18.1022 3.54318 18.5257 3.85635 18.8377C4.16952 19.1496 4.59379 19.3244 5.03581 19.3235L15.0358 19.304C15.4778 19.3032 15.9014 19.1267 16.2134 18.8136C16.5253 18.5004 16.7001 18.0761 16.6992 17.6341L16.6797 7.63411L11.6699 2.64389L5.00327 2.6569ZM5.00653 4.32357L10.8398 4.31218L10.848 8.47884L15.0146 8.4707L15.0325 17.6374L5.03256 17.6569L5.00653 4.32357ZM6.68621 10.987L6.68946 12.6536L13.3561 12.6406L13.3529 10.9739L6.68621 10.987ZM6.69271 14.3203L6.69597 15.987L10.8626 15.9788L10.8594 14.3122L6.69271 14.3203Z"
                        />
                      </svg>
                    </span>
                                    <span> Main-project-file.zif </span>
                                </button>
                            </li>
                            <li class="ud-flex">
                                <button
                                    class="
                      ud-w-full
                      ud-flex
                      ud-items-center
                      ud-font-medium
                      ud-text-base
                      ud-text-white
                      ud-bg-primary
                      ud-py-3
                      ud-px-5
                      ud-rounded-sm
                    "
                                >
                    <span class="ud-pr-2">
                      <svg
                          width="21"
                          height="21"
                          viewBox="0 0 21 21"
                          class="ud-fill-current"
                      >
                        <path
                            d="M5.00327 2.6569C4.56125 2.65777 4.13767 2.83419 3.82572 3.14736C3.51377 3.46053 3.339 3.88479 3.33986 4.32682L3.3659 17.6601C3.36676 18.1022 3.54318 18.5257 3.85635 18.8377C4.16952 19.1496 4.59379 19.3244 5.03581 19.3235L15.0358 19.304C15.4778 19.3032 15.9014 19.1267 16.2134 18.8136C16.5253 18.5004 16.7001 18.0761 16.6992 17.6341L16.6797 7.63411L11.6699 2.64389L5.00327 2.6569ZM5.00653 4.32357L10.8398 4.31218L10.848 8.47884L15.0146 8.4707L15.0325 17.6374L5.03256 17.6569L5.00653 4.32357ZM6.68621 10.987L6.68946 12.6536L13.3561 12.6406L13.3529 10.9739L6.68621 10.987ZM6.69271 14.3203L6.69597 15.987L10.8626 15.9788L10.8594 14.3122L6.69271 14.3203Z"
                        />
                      </svg>
                    </span>
                                    <span> Design-file.zif </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Blog Section End -->

    <!-- ====== Back To Top Start -->
    <a
        href="javascript:void(0)"
        class="
        ud-hidden
        ud-items-center
        ud-justify-center
        ud-bg-primary
        ud-text-white
        ud-w-10
        ud-h-10
        ud-rounded-sm
        ud-fixed
        ud-bottom-8
        ud-right-8
        ud-left-auto
        ud-z-[999]
        hover:ud-shadow-signUp
        ud-transition
        back-to-top
        ud-shadow-md
      "
    >
      <span
          class="
          ud-w-3
          ud-h-3
          ud-border-t
          ud-border-l
          ud-border-white
          ud-rotate-45
          ud-mt-[6px]
        "
      ></span>
    </a>
    <!-- ====== Back To Top End -->
</template>

<script>
    export default {
        props: ['title', 'tags', 'main_image_url', 'images', 'description', 'website_url'],
        data() {
            return {
                view_modal: false
            }
        },
        mounted() {

        },
        methods : {
            toggleModal()
            {
                this.view_modal = this.view_modal !== true;
            },
            turnOffModal() {
                this.view_modal = false;
            }
        }

    }
</script>

<style>
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }

    .container {
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        opacity: 0;
        transition: .5s ease-in-out;
        background-color: #FFFFFF;
    }

    .container:hover .overlay {
        opacity: 1;
    }

    .text {
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
</style>
