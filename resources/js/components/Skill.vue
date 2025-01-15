<template>
    <div class="ud-mb-6">
        <div class="ud-flex ud-justify-between ud-mb-1">
            <span class="ud-text-lg ud-text-black ud-font-bold">{{ this.name }}</span>
            <span class="ud-text-base ud-text-black ud-font-bold">{{ this.level }}</span>
        </div>
        <div class="ud-w-full ud-bg-gray-200 ud-rounded-full ud-h-2.5 dark:ud-bg-gray-700">
            <div class="ud-bg-primary ud-h-2.5 ud-rounded-full" :style="{ 'width' : this.percentage + '%'}"></div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['name', 'level', 'percentage'],
    name: "SkillsV2"
}
</script>

<style scoped>

</style>
