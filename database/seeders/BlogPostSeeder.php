<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        BlogPost::query()->where('slug', 'like', 'sample-blog-post-%')->delete();
        BlogPost::query()->where('slug', 'like', 'draft-sample-%')->delete();
        BlogPost::query()->where('slug', 'code-block-demo')->delete();

        $codeBlockContentEn = <<<'HTML'
<p>In this post we'll look at how to build a dynamic component system in Vue 3 with Laravel and Inertia.js.</p>

<h2>The Vue Component</h2>
<p>First, let's define our page component with typed props:</p>

<pre><code class="language-vue">&lt;script setup lang="ts"&gt;
defineProps&lt;{
    homeComponents: Array&lt;App.Data.HomeComponentData&gt;
}&gt;()
&lt;/script&gt;

&lt;template&gt;
    &lt;HomeLayout&gt;
        &lt;Head title="Home" /&gt;
        &lt;main&gt;
            &lt;template
                v-for="component in homeComponents"
                :key="component.type"&gt;
                &lt;DynamicComponent
                    :component="component" /&gt;
            &lt;/template&gt;
        &lt;/main&gt;
    &lt;/HomeLayout&gt;
&lt;/template&gt;</code></pre>

<h2>The Laravel Controller</h2>
<p>On the backend, we render the page with Inertia and pass the components as props:</p>

<pre><code class="language-php">&lt;?php

namespace App\Http\Controllers;

use App\Data\HomeComponentData;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $components = collect([
            HomeComponentData::from([
                'type' => 'hero',
                'props' => ['title' => 'Welcome'],
            ]),
            HomeComponentData::from([
                'type' => 'features',
                'props' => ['columns' => 3],
            ]),
        ]);

        return Inertia::render('Home', [
            'homeComponents' => $components,
        ]);
    }
}</code></pre>

<h2>Styling with Tailwind</h2>
<p>Finally, here's a simple Tailwind CSS example for the layout:</p>

<pre><code class="language-css">.hero-section {
    @apply flex flex-col items-center justify-center
           min-h-[60vh] bg-gradient-to-br
           from-blue-600 to-indigo-700
           text-white px-6;
}

.hero-title {
    @apply text-5xl font-bold tracking-tight
           mb-4 text-center;
}</code></pre>

<p>This approach gives you a flexible, type-safe way to compose pages from reusable components.</p>
HTML;

        $codeBlockContentNl = <<<'HTML'
<p>In dit artikel bekijken we hoe je een dynamisch component-systeem bouwt in Vue 3 met Laravel en Inertia.js.</p>

<h2>Het Vue Component</h2>
<p>Eerst definiëren we ons page-component met getypte props:</p>

<pre><code class="language-vue">&lt;script setup lang="ts"&gt;
defineProps&lt;{
    homeComponents: Array&lt;App.Data.HomeComponentData&gt;
}&gt;()
&lt;/script&gt;

&lt;template&gt;
    &lt;HomeLayout&gt;
        &lt;Head title="Home" /&gt;
        &lt;main&gt;
            &lt;template
                v-for="component in homeComponents"
                :key="component.type"&gt;
                &lt;DynamicComponent
                    :component="component" /&gt;
            &lt;/template&gt;
        &lt;/main&gt;
    &lt;/HomeLayout&gt;
&lt;/template&gt;</code></pre>

<h2>De Laravel Controller</h2>
<p>Aan de backend renderen we de pagina met Inertia en geven we de componenten als props mee:</p>

<pre><code class="language-php">&lt;?php

namespace App\Http\Controllers;

use App\Data\HomeComponentData;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $components = collect([
            HomeComponentData::from([
                'type' => 'hero',
                'props' => ['title' => 'Welkom'],
            ]),
            HomeComponentData::from([
                'type' => 'features',
                'props' => ['columns' => 3],
            ]),
        ]);

        return Inertia::render('Home', [
            'homeComponents' => $components,
        ]);
    }
}</code></pre>

<h2>Styling met Tailwind</h2>
<p>Tot slot een simpel Tailwind CSS voorbeeld voor de layout:</p>

<pre><code class="language-css">.hero-section {
    @apply flex flex-col items-center justify-center
           min-h-[60vh] bg-gradient-to-br
           from-blue-600 to-indigo-700
           text-white px-6;
}

.hero-title {
    @apply text-5xl font-bold tracking-tight
           mb-4 text-center;
}</code></pre>

<p>Deze aanpak geeft je een flexibele, type-safe manier om pagina's samen te stellen uit herbruikbare componenten.</p>
HTML;

        BlogPost::factory()->create([
            'title_nl' => 'Dynamische componenten in Vue 3 met Laravel',
            'title_en' => 'Dynamic components in Vue 3 with Laravel',
            'slug' => 'code-block-demo',
            'excerpt_nl' => 'Leer hoe je een dynamisch component-systeem bouwt met Vue 3, Laravel en Inertia.js.',
            'excerpt_en' => 'Learn how to build a dynamic component system with Vue 3, Laravel and Inertia.js.',
            'content_nl' => $codeBlockContentNl,
            'content_en' => $codeBlockContentEn,
            'published_at' => now(),
        ]);

        foreach (range(1, 15) as $index) {
            BlogPost::factory()->create([
                'title_nl' => "Voorbeeld blogartikel {$index}",
                'title_en' => "Sample blog post {$index}",
                'slug' => 'sample-blog-post-'.$index,
                'excerpt_nl' => 'Korte intro voor dit voorbeeldartikel in het Nederlands.',
                'excerpt_en' => 'A short intro for this sample post in English.',
                'published_at' => now()->subDays($index),
            ]);
        }

        foreach (range(1, 2) as $index) {
            BlogPost::factory()
                ->draft()
                ->create([
                    'title_nl' => "Concept artikel {$index}",
                    'title_en' => "Draft post {$index}",
                    'slug' => 'draft-sample-'.$index,
                ]);
        }
    }
}
