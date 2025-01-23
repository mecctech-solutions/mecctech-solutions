<template>
    <section
        id="testimonials"
        class="ud-py-[120px] ud-bg-[#f8f9ff]"
        :key="locale"
    >
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div class="ud-max-w-[600px] ud-mx-auto ud-text-center ud-mb-[70px]">
                        <span class="ud-font-semibold ud-text-lg ud-text-primary ud-block ud-mb-2">
                            {{ trans('testimonials.testimonials') }}
                        </span>
                        <h2 class="ud-font-bold ud-text-black ud-text-3xl sm:ud-text-4xl md:ud-text-[45px] ud-mb-5">
                            {{ trans('testimonials.what_clients_say') }}
                        </h2>
                    </div>
                </div>
            </div>

            <div v-for="client in clients" :key="client.id" class="ud-mb-12">
                <div v-for="testimonial in client.testimonials" :key="testimonial.id"
                     class="ud-w-full md:ud-w-1/2 lg:ud-w-1/3 ud-px-4">
                    <div class="ud-bg-white ud-p-8 ud-rounded-lg ud-shadow-testimonial ud-mb-10">
                        <div class="ud-flex ud-items-center ud-mb-5">
                            <img
                                :src="testimonial.image_full_url"
                                :alt="testimonial.name"
                                class="ud-w-20 ud-h-20 ud-rounded-full ud-object-cover"
                            />
                            <div class="ud-ml-4">
                                <h3 class="ud-font-semibold ud-text-lg ud-text-black">
                                    {{ testimonial.name }}
                                </h3>
                                <p class="ud-text-base ud-text-body-color">
                                    {{ testimonial.position }} @ {{ client.name }}
                                </p>
                            </div>
                        </div>
                        <p class="ud-text-body-color ud-text-base ud-leading-relaxed">
                            {{ locale === 'nl' ? testimonial.text_nl : testimonial.text_en }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {computed} from 'vue';
import {usePage} from '@inertiajs/vue3';
import {trans} from 'laravel-vue-i18n';

const page = usePage();
const locale = computed(() => page.props.locale);
const clients = computed(() => page.props.clients);
</script>
