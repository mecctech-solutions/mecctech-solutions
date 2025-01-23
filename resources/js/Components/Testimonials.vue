<template>
    <section class="ud-pt-[120px] ud-pb-20">
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

            <div class="ud-grid grid-cols-1 md:ud-grid-cols-2 lg:ud-grid-cols-3 ud-gap-x-3">
                <div v-for="testimonial in testimonials" :key="testimonial.id">
                    <div class="ud-p-8 ud-bg-white ud-rounded-[10px] ud-shadow-testimonial ud-mb-10">
                        <div class="ud-flex ud-items-center ud-mb-5 ud-space-x-5">
                            <img
                                :src="testimonial.image_full_url"
                                :alt="testimonial.name"
                                class="ud-w-20 ud-h-20 ud-rounded-full ud-object-cover"
                            />
                            <div>
                                <h3 class="ud-text-black ud-font-semibold ud-text-lg ud-mb-1">
                                    {{ testimonial.name }}
                                </h3>
                                <p class="ud-text-body-color ud-text-base">
                                    {{ locale === 'nl' ? testimonial.job_title_nl : testimonial.job_title_en }}
                                </p>
                            </div>
                        </div>
                        <div 
                            class="ud-text-body-color ud-text-base ud-leading-relaxed prose prose-sm max-w-none"
                            v-html="locale === 'nl' ? testimonial.text_nl : testimonial.text_en"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import {usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import {trans} from "laravel-vue-i18n";

const testimonials = computed(() => usePage().props.testimonials);
const locale = computed(() => usePage().props.locale);

</script>

<style>
.prose {
    @apply ud-text-gray-600;
}

.prose p {
    @apply ud-mb-4;
}

.prose ul {
    @apply ud-list-disc ud-pl-4 ud-mb-4;
}

.prose ol {
    @apply ud-list-decimal ud-pl-4 ud-mb-4;
}

.prose li {
    @apply ud-mb-2;
}

.prose a {
    @apply ud-text-primary hover:ud-text-primary-dark ud-underline;
}

.prose strong {
    @apply ud-font-semibold;
}

.prose em {
    @apply ud-italic;
}
</style>
