<template>
    <div class="ud-w-1/2 ud-mx-auto">
        <skill-v2 :name="'Laravel'" :level="'Advanced'" :percentage="90"></skill-v2>
        <skill-v2 :name="'PHP'" :level="'Advanced'" :percentage="90"></skill-v2>
        <skill-v2 :name="'Vue.js'" :level="'Intermediate'" :percentage="80"></skill-v2>
        <skill-v2 :name="'TailwindCSS'" :level="'Intermediate'" :percentage="80"></skill-v2>
        <skill-v2 :name="'HTML'" :level="'Intermediate'" :percentage="80"></skill-v2>
        <skill-v2 :name="'Javascript'" :level="'Intermediate'" :percentage="70"></skill-v2>
    </div>
</template>

<script>
export default {
    name: "SkillsV2"
}

</script>

<style scoped>

</style>
