<template>
    <header
        class="
        header
        ud-absolute
        ud-top-0
        ud-left-0
        ud-z-40
        ud-w-full
        ud-flex
        ud-items-center
        ud-transition
        ud-bg-transparent
      "
    >
        <div class="ud-container">
            <div
                class="
            ud-flex ud-mx-[-16px] ud-items-center ud-justify-between ud-relative
          "
            >
                <div class="ud-px-4 ud-w-60 ud-max-w-full">
                    <a
                        href="/"
                        class="header-logo ud-w-full ud-block ud-py-6 lg:ud-py-8"
                    >
                        <img :src="this.$root.baseUrl() + '/images/Mecctech_Solutions.png'" alt="logo" class="ud-w-full" />
                    </a>
                </div>
                <div
                    class="ud-flex ud-px-4 ud-justify-between ud-items-center ud-w-full"
                >
                    <div>
                        <button
                            id="navbarToggler"
                            name="navbarToggler"
                            aria-label="navbarToggler"
                            class="
                  ud-block
                  ud-absolute
                  ud-right-4
                  ud-top-1/2
                  ud-translate-y-[-50%]
                  lg:ud-hidden
                  focus:ud-ring-2
                  ud-ring-primary ud-px-3 ud-py-[6px] ud-rounded-lg
                "
                        :class="{ 'navbarTogglerActive' : this.navbarActive}"
                        @click="this.toggleNavbar"
                        >
                <span
                    class="
                    ud-relative
                    ud-w-[30px]
                    ud-h-[2px]
                    ud-my-[6px]
                    ud-block
                    ud-bg-dark
                  "
                ></span>
                            <span
                                class="
                    ud-relative
                    ud-w-[30px]
                    ud-h-[2px]
                    ud-my-[6px]
                    ud-block
                    ud-bg-dark
                  "
                            ></span>
                            <span
                                class="
                    ud-relative
                    ud-w-[30px]
                    ud-h-[2px]
                    ud-my-[6px]
                    ud-block
                    ud-bg-dark
                  "
                            ></span>
                        </button>
                        <nav
                            id="navbarCollapse"
                            class="
                  ud-absolute ud-py-5
                  lg:ud-py-0 lg:ud-px-4
                  xl:ud-px-6
                  ud-bg-white
                  lg:ud-bg-transparent
                  ud-shadow-lg ud-rounded-lg ud-max-w-[250px] ud-w-full
                  lg:ud-max-w-full lg:ud-w-full
                  ud-right-4 ud-top-full
                  lg:ud-block lg:ud-static lg:ud-shadow-none
                "
                            :class="{ 'ud-hidden' : ! this.navbarActive }"
                        >
                            <ul class="ud-blcok lg:ud-flex">
                                <li class="ud-relative ud-group" @click="this.navbarActive = false">
                                    <a
                                        href="#home"
                                        class="
                        menu-scroll
                        ud-text-base ud-text-black
                        group-hover:ud-text-primary
                        ud-py-2
                        lg:ud-py-6 lg:ud-inline-flex lg:ud-px-0
                        ud-flex ud-mx-8
                        lg:ud-mr-0
                      "
                                    >
                                        Home
                                    </a>
                                </li>
                                <li class="ud-relative ud-group" @click="this.navbarActive = false">
                                    <a
                                        :href="this.$root.baseUrl() + '#about'"
                                        class="
                        menu-scroll
                        ud-text-base ud-text-black
                        group-hover:ud-text-primary
                        ud-py-2
                        lg:ud-py-6 lg:ud-inline-flex lg:ud-px-0
                        ud-flex ud-mx-8
                        lg:ud-mr-0 lg:ud-ml-8
                        xl:ud-ml-12
                      "
                                    >
                                        About
                                    </a>
                                </li>
                                <li class="ud-relative ud-group" @click="this.navbarActive = false">
                                    <a
                                        :href="this.$root.baseUrl() + '#services'"
                                        class="
                        menu-scroll
                        ud-text-base ud-text-black
                        group-hover:ud-text-primary
                        ud-py-2
                        lg:ud-py-6 lg:ud-inline-flex lg:ud-px-0
                        ud-flex ud-mx-8
                        lg:ud-mr-0 lg:ud-ml-8
                        xl:ud-ml-12
                      "
                                    >
                                        Services
                                    </a>
                                </li>
                                <li class="ud-relative ud-group" @click="this.navbarActive = false">
                                    <a
                                        :href="this.$root.baseUrl() + '#contact'"
                                        class="
                        menu-scroll
                        ud-text-base ud-text-black
                        group-hover:ud-text-primary
                        ud-py-2
                        lg:ud-py-6 lg:ud-inline-flex lg:ud-px-0
                        ud-flex ud-mx-8
                        lg:ud-mr-0 lg:ud-ml-8
                        xl:ud-ml-12
                      "
                                    >
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div
                        class="sm:ud-flex ud-justify-end ud-hidden ud-pr-16 lg:ud-pr-0"
                    >
                        <a
                            href="#contact"
                            class="
                  ud-text-base
                  ud-font-bold
                  ud-text-white
                  ud-bg-primary
                  ud-rounded-full
                  ud-py-3
                  ud-px-8
                  md:ud-px-9
                  lg:ud-px-8
                  xl:ud-px-9
                  hover:ud-shadow-signUp hover:ud-bg-opacity-90
                  ud-transition ud-ease-in-out ud-duration-300
                "
                        >
                            Contact Me
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "MeccTechHeaderV2",
    data() {
        return {
            navbarActive: false
        }
    },
    methods: {
        toggleNavbar()
        {
            this.navbarActive = ! this.navbarActive;
        },
    }
}
</script>

<style scoped>

</style>
