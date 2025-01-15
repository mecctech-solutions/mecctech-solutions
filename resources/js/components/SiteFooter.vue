<template>
    <footer id="footer" class="ud-bg-black ud-pt-[100px] ud-pb-12 ud-relative ud-z-10" :key="locale">
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
                            {{  $lang.get('footer.lets_talk') }}
                        </h2>
                        <h3
                            class="
                  ud-font-bold ud-text-white ud-opacity-70 ud-text-2xl ud-mb-2
                "
                        >
                            {{  $lang.get('footer.info') }}
                        </h3>
                        <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                            florismeccanici@mecctech-solutions.nl
                        </p>
                        <p class="ud-font-medium ud-text-base ud-text-body-color ud-mb-1">
                            Delft, {{  $lang.get('footer.netherlands') }}

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
                    <a
                        href="javascript:void(0)"
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
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M32 16C32 7.1625 24.8375 0 16 0C7.1625 0 0 7.1625 0 16C0 24.8375 7.1625 32 16 32C16.0938 32 16.1875 32 16.2812 31.9937V19.5438H12.8438V15.5375H16.2812V12.5875C16.2812 9.16875 18.3688 7.30625 21.4188 7.30625C22.8813 7.30625 24.1375 7.4125 24.5 7.4625V11.0375H22.4C20.7437 11.0375 20.4188 11.825 20.4188 12.9812V15.5312H24.3875L23.8687 19.5375H20.4188V31.3813C27.1063 29.4625 32 23.3062 32 16Z"
                            />
                        </svg>
                    </a>
                    <a
                        href="javascript:void(0)"
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
                                d="M19.0625 16C19.0625 17.6914 17.6914 19.0625 16 19.0625C14.3086 19.0625 12.9375 17.6914 12.9375 16C12.9375 14.3086 14.3086 12.9375 16 12.9375C17.6914 12.9375 19.0625 14.3086 19.0625 16Z"
                            />
                            <path
                                d="M23.1621 10.5813C23.0149 10.1824 22.78 9.82129 22.4749 9.5249C22.1785 9.21973 21.8176 8.98486 21.4185 8.83765C21.0947 8.71191 20.6084 8.56226 19.7126 8.52148C18.7437 8.47729 18.4531 8.46777 16 8.46777C13.5466 8.46777 13.2561 8.47705 12.2874 8.52124C11.3916 8.56226 10.905 8.71191 10.5815 8.83765C10.1824 8.98486 9.82129 9.21973 9.52515 9.5249C9.21997 9.82129 8.98511 10.1821 8.83765 10.5813C8.71191 10.905 8.56226 11.3916 8.52148 12.2874C8.47729 13.2561 8.46777 13.5466 8.46777 16C8.46777 18.4531 8.47729 18.7437 8.52148 19.7126C8.56226 20.6084 8.71191 21.0947 8.83765 21.4185C8.98511 21.8176 9.21973 22.1785 9.5249 22.4749C9.82129 22.78 10.1821 23.0149 10.5813 23.1621C10.905 23.2881 11.3916 23.4377 12.2874 23.4785C13.2561 23.5227 13.5464 23.532 15.9998 23.532C18.4534 23.532 18.7439 23.5227 19.7124 23.4785C20.6082 23.4377 21.0947 23.2881 21.4185 23.1621C22.2197 22.853 22.853 22.2197 23.1621 21.4185C23.2878 21.0947 23.4375 20.6084 23.4785 19.7126C23.5227 18.7437 23.532 18.4531 23.532 16C23.532 13.5466 23.5227 13.2561 23.4785 12.2874C23.4377 11.3916 23.2881 10.905 23.1621 10.5813ZM16 20.7175C13.3943 20.7175 11.282 18.6055 11.282 15.9998C11.282 13.394 13.3943 11.282 16 11.282C18.6055 11.282 20.7178 13.394 20.7178 15.9998C20.7178 18.6055 18.6055 20.7175 16 20.7175ZM20.9043 12.198C20.2954 12.198 19.8018 11.7043 19.8018 11.0955C19.8018 10.4866 20.2954 9.99292 20.9043 9.99292C21.5132 9.99292 22.0068 10.4866 22.0068 11.0955C22.0066 11.7043 21.5132 12.198 20.9043 12.198Z"
                            />
                            <path
                                d="M16 0C7.16479 0 0 7.16479 0 16C0 24.8352 7.16479 32 16 32C24.8352 32 32 24.8352 32 16C32 7.16479 24.8352 0 16 0ZM25.1321 19.7878C25.0876 20.7659 24.9321 21.4336 24.7051 22.0181C24.2278 23.2522 23.2522 24.2278 22.0181 24.7051C21.4338 24.9321 20.7659 25.0874 19.7881 25.1321C18.8083 25.1768 18.4954 25.1875 16.0002 25.1875C13.5049 25.1875 13.1921 25.1768 12.2122 25.1321C11.2344 25.0874 10.5664 24.9321 9.98218 24.7051C9.3689 24.4744 8.81372 24.1128 8.35474 23.6453C7.88745 23.1865 7.52588 22.6311 7.29517 22.0181C7.06812 21.4338 6.9126 20.7659 6.86816 19.7881C6.823 18.8081 6.8125 18.4951 6.8125 16C6.8125 13.5049 6.823 13.1919 6.86792 12.2122C6.91235 11.2341 7.06763 10.5664 7.29468 9.98193C7.52539 9.3689 7.88721 8.81348 8.35474 8.35474C8.81348 7.88721 9.3689 7.52563 9.98193 7.29492C10.5664 7.06787 11.2341 6.9126 12.2122 6.86792C13.1919 6.82324 13.5049 6.8125 16 6.8125C18.4951 6.8125 18.8081 6.82324 19.7878 6.86816C20.7659 6.9126 21.4336 7.06787 22.0181 7.29468C22.6311 7.52539 23.1865 7.88721 23.6455 8.35474C24.1128 8.81372 24.4746 9.3689 24.7051 9.98193C24.9324 10.5664 25.0876 11.2341 25.1323 12.2122C25.177 13.1919 25.1875 13.5049 25.1875 16C25.1875 18.4951 25.177 18.8081 25.1321 19.7878Z"
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
            <svg
                width="143"
                height="138"
                viewBox="0 0 143 138"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <circle
                    cx="25"
                    cy="118"
                    r="101"
                    stroke="url(#paint0_linear_52:83)"
                    stroke-width="34"
                />
                <defs>
                    <linearGradient
                        id="paint0_linear_52:83"
                        x1="-12.7969"
                        y1="-37.3359"
                        x2="99.2109"
                        y2="173.773"
                        gradientUnits="userSpaceOnUse"
                    >
                        <stop stop-color="#4A6CF7" />
                        <stop offset="1" stop-color="#4A6CF7" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div
            class="ud-absolute ud-right-3 ud-top-3 ud--z-1"
            aria-label="shape"
            name="shape"
        >
            <span class="ud-hidden">shape</span>
            <svg
                width="61"
                height="77"
                viewBox="0 0 61 77"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <g opacity="0.5">
                    <circle
                        cx="45.0001"
                        cy="1.66667"
                        r="1.66667"
                        transform="rotate(90 45.0001 1.66667)"
                        fill="white"
                    />
                    <circle
                        cx="16.0001"
                        cy="1.66667"
                        r="1.66667"
                        transform="rotate(90 16.0001 1.66667)"
                        fill="white"
                    />
                    <circle
                        cx="59.0001"
                        cy="1.66667"
                        r="1.66667"
                        transform="rotate(90 59.0001 1.66667)"
                        fill="white"
                    />
                    <circle
                        cx="30.6668"
                        cy="1.66667"
                        r="1.66667"
                        transform="rotate(90 30.6668 1.66667)"
                        fill="white"
                    />
                    <circle
                        cx="1.66683"
                        cy="1.66667"
                        r="1.66667"
                        transform="rotate(90 1.66683 1.66667)"
                        fill="white"
                    />
                    <circle
                        cx="45.0001"
                        cy="16.3332"
                        r="1.66667"
                        transform="rotate(90 45.0001 16.3332)"
                        fill="white"
                    />
                    <circle
                        cx="16.0001"
                        cy="16.3332"
                        r="1.66667"
                        transform="rotate(90 16.0001 16.3332)"
                        fill="white"
                    />
                    <circle
                        cx="59.0001"
                        cy="16.3332"
                        r="1.66667"
                        transform="rotate(90 59.0001 16.3332)"
                        fill="white"
                    />
                    <circle
                        cx="30.6668"
                        cy="16.3332"
                        r="1.66667"
                        transform="rotate(90 30.6668 16.3332)"
                        fill="white"
                    />
                    <circle
                        cx="1.66683"
                        cy="16.3332"
                        r="1.66667"
                        transform="rotate(90 1.66683 16.3332)"
                        fill="white"
                    />
                    <circle
                        cx="45.0001"
                        cy="31.0002"
                        r="1.66667"
                        transform="rotate(90 45.0001 31.0002)"
                        fill="white"
                    />
                    <circle
                        cx="45.0001"
                        cy="74.6667"
                        r="1.66667"
                        transform="rotate(90 45.0001 74.6667)"
                        fill="white"
                    />
                    <circle
                        cx="16.0001"
                        cy="31.0002"
                        r="1.66667"
                        transform="rotate(90 16.0001 31.0002)"
                        fill="white"
                    />
                    <circle
                        cx="16.0001"
                        cy="74.6667"
                        r="1.66667"
                        transform="rotate(90 16.0001 74.6667)"
                        fill="white"
                    />
                    <circle
                        cx="59.0001"
                        cy="31.0002"
                        r="1.66667"
                        transform="rotate(90 59.0001 31.0002)"
                        fill="white"
                    />
                    <circle
                        cx="59.0001"
                        cy="74.6667"
                        r="1.66667"
                        transform="rotate(90 59.0001 74.6667)"
                        fill="white"
                    />
                    <circle
                        cx="30.6668"
                        cy="31.0002"
                        r="1.66667"
                        transform="rotate(90 30.6668 31.0002)"
                        fill="white"
                    />
                    <circle
                        cx="30.6668"
                        cy="74.6667"
                        r="1.66667"
                        transform="rotate(90 30.6668 74.6667)"
                        fill="white"
                    />
                    <circle
                        cx="1.66683"
                        cy="31.0002"
                        r="1.66667"
                        transform="rotate(90 1.66683 31.0002)"
                        fill="white"
                    />
                    <circle
                        cx="1.66683"
                        cy="74.6667"
                        r="1.66667"
                        transform="rotate(90 1.66683 74.6667)"
                        fill="white"
                    />
                    <circle
                        cx="45.0001"
                        cy="45.6667"
                        r="1.66667"
                        transform="rotate(90 45.0001 45.6667)"
                        fill="white"
                    />
                    <circle
                        cx="16.0001"
                        cy="45.6667"
                        r="1.66667"
                        transform="rotate(90 16.0001 45.6667)"
                        fill="white"
                    />
                    <circle
                        cx="59.0001"
                        cy="45.6667"
                        r="1.66667"
                        transform="rotate(90 59.0001 45.6667)"
                        fill="white"
                    />
                    <circle
                        cx="30.6668"
                        cy="45.6667"
                        r="1.66667"
                        transform="rotate(90 30.6668 45.6667)"
                        fill="white"
                    />
                    <circle
                        cx="1.66683"
                        cy="45.6667"
                        r="1.66667"
                        transform="rotate(90 1.66683 45.6667)"
                        fill="white"
                    />
                    <circle
                        cx="45.0001"
                        cy="60.3332"
                        r="1.66667"
                        transform="rotate(90 45.0001 60.3332)"
                        fill="white"
                    />
                    <circle
                        cx="16.0001"
                        cy="60.3332"
                        r="1.66667"
                        transform="rotate(90 16.0001 60.3332)"
                        fill="white"
                    />
                    <circle
                        cx="59.0001"
                        cy="60.3332"
                        r="1.66667"
                        transform="rotate(90 59.0001 60.3332)"
                        fill="white"
                    />
                    <circle
                        cx="30.6668"
                        cy="60.3332"
                        r="1.66667"
                        transform="rotate(90 30.6668 60.3332)"
                        fill="white"
                    />
                    <circle
                        cx="1.66683"
                        cy="60.3332"
                        r="1.66667"
                        transform="rotate(90 1.66683 60.3332)"
                        fill="white"
                    />
                </g>
            </svg>
        </div>
    </footer>
</template>

<script>
export default {
    name: "SiteFooter",
    computed: {
        locale() {
            return this.$store.state.locale;
        }
    },
}
</script>

<style scoped>

</style>
