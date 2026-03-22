<template>
    <Head :title="trans('blog.page_title')" />

    <HomeLayout>
        <section class="ud-pt-[200px] ud-pb-16">
            <div class="ud-container">
                <header class="ud-mx-auto ud-mb-14 ud-max-w-3xl ud-text-center">
                    <h1
                        class="ud-mb-4 ud-text-4xl ud-font-bold ud-tracking-tight ud-text-black md:ud-text-5xl"
                    >
                        {{ trans('blog.page_title') }}
                    </h1>
                    <p class="ud-text-lg ud-text-neutral-600">
                        {{ trans('blog.intro') }}
                    </p>
                </header>

                <div
                    v-if="posts.total === 0"
                    class="ud-rounded-2xl ud-bg-neutral-50 ud-py-16 ud-text-center ud-text-neutral-600"
                >
                    {{ trans('blog.empty') }}
                </div>

                <template v-else>
                    <Pagination
                        v-if="posts.last_page > 1"
                        :links="posts.links"
                        class="ud-mb-12"
                    />
                    <div
                        class="ud-grid ud-gap-8 sm:ud-grid-cols-2 lg:ud-grid-cols-3"
                    >
                        <BlogPostCard
                            v-for="post in posts.data"
                            :key="post.id"
                            :post="post"
                        />
                    </div>
                    <Pagination
                        v-if="posts.last_page > 1"
                        :links="posts.links"
                        class="ud-mt-12"
                    />
                </template>
            </div>
        </section>
    </HomeLayout>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';
import BlogPostCard from '@/Components/Blog/BlogPostCard.vue';
import Pagination from '@/Components/Pagination.vue';
import { trans } from 'laravel-vue-i18n';
import type { BlogPostPayload } from '@/types/blog';

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

defineProps<{
    posts: {
        data: BlogPostPayload[];
        links: PaginationLink[];
        current_page: number;
        last_page: number;
        total: number;
    };
}>();
</script>
