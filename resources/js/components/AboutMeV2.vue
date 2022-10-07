<template>

    <!-- ====== About Section Start -->
    <section :key="locale" id="about" class="ud-pt-[145px] ud-pb-[120px] ud-relative ud-z-10">
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
              {{ $lang.get('about.about_me') }}
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
                        {{ $lang.get('about.solving_problems') }}
                    </h2>
                    <p
                        class="
                ud-max-w-[570px] ud-font-medium ud-text-base ud-text-body-color
              "
                    >
                        {{ $lang.get('about.about_me_text') }}
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
                        {{ $lang.get('about.connect') }}
                    </h3>
                    <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-10">
                        {{ $lang.get('about.connect_text') }}
                    </p>
                    <div class="ud-flex md:ud-flex-row ud-flex-col ud-items-center md:ud-items-start ud-space-y-10 md:ud-space-y-0 ud-space-x-12">
                        <div class="ud-space-y-8">
                            <a
                                onclick="window.fathom.trackGoal('TMEFSIVC', 0);"
                                :href="this.$root.baseUrl() + '#contact'"
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
                                {{ $lang.get('home.contact') }}
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
                                <a
                                    href="javascript:void(0)"
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
                                        width="7"
                                        height="14"
                                        viewBox="0 0 7 14"
                                        class="ud-fill-current"
                                    >
                                        <path
                                            d="M6.50914 5.6H5.42429H5.03684V5.14839V3.74839V3.29677H5.42429H6.23793C6.45103 3.29677 6.62538 3.11613 6.62538 2.84516V0.451613C6.62538 0.203226 6.4704 0 6.23793 0H4.82374C3.29332 0 2.22783 1.26452 2.22783 3.13871V5.10323V5.55484H1.84038H0.523056C0.251842 5.55484 0 5.80323 0 6.16452V7.79032C0 8.10645 0.213097 8.4 0.523056 8.4H1.80164H2.18909V8.85161V13.3903C2.18909 13.7065 2.40218 14 2.71214 14H4.53315C4.64939 14 4.74625 13.9323 4.82374 13.8419C4.90123 13.7516 4.95935 13.5935 4.95935 13.4581V8.87419V8.42258H5.36617H6.23793C6.48977 8.42258 6.6835 8.24194 6.72224 7.97097V7.94839V7.92581L6.99346 6.36774C7.01283 6.20968 6.99345 6.02903 6.87722 5.84839C6.83848 5.73548 6.66412 5.62258 6.50914 5.6Z"
                                        />
                                    </svg>
                                </a>
                                <a
                                    href="javascript:void(0)"
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                </a>
                            </div>

                        </div>
                        <div>
                            <a class="ud-font-bold hover:ud-text-black ud-text-base ud-text-primary ud-mb-1"
                                href="mailto:florismeccanici@mecctech-solutions.nl">
                                florismeccanici@mecctech-solutions.nl
                            </a>
                            <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                                Delft, {{  $lang.get('footer.netherlands') }}

                            </p>
                            <a class="ud-font-bold hover:ud-text-black ud-text-base ud-text-primary ud-mb-1"
                                href="tel:+31681639449">
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
    <!-- ====== About Section End  -->
</template>

<script>
export default {
    name: "AboutMeV2",
    computed: {
        locale() {
            return this.$store.state.locale;
        }
    },
}
</script>

<style scoped>

</style>
