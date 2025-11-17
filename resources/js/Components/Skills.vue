<template>
    <section id="skills" :key="locale">
        <div class="ud-container">
            <div class="ud-pt-[120px] ud-pb-[90px] ud-border-t ud-border-[#E9ECF8]">
                <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                    <div class="ud-w-full ud-px-4">
                        <div
                            class="ud-max-w-[600px] ud-mx-auto ud-text-center ud-mb-[70px]"
                        >
              <span
                  class="
                  ud-font-semibold ud-text-lg ud-text-primary ud-block ud-mb-2
                "
              >
                {{ trans('skills.offer') }}
              </span>
                            <h2
                                class="
                  ud-font-bold ud-text-black ud-text-3xl
                  sm:ud-text-4xl
                  md:ud-text-[45px]
                  ud-mb-5
                "
                            >
                                {{ trans('skills.my_skills') }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="ud-grid ud-grid-cols-1 sm:ud-grid-cols-2 lg:ud-grid-cols-3 ud-gap-4 ud-w-3/4 ud-mx-auto ud-place-items-left">
                    <Skill
                        v-for="(skill, index) in skills"
                        :key="index"
                        :name="skill.name"
                        :description="skill.description"
                    ></Skill>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import {computed} from "vue";
import Skill from "./Skill.vue";
import {trans} from "laravel-vue-i18n";
import {usePage} from "@inertiajs/vue3";

const page = usePage();
const locale = computed(() => page.props.appUrl);

const skills = computed(() => [
    { name: trans("skills.Laravel.name"), description: trans("skills.Laravel.description") },
    { name: trans("skills.Vue.js.name"), description: trans("skills.Vue.js.description") },
    { name: trans("skills.Inertia.js.name"), description: trans("skills.Inertia.js.description") },
    { name: trans("skills.PHP.name"), description: trans("skills.PHP.description") },
    { name: trans("skills.Javascript.name"), description: trans("skills.Javascript.description") },
    { name: trans("skills.MySQL.name"), description: trans("skills.MySQL.description") },
    { name: trans("skills.TailwindCSS.name"), description: trans("skills.TailwindCSS.description") },
    { name: trans("skills.Laravel Sail & Docker.name"), description: trans("skills.Laravel Sail & Docker.description") },
    { name: trans("skills.Redis.name"), description: trans("skills.Redis.description") },
    { name: trans("skills.Pest & PHP Unit.name"), description: trans("skills.Pest & PHP Unit.description") },
    { name: trans("skills.Laravel Forge.name"), description: trans("skills.Laravel Forge.description") },
    { name: trans("skills.CI/CD (GitHub Actions).name"), description: trans("skills.CI/CD (GitHub Actions).description") },
    { name: trans("skills.Laravel Dusk.name"), description: trans("skills.Laravel Dusk.description") },
    { name: trans("skills.Webpack & Vite.name"), description: trans("skills.Webpack & Vite.description") },
    { name: trans("skills.Git.name"), description: trans("skills.Git.description") },
    { name: trans("skills.Cursor.name"), description: trans("skills.Cursor.description") },
    { name: trans("skills.n8n.name"), description: trans("skills.n8n.description") },
]);
</script>

<style scoped></style>
