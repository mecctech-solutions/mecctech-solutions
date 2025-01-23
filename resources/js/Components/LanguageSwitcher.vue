<script setup>
import {loadLanguageAsync} from 'laravel-vue-i18n';
import {router} from "@inertiajs/vue3";
import {route} from "ziggy-js";

function changeLanguage(language) {
    loadLanguageAsync(language)
    router.get(route('locale.change', {
        locale: language
    }));
}
</script>

<template>
    <div
        class="ud-flex ud-justify-end ud-pr-16 lg:ud-pr-0"
    >
        <div
            class="
                  ud-py-3
                  ud-px-8
                  md:ud-px-9
                  lg:ud-px-8
                  xl:ud-px-9
                "
        >
            <div class="ud-flex ud-space-x-1 ud-mb-1">
                <a @click="changeLanguage('nl')"
                   dusk="language-switcher-nl"
                   class="ud-cursor-pointer hover:ud-scale-110 ud-transform ud-transition ud-ease-in-out"><img
                    style="width: 30px" src="/icons/netherlands.png" alt=""></a>
                <a @click="changeLanguage('en')"
                   class="ud-cursor-pointer hover:ud-scale-110 ud-transform ud-transition ud-ease-in-out"><img
                    style="width: 30px" src="/icons/uk.png" alt=""></a>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
