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
      ud-bg-white
    "
        :key="page.props.locale"
    >
        <div class="ud-container">
            <div
                class="
          ud-flex ud-mx-[-16px] ud-items-center ud-justify-between ud-relative
        "
            >
                <div class="ud-px-4 ud-w-44 ud-max-w-full">
                    <a
                        href="/"
                        class="header-logo ud-w-full ud-block ud-py-6 lg:ud-py-8"
                    >
                        <img :src="logoUrl" alt="logo" class="ud-w-full" />
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
                            :class="{ 'navbarTogglerActive': navbarActive }"
                            @click="toggleNavbar"
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
                            :class="{ 'ud-hidden': !navbarActive }"
                        >
                            <ul class="ud-blcok lg:ud-flex">
                                <li
                                    class="ud-relative ud-group"
                                    v-for="item in menuItems"
                                    :key="item.label"
                                    @click="navbarActive = false"
                                >
                                    <a
                                        :href="item.href"
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
                                        {{ item.label }}
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <LanguageSwitcher />
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import {computed, ref} from "vue";
import LanguageSwitcher from "./LanguageSwitcher.vue";
import {usePage} from "@inertiajs/vue3";
import {trans} from "laravel-vue-i18n";

const navbarActive = ref(false);
const toggleNavbar = () => {
    navbarActive.value = !navbarActive.value;
};

const page = usePage();
const logoUrl = computed(() => `${page.props.appUrl}/images/MeccTechlogo-01.png`);

const menuItems = computed(() => [
    { label: trans("header.home"), href: `${page.props.appUrl}#home` },
    { label: "Portfolio", href: `${page.props.appUrl}#portfolio` },
    { label: trans("header.clients"), href: `${page.props.appUrl}#clients` },
    { label: trans("header.skills"), href: `${page.props.appUrl}#skills` },
    { label: trans("header.approach"), href: `${page.props.appUrl}#approach` },
    { label: trans("header.contact"), href: `${page.props.appUrl}#contact` },
]);
</script>

<style scoped>
/* Add your styles here */
</style>
