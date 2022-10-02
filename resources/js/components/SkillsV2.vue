<template>
    <section id="services">
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
                  What do I offer?
                </span>
                            <h2
                                class="
                    ud-font-bold ud-text-black ud-text-3xl
                    sm:ud-text-4xl
                    md:ud-text-[45px]
                    ud-mb-5
                  "
                            >
                                My Skills
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="ud-w-3/4 ud-mx-auto">
                    <skill-v2 :name="'Laravel'" :level="'Advanced'" :percentage="90"></skill-v2>
                    <skill-v2 :name="'PHP'" :level="'Advanced'" :percentage="90"></skill-v2>
                    <skill-v2 :name="'Vue.js'" :level="'Intermediate'" :percentage="80"></skill-v2>
                    <skill-v2 :name="'TailwindCSS'" :level="'Intermediate'" :percentage="80"></skill-v2>
                    <skill-v2 :name="'HTML'" :level="'Intermediate'" :percentage="80"></skill-v2>
                    <skill-v2 :name="'CSS'" :level="'Intermediate'" :percentage="70"></skill-v2>
                    <skill-v2 :name="'Javascript'" :level="'Intermediate'" :percentage="70"></skill-v2>
                </div>
            </div>
        </div>
    </section>


</template>

<script>
export default {
    name: "SkillsV2"
}

</script>

<style scoped>

</style>
