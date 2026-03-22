export interface BlogPostPayload {
    id: number;
    title_nl: string;
    title_en: string;
    slug: string;
    excerpt_nl: string | null;
    excerpt_en: string | null;
    content_nl: string;
    content_en: string;
    featured_image: string;
    featured_image_full_url: string;
    published_at: string | null;
}
