<template>
    <!-- ====== Clients Section Start  -->
    <section
        id="clients"
        class="ud-pt-20 ud-pb-[250px] ud-bg-white ud-relative"
        :key="locale"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div class="ud-max-w-[570px] ud-mx-auto ud-mb-12 ud-text-center">
                                    <span
                                        class="
                ud-font-semibold ud-text-lg ud-text-primary ud-block ud-mb-2
              "
                                    >
              {{ trans("clients.clients") }}
            </span>
                        <h2
                            class="
                ud-font-bold ud-text-3xl
                md:ud-text-4xl
                ud-text-black ud-mb-4
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
                        <ClientLogo imageUrl="/images/clients/nina_care_logo.svg" imageAlt="Nina Care" websiteUrl="https://www.nina.care/" />
                        <ClientLogo imageUrl="/images/clients/hds_logo.png" imageAlt="Home Design Shops" websiteUrl="https://www.homedesignshops.nl/" />
                        <ClientLogo imageUrl="/images/clients/depotop_logo.svg" imageAlt="De Pot Op" websiteUrl="https://www.depotop.nu/" />
                        <ClientLogo imageUrl="/images/clients/supra_solutions_logo.png" imageAlt="Supra Solutions" websiteUrl="https://www.supra-solutions.com/" />
                        <ClientLogo imageUrl="/images/clients/ryberg_logo.png" imageAlt="Ryberg" websiteUrl="https://www.ryberg.nl/" />
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
import ClientLogo from "@/Components/ClientLogo.vue";

const page = usePage();
const locale = computed(() => page.props.appUrl);
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
