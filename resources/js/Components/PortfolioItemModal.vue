<template>
  <div
      v-if="!isMobile"
      class="ud-bg-white ud-z-10 centered ud-pb-20 ud-mt-10"
      v-click-outside="emitTurnOffModalEvent"
  >
    <div class="ud-flex ud-justify-around ud-items-center">
      <i
          @click="previousImage"
          class="fa-solid fa-angle-left ud-text-xl md:ud-text-5xl ud-pt-5 ud-pb-5 ud-pr-10 ud-pl-10 ud-text-primary hover:ud-scale-125 ud-transform ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer"
      ></i>
      <img
          class="uw-w-32 md:ud-w-200 md:ud-h-100 lg:ud-h-140 ud-object-scale-down"
          :src="currentImageUrl"
          alt=""
      />
      <i
          @click="nextImage"
          class="fa-solid fa-angle-right ud-text-xl md:ud-text-5xl ud-p-5 ud-pr-10 ud-pl-10 ud-text-primary hover:ud-scale-125 ud-transform ud-transition ud-ease-in-out ud-duration-500 ud-cursor-pointer"
      ></i>
    </div>
    <div class="ud-text-left ud-p-5">
      <div class="ud-flex ud-items-center ud-space-x-3">
        <h1 class="ud-text-4xl ud-font-bold">{{ title }}</h1>
        <p v-for="tag in tags" :key="tag.name">{{ tag.name }}</p>
      </div>
      <ul class="ud-mt-4">
        <li
            v-for="bulletPoint in bulletPoints"
            :key="bulletPoint.text_nl || bulletPoint.text_en"
            class="ud-text-base ud-list-disc"
        >
          {{ locale === 'nl' ? bulletPoint.text_nl : bulletPoint.text_en }}
        </li>
      </ul>
    </div>
    <div class="ud-flex ud-flex-col ud-items-center">
      <div
          class="
          ud-text-base
          ud-font-semibold
          ud-text-white
          ud-bg-primary
          ud-py-3
          ud-px-8
          ud-mr-4
          hover:ud-shadow-signUp hover:ud-bg-opacity-90
          ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
          ud-cursor-pointer
        "
      >
        <a :href="websiteUrl" class="ud-text-sm md:ud-text-xl">
          <i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i>
          SITE / CODE
        </a>
      </div>
    </div>
  </div>
  <div
      v-else
      class="ud-fixed ud-z-50 ud-top-0 ud-h-full ud-m-0 ud-bg-white ud-left-0"
  >
    <div class="ud-flex ud-flex-col ud-items-center">
      <img
          class="ud-w-200 ud-h-60 ud-object-scale-down"
          :src="currentImageUrl"
          alt=""
      />
      <div class="ud-flex ud-space-x-2 ud-mt-10">
        <i
            v-for="image in images"
            :key="image.url"
            @click="currentImageUrl = image.url"
            :class="{
            'ud-text-primary': image.url === currentImageUrl,
            'ud-text-black': image.url !== currentImageUrl,
          }"
            class="fas fa-circle ud-cursor-pointer"
        ></i>
      </div>
    </div>
    <div class="ud-p-5 ud-mb-5">
      <div class="ud-mb-4">
        <h1 class="ud-text-2xl ud-font-bold">{{ title }}</h1>
        <div class="ud-flex ud-space-x-3 ud-text-sm">
          <p v-for="tag in tags" :key="tag.name">{{ tag.name }}</p>
        </div>
      </div>
      <ul class="ud-space-y-3 ud-mt-4">
        <li
            v-for="bulletPoint in bulletPoints"
            :key="bulletPoint.text_nl || bulletPoint.text_en"
            class="ud-text-base ud-list-disc"
        >
          {{ locale === 'nl' ? bulletPoint.text_nl : bulletPoint.text_en }}
        </li>
      </ul>
    </div>
    <div class="ud-flex ud-flex-col ud-items-center">
      <div
          class="
          ud-text-base
          ud-font-semibold
          ud-text-white
          ud-bg-primary
          ud-py-3
          ud-px-8
          ud-mr-4
          hover:ud-shadow-signUp hover:ud-bg-opacity-90
          ud-rounded-full ud-transition ud-duration-300 ud-ease-in-out
          ud-cursor-pointer
        "
      >
        <a :href="websiteUrl" class="ud-text-sm md:ud-text-xl">
          <i class="fa-solid fa-desktop ud-pr-5 ud-text-sm md:ud-text-xl"></i>
          SITE / CODE
        </a>
      </div>
    </div>
    <i
        @click="emitTurnOffModalEvent"
        class="fa-solid fa-xmark ud-cursor-pointer ud-p-5 ud-text-3xl ud-fixed ud-right-0 ud-bottom-0"
    ></i>
  </div>
</template>

<script setup>
import {computed, onMounted, ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
  title: String,
  tags: Array,
  images: Array,
  description: String,
  websiteUrl: String,
  bulletPoints: Array,
});

const emit = defineEmits(["turn-off-modal"]);

const page = usePage();
const locale = computed(() => page.props.locale);

const currentImageUrl = ref("");
const currentImageIndex = ref(0);
const maxImageIndex = computed(() => props.images.length);
const isMobile = ref(window.innerWidth <= 760);

const updateMobileStatus = () => {
  isMobile.value = window.innerWidth <= 760;
};

const nextImage = () => {
  if (currentImageIndex.value < maxImageIndex.value - 1) {
    currentImageIndex.value++;
    currentImageUrl.value = props.images[currentImageIndex.value].url;
  }
};

const previousImage = () => {
  if (currentImageIndex.value > 0) {
    currentImageIndex.value--;
    currentImageUrl.value = props.images[currentImageIndex.value].url;
  }
};

const emitTurnOffModalEvent = () => {
  emit("turn-off-modal");
};

onMounted(() => {
  currentImageUrl.value = props.images[0].url;
  window.addEventListener("resize", updateMobileStatus);
});
</script>

<style scoped>
.centered {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
