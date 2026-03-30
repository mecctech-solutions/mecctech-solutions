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
import { computed, ref, watch, nextTick } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { trans } from 'laravel-vue-i18n';
import { route } from 'ziggy-js';
import type { BlogPostPayload } from '@/types/blog';
import hljs from 'highlight.js';
import 'highlight.js/styles/github-dark.css';

const props = defineProps<{
    post: BlogPostPayload;
}>();

const page = usePage();
const locale = computed(() => page.props.locale as string);
const contentRef = ref<HTMLElement | null>(null);

const title = computed(() =>
    locale.value === 'nl' ? props.post.title_nl : props.post.title_en,
);

const content = computed(() =>
    locale.value === 'nl' ? props.post.content_nl : props.post.content_en,
);

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

function applyCodeHighlighting(): void {
    nextTick(() => {
        if (!contentRef.value) return;

        contentRef.value.querySelectorAll<HTMLElement>('pre code').forEach((block) => {
            const pre = block.parentElement as HTMLElement;
            if (!pre || pre.dataset.highlighted) return;

            hljs.highlightElement(block);

            const langClass = Array.from(block.classList).find((c) => c.startsWith('language-'));
            const language = langClass ? langClass.replace('language-', '') : 'code';

            const header = document.createElement('div');
            header.className = 'code-block-header';
            header.innerHTML = `
                <span class="code-block-lang">${language}</span>
                <button class="code-block-copy" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                    </svg>
                    <span>Copy</span>
                </button>
            `;

            pre.insertBefore(header, block);
            pre.dataset.highlighted = 'true';

            const copyBtn = header.querySelector<HTMLButtonElement>('.code-block-copy')!;
            copyBtn.addEventListener('click', () => {
                navigator.clipboard.writeText(block.textContent ?? '').then(() => {
                    const label = copyBtn.querySelector('span')!;
                    label.textContent = 'Copied!';
                    copyBtn.classList.add('copied');
                    setTimeout(() => {
                        label.textContent = 'Copy';
                        copyBtn.classList.remove('copied');
                    }, 2000);
                });
            });
        });
    });
}

watch(content, applyCodeHighlighting, { immediate: true });
</script>
