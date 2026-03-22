<template>
    <article
        class="ud-group ud-flex ud-flex-col ud-overflow-hidden ud-rounded-2xl ud-bg-white ud-shadow-md ud-ring-1 ud-ring-black/5 ud-transition hover:ud-shadow-lg"
    >
        <Link
            :href="route('blog.show', post.slug)"
            class="ud-relative ud-aspect-[16/10] ud-overflow-hidden ud-bg-neutral-100"
        >
            <img
                :src="post.featured_image_full_url"
                :alt="title"
                class="ud-h-full ud-w-full ud-object-cover ud-transition ud-duration-300 group-hover:ud-scale-[1.02]"
                loading="lazy"
            />
        </Link>
        <div class="ud-flex ud-flex-1 ud-flex-col ud-gap-3 ud-p-6">
            <time
                v-if="post.published_at"
                class="ud-text-sm ud-text-neutral-500"
                :datetime="post.published_at"
            >
                {{ formattedDate }}
            </time>
            <Link
                :href="route('blog.show', post.slug)"
                class="ud-text-xl ud-font-semibold ud-text-black ud-transition hover:ud-text-primary"
            >
                {{ title }}
            </Link>
            <p class="ud-line-clamp-3 ud-flex-1 ud-text-base ud-leading-relaxed ud-text-neutral-600">
                {{ summary }}
            </p>
            <Link
                :href="route('blog.show', post.slug)"
                class="ud-inline-flex ud-items-center ud-text-sm ud-font-medium ud-text-primary ud-transition hover:ud-text-black"
            >
                {{ trans('blog.read_more') }}
                <span class="ud-ml-1" aria-hidden="true">→</span>
            </Link>
        </div>
    </article>
</template>

<script setup lang="ts">
import {Link, usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import {trans} from 'laravel-vue-i18n';
import {route} from 'ziggy-js';
import type {BlogPostPayload} from '@/types/blog';

const props = defineProps<{
    post: BlogPostPayload;
}>();

const page = usePage();
const locale = computed(() => page.props.locale as string);

const title = computed(() =>
    locale.value === 'nl' ? props.post.title_nl : props.post.title_en,
);

const summary = computed(() => {
    const excerpt =
        locale.value === 'nl' ? props.post.excerpt_nl : props.post.excerpt_en;
    if (excerpt) {
        return excerpt;
    }
    const raw =
        locale.value === 'nl' ? props.post.content_nl : props.post.content_en;
    const stripped = raw.replace(/<[^>]+>/g, '').trim();
    if (stripped.length <= 160) {
        return stripped;
    }
    return `${stripped.slice(0, 160)}…`;
});

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
