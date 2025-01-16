<script setup lang="ts">
import {defineProps, ref, watchEffect} from 'vue';

const props = defineProps({
  title: String,
  text: String,
  icon: {
    type: String,
    default: 'Grid',
  },
});

const resolvedIcon = ref(null);
const iconContext = import.meta.glob('./Icons/*.vue', { eager: false });

watchEffect(async () => {
  const iconPath = `./Icons/${props.icon}.vue`;
  if (iconContext[iconPath]) {
    resolvedIcon.value = (await iconContext[iconPath]()).default;
  } else {
    console.error(`Icon "${props.icon}" could not be resolved. List of available icons: ${Object.keys(iconContext).join(', ')}`);
    resolvedIcon.value = null;
  }
});

</script>

<template>
    <div class="ud-w-full md:ud-w-1/2 xl:ud-w-1/4 ud-px-4">
        <div
            class="
                  ud-bg-white ud-group
                  hover:ud-bg-primary
                  ud-shadow-service
                  ud-py-10
                  ud-px-8
                  ud-rounded-xl
                  ud-relative
                  ud-z-10
                  ud-overflow-hidden
                  ud-text-center
                  ud-duration-200
                  ud-mb-8
                "
        >
            <div
                class="
                    ud-mx-auto
                    ud-w-20
                    ud-h-20
                    ud-mb-6
                    ud-rounded-full
                    ud-bg-primary
                    ud-flex
                    ud-items-center
                    ud-justify-center
                    ud-text-white
                    group-hover:ud-bg-white group-hover:ud-text-primary
                  "
            >
              <component :is="resolvedIcon" v-if="resolvedIcon" />
            </div>
            <h3
                class="
                    ud-font-bold ud-text-black ud-text-xl
                    sm:ud-text-2xl
                    lg:ud-text-xl
                    2xl:ud-text-2xl
                    group-hover:ud-text-white
                    ud-mb-3
                  "
            >
                {{ title }}
            </h3>
            <p
                class="
                    ud-font-medium ud-text-body-color
                    group-hover:ud-text-white
                    ud-leading-relaxed ud-text-sm
                  "
            >
                {{ text }}
            </p>
            <div>
                  <span class="ud-absolute ud-top-0 ud-right-0 ud--z-1">
                    <svg
                        width="218"
                        height="109"
                        viewBox="0 0 218 109"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                      <circle
                          opacity="0.05"
                          cx="156.5"
                          cy="-47.5"
                          r="156.5"
                          fill="white"
                      />
                      <circle
                          opacity="0.08"
                          cx="210"
                          cy="6"
                          r="62"
                          fill="white"
                      />
                    </svg>
                  </span>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
