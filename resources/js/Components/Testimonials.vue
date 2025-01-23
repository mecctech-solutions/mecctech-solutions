<template>
    <section class="ud-pt-[120px] ud-pb-20">
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div class="ud-mx-auto ud-max-w-[570px] ud-text-center ud-mb-[100px]">
                        <h2 class="ud-text-black ud-font-bold ud-text-3xl ud-sm:text-4xl ud-md:text-[45px] ud-mb-4">
                            {{ t('home.testimonials.title') }}
                        </h2>
                        <p class="ud-text-body-color ud-text-base ud-md:text-lg">
                            {{ t('home.testimonials.subtitle') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div v-for="testimonial in testimonials" :key="testimonial.id"
                    class="ud-w-full ud-md:w-1/2 ud-lg:w-1/3 ud-px-4">
                    <div class="ud-p-8 ud-bg-white ud-rounded-[10px] ud-shadow-testimonial ud-mb-10">
                        <div class="ud-flex ud-items-center ud-mb-5">
                            <div class="ud-w-[50px] ud-h-[50px] ud-rounded-full ud-overflow-hidden ud-mr-4">
                                <img :src="testimonial.image_full_url" :alt="testimonial.name"
                                    class="ud-w-full" />
                            </div>
                            <div>
                                <h3 class="ud-text-black ud-font-semibold ud-text-lg ud-mb-1">
                                    {{ testimonial.name }}
                                </h3>
                                <p class="ud-text-body-color ud-text-base">
                                    {{ testimonial.job_title }}
                                </p>
                            </div>
                        </div>
                        <p class="ud-text-body-color ud-text-base ud-leading-relaxed">
                            {{ t('locale') === 'nl' ? testimonial.text_nl : testimonial.text_en }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import {useI18n} from 'vue-i18n';

const { t } = useI18n();
const testimonials = computed(() => usePage().props.testimonials);
</script>
