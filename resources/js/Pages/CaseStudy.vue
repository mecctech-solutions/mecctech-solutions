<template>
  <Head :title="title" />

  <HomeLayout>
    <section class="ud-pt-[200px] ud-pb-[70px]">
      <div class="ud-container ud-max-w-4xl ud-mx-auto">
        <h1 class="ud-text-4xl ud-font-bold ud-mb-8" dusk="case-study-title">{{ title }}</h1>

        <div
          class="ud-prose ud-max-w-none"
          v-html="content"
        />

        <div class="ud-mt-12">
          <Link
            :href="route('home')"
            class="ud-text-primary hover:ud-text-black ud-transition-colors"
          >
            ← {{ trans('case_study.back_to_portfolio') }}
          </Link>
        </div>
      </div>
    </section>
  </HomeLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import {trans} from "laravel-vue-i18n";
import {route} from "ziggy-js";

const page = usePage();
const locale = computed(() => page.props.locale);

const props = defineProps({
  caseStudy: Object,
});

const title = computed(() =>
  locale.value === 'nl' ? props.caseStudy.title_nl : props.caseStudy.title_en
);

const content = computed(() =>
  locale.value === 'nl' ? props.caseStudy.content_nl : props.caseStudy.content_en
);
</script>
