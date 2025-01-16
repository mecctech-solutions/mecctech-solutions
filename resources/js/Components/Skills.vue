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
                <div class="ud-w-3/4 ud-mx-auto">
                    <Skill
                        :name="'Laravel'"
                        :level="trans('skills.advanced')"
                        :percentage="90"
                    ></Skill>
                    <Skill
                        :name="'PHP'"
                        :level="trans('skills.advanced')"
                        :percentage="90"
                    ></Skill>
                    <Skill
                        :name="'MySQL'"
                        :level="trans('skills.advanced')"
                        :percentage="90"
                    ></Skill>
                    <Skill
                        :name="'Vue.js'"
                        :level="trans('skills.intermediate')"
                        :percentage="80"
                    ></Skill>
                    <Skill
                        :name="'TailwindCSS'"
                        :level="trans('skills.intermediate')"
                        :percentage="80"
                    ></Skill>
                    <Skill
                        :name="'HTML'"
                        :level="trans('skills.intermediate')"
                        :percentage="80"
                    ></Skill>
                    <Skill
                        :name="'CSS'"
                        :level="trans('skills.intermediate')"
                        :percentage="70"
                    ></Skill>
                    <Skill
                        :name="'Javascript'"
                        :level="trans('skills.intermediate')"
                        :percentage="70"
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
</script>

<style scoped></style>
