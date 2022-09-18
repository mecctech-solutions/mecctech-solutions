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
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full lg:ud-w-1/2 ud-self-center ud-px-4">
                    <div>
                        <h1 class="ud-text-base ud-font-semibold ud-text-primary ud-mb-3">
                            Hey There 👋 I am

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
                  Floris Meccanici
                </span>
                        </h1>
                        <h2
                            class="
                  ud-font-medium ud-text-body-color ud-text-lg
                  md:ud-text-xl
                  ud-mb-5
                "
                        >
                            Professional

                            <span class="ud-text-black">Laravel and Vue.js developer </span>
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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean
                            interdum consequat convallis.
                        </p>
                        <div class="ud-flex ud-items-center">
                            <a
                                href="javascript:void(0)"
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
                                Contact Me
                            </a>
                            <a
                                href="javascript:void(0)"
                                class="
                    ud-text-base
                    ud-font-semibold
                    ud-text-white
                    ud-bg-black
                    ud-py-3
                    ud-px-8
                    hover:ud-shadow-signUp hover:ud-bg-opacity-90
                    ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
                  "
                            >
                                Learn More
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
                            src="images/floris-removebg.png"
                            alt="image"
                            class="ud-max-w-full ud-mx-auto"
                        />
                        <span class="ud-absolute ud-lefter-[-8px] ud-bottom-2 ud--z-1">
                <svg
                    width="40"
                    height="38"
                    viewBox="0 0 40 38"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                      d="M9.31451 3.18282L32.4926 6.24789C36.3084 6.75249 38.147 11.1986 35.8021 14.2508L21.5587 32.7911C19.2138 35.8434 14.444 35.2126 12.9731 31.6558L4.03852 10.0504C2.56762 6.49355 5.49873 2.67822 9.31451 3.18282Z"
                      stroke="#e30613"
                      stroke-width="6"
                  />
                </svg>
              </span>
                    </div>
                </div>
            </div>
        </div>

        <div>
        <span class="ud-absolute ud-left-0 ud-top-32 ud--z-10">
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

<script>
export default {
    name: "HeroSection"
}
</script>

<style scoped>

</style>
