<template>
    <!-- ====== Clients Section Start  -->
    <section
        id="clients"
        class="ud-pt-20 ud-pb-[250px] ud-bg-black ud-relative"
        :key="locale"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div class="ud-max-w-[570px] ud-mx-auto ud-mb-12 ud-text-center">
                        <h2
                            class="
                ud-font-bold ud-text-3xl
                md:ud-text-4xl
                ud-text-white ud-mb-4
              "
                        >
                            {{ trans('clients.happy_clients') }}
                        </h2>
                        <p class="ud-font-medium ud-text-lg ud-text-body-color">
                            {{ trans('clients.happy_clients_text') }}
                        </p>
                    </div>
                </div>
                <div class="ud-w-full ud-px-4">
                    <div
                        class="
              ud-flex ud-flex-wrap ud-items-center ud-justify-center
              wow
              fadeInUp
            "
                        data-wow-delay=".1s"
                    >
                        <a
                            href="https://www.homedesignshops.nl/"
                            target="_blank"
                            rel="nofollow noreferrer"
                            class="
                ud-flex ud-items-center ud-justify-center ud-max-w-[120px]
                lg:ud-max-w-[130px]
                xl:ud-max-w-[150px]
                2xl:ud-max-w-[160px]
                ud-mx-3
                sm:ud-mx-4
                xl:ud-mx-6
                2xl:ud-mx-8
                ud-py-[15px] ud-grayscale
                hover:ud-grayscale-0
                ud-opacity-60
                hover:ud-opacity-100
                ud-transition
              "
                        >
                            <img src="/images/clients/hds_logo.png" alt="home_design_shops" />
                        </a>
                        <a
                            href="https://www.depotop.nu/"
                            target="_blank"
                            rel="nofollow noreferrer"
                            class="
                ud-flex ud-items-center ud-justify-center ud-max-w-[120px]
                lg:ud-max-w-[130px]
                xl:ud-max-w-[150px]
                2xl:ud-max-w-[160px]
                ud-mx-3
                sm:ud-mx-4
                xl:ud-mx-6
                2xl:ud-mx-8
                ud-py-[15px] ud-grayscale
                hover:ud-grayscale-0
                ud-opacity-60
                hover:ud-opacity-100
                ud-transition
              "
                        >
                            <img src="/images/clients/depotop_logo.svg" alt="depotop" />
                        </a>
                        <a
                            href="https://www.supra-solutions.com/"
                            target="_blank"
                            rel="nofollow noreferrer"
                            class="
                ud-flex ud-items-center ud-justify-center ud-max-w-[120px]
                lg:ud-max-w-[130px]
                xl:ud-max-w-[150px]
                2xl:ud-max-w-[160px]
                ud-mx-3
                sm:ud-mx-4
                xl:ud-mx-6
                2xl:ud-mx-8
                ud-py-[15px] ud-grayscale
                hover:ud-grayscale-0
                ud-opacity-60
                hover:ud-opacity-100
                ud-transition
              "
                        >
                            <img src="/images/clients/supra_solutions_logo.png" alt="supra_solutions" />
                        </a>
                        <a
                            href="https://www.ryberg.nl/"
                            target="_blank"
                            rel="nofollow noreferrer"
                            class="
                ud-flex ud-items-center ud-justify-center ud-max-w-[120px]
                lg:ud-max-w-[130px]
                xl:ud-max-w-[150px]
                2xl:ud-max-w-[160px]
                ud-mx-3
                sm:ud-mx-4
                xl:ud-mx-6
                2xl:ud-mx-8
                ud-py-[15px] ud-grayscale
                hover:ud-grayscale-0
                ud-opacity-60
                hover:ud-opacity-100
                ud-transition
              "
                        >
                            <img src="/images/clients/ryberg_logo.png" alt="ryberg" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Clients Section End  -->
</template>

<script setup>
import {computed} from "vue";
import {trans} from "laravel-vue-i18n";
import {usePage} from "@inertiajs/vue3";

const page = usePage();
const locale = computed(() => page.props.appUrl);
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
