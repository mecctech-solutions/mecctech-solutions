<template>
    <!-- ====== Clients Section Start  -->
    <section
        id="clients"
        class="ud-py-[120px] ud-bg-white ud-relative"
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
                <div class="ud-w-full ud-border-b ud-pb-[120px] ud-px-4">
                    <div
                        class="
              ud-flex ud-flex-wrap ud-items-center ud-justify-center
              wow
              fadeInUp
            "
                        data-wow-delay=".1s"
                    >
                        <ClientLogo
                            v-for="client in clients"
                            :key="client.id"
                            :imageUrl="client.logo_full_url"
                            :imageAlt="client.name"
                            :websiteUrl="client.website_url"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {computed} from "vue";
import {trans} from "laravel-vue-i18n";
import {usePage} from "@inertiajs/vue3";
import ClientLogo from "@/Components/ClientLogo.vue";
import ClientData = App.Data.ClientData;

const page = usePage();
const clients: ClientData[] = page.props.clients;

const locale = computed(() => page.props.appUrl);
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
