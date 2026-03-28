<template>
    <Head :title="title" />

    <HomeLayout>
        <article class="ud-pt-[200px] ud-pb-20">
            <div class="ud-container ud-max-w-4xl ud-mx-auto">
                <header class="ud-mb-10">
                    <time
                        v-if="post.published_at"
                        class="ud-mb-3 ud-block ud-text-sm ud-text-neutral-500"
                        :datetime="post.published_at"
                    >
                        {{ formattedDate }}
                    </time>
                    <h1
                        class="ud-text-4xl ud-font-bold ud-tracking-tight ud-text-black md:ud-text-5xl"
                        dusk="blog-post-title"
                    >
                        {{ title }}
                    </h1>
                </header>

                <div
                    class="ud-mb-12 ud-overflow-hidden ud-rounded-2xl ud-bg-neutral-100 ud-shadow-md"
                >
                    <img
                        :src="post.featured_image_full_url"
                        :alt="title"
                        class="ud-w-full ud-object-cover ud-aspect-[21/9] md:ud-aspect-[2/1]"
                    />
                </div>

                <div
                    ref="contentRef"
                    class="ud-prose ud-prose-lg ud-max-w-none"
                    v-html="content"
                />

                <div class="ud-mt-14 ud-border-t ud-border-neutral-200 ud-pt-10">
                    <Link
                        :href="route('blog.index')"
                        class="ud-text-primary ud-font-medium hover:ud-text-black ud-transition-colors"
                    >
                        ← {{ trans('blog.back_to_blog') }}
                    </Link>
                </div>
            </div>
        </article>
    </HomeLayout>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { computed, onMounted, watch, nextTick, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { route } from 'ziggy-js';
import type { BlogPostPayload } from '@/types/blog';
import hljs from 'highlight.js/lib/core';
import php from 'highlight.js/lib/languages/php';
import javascript from 'highlight.js/lib/languages/javascript';
import typescript from 'highlight.js/lib/languages/typescript';
import xml from 'highlight.js/lib/languages/xml';
import css from 'highlight.js/lib/languages/css';
import json from 'highlight.js/lib/languages/json';
import bash from 'highlight.js/lib/languages/bash';
import 'highlight.js/styles/github-dark.css';

hljs.registerLanguage('php', php);
hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('typescript', typescript);
hljs.registerLanguage('xml', xml);
hljs.registerLanguage('css', css);
hljs.registerLanguage('json', json);
hljs.registerLanguage('bash', bash);

const props = defineProps<{
    post: BlogPostPayload;
}>();

const page = usePage();
const locale = computed(() => page.props.locale as string);

const title = computed(() =>
    locale.value === 'nl' ? props.post.title_nl : props.post.title_en,
);

const content = computed(() =>
    locale.value === 'nl' ? props.post.content_nl : props.post.content_en,
);

const contentRef = ref<HTMLElement | null>(null);

const highlightCode = () => {
    nextTick(() => {
        if (contentRef.value) {
            contentRef.value.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block as HTMLElement);
            });
        }
    });
};

onMounted(highlightCode);
watch(content, highlightCode);

const formattedDate = computed(() => {
    if (!props.post.published_at) {
        return '';
    }
    return new Intl.DateTimeFormat(locale.value === 'nl' ? 'nl-NL' : 'en-GB', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    }).format(new Date(props.post.published_at));
});
</script>
