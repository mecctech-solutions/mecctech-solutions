<template>
    <!-- ====== Back To Top Start -->
    <a
        v-if="!modalStore.isOpen"
        href="#"
        class="
        ud-bg-primary
        ud-text-white
        ud-w-10
        ud-h-10
        ud-rounded-md
        ud-fixed
        ud-bottom-8
        ud-right-8
        ud-z-[999]
        hover:ud-shadow-signUp
        ud-transition ud-duration-300
        back-to-top
        ud-flex
      "
    >
      <i
          class="
          fa-solid
          fa-chevron-up
          ud-text-xl
          ud-font-bold
          ud-mx-auto
          ud-my-auto
        "
      >
      </i>
    </a>
    <!-- ====== Back To Top End -->
</template>

<script setup>
import { useModalStore } from "@/Stores/modalStore";

const modalStore = useModalStore();
</script>

<style scoped>

</style>
