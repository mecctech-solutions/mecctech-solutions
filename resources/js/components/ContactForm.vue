<template>
    <section-title :title="'CONTACT'"></section-title>
    <div class="grid grid-cols-2 w-1/2 justify-center">
        <div class="flex flex-col justify-left">
            <label for="email">Email</label>
            <input class="text-input" type="email" id="email">
        </div>
        <div class="flex flex-col justify-left">
            <label for="first_name">First Name</label>
            <input class="text-input" type="text" id="first_name">
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        methods : {

        }
    }
</script>
