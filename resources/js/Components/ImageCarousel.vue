<script setup>

import {computed, onMounted, ref} from "vue";

const props = defineProps({
    images: Array,
});

const emit = defineEmits([
    "update-current-image"
])

const currentImageUrl = ref("");
const currentImageIndex = ref(0);
const maxImageIndex = computed(() => props.images.length);

const nextImage = () => {
    if (currentImageIndex.value < maxImageIndex.value - 1) {
        currentImageIndex.value++;
        currentImageUrl.value = props.images[currentImageIndex.value].url;
        emit('update-current-image', currentImageUrl.value);
    }
};

const previousImage = () => {
    if (currentImageIndex.value > 0) {
        currentImageIndex.value--;
        currentImageUrl.value = props.images[currentImageIndex.value].url;
        emit('update-current-image', currentImageUrl.value);
    }
};

const isMobile = ref(window.innerWidth <= 760);

onMounted(() => {
    currentImageUrl.value = props.images[0].url;
    window.addEventListener("resize", updateMobileStatus);
});

const updateMobileStatus = () => {
    isMobile.value = window.innerWidth <= 760;
};
</script>

<template>
    <div v-if="isMobile" class="ud-flex ud-justify-around ud-items-center">
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
    <div v-else class="ud-flex ud-flex-col ud-items-center">
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
</template>

<style scoped>

</style>
