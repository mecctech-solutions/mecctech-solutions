<template>
    <section-title class="mt-10" :title="'CONTACT'"></section-title>
    <div class="grid grid-cols-1 md:grid-cols-2 mt-10 mb-10">
        <div class="flex flex-col items-center mt-10">
            <div class="w-1/2 mx-auto">
                <div class="flex flex-col justify-left">
                    <h2 class="text-2xl font-bold">Get in Touch</h2>
                    <p>If you want to hire me for your project, feel free to contact me with this contact form. You can also contact me directly via email, phone or social media.</p>
                </div>
                <div>
                    <div class="flex mt-5">
                        <div class="p-2 mr-1">
                            <i class="fa-solid fa-user text-3xl text-mecctech-red"></i>
                        </div>
                        <div>
                            <h2 class="font-bold">Name</h2>
                            <h3>Floris Meccanici</h3>
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <div class="p-2 mr-2">
                            <i class="fa-solid fa-location-dot text-3xl text-mecctech-red"></i>
                        </div>
                        <div>
                            <h2 class="font-bold">Address</h2>
                            <h3>Delft, Netherlands</h3>
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <div class="p-2">
                            <i class="fa-solid fa-at text-3xl text-mecctech-red"></i>
                        </div>
                        <div>
                            <h2 class="font-bold">Email</h2>
                            <h3>florismeccanici@mecctech-solutions.nl</h3>
                        </div>
                    </div>
                    <div class="flex mt-5">
                        <div class="p-2">
                            <i class="fas fa-phone text-3xl text-mecctech-red"></i>
                        </div>
                        <div>
                            <h2 class="font-bold">Phone</h2>
                            <h3>+31681639449</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form :action="this.submit_contact_request_route" method="POST" enctype="multipart/form-data" class="md:p-0 p-10">
            <input type="hidden" name="_token" v-bind:value="this.csrf_token">

            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="first_name">First Name</label>
                    <input id="first_name" name="first_name" type="text" class="text-white text-2xl font-bold block w-full py-3 px-4 mb-3 bg-mecctech-red" required>
                </div>

                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="last_name">Last Name</label>
                    <input id="last_name" name="last_name" type="text" class="text-white text-2xl font-bold block w-full py-3 px-4 mb-3 bg-mecctech-red" required>
                </div>
            </div>
            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="email">Email</label>
                    <input id="email" name="email" type="text" class="text-white text-2xl font-bold block w-full py-3 px-4 mb-3 bg-mecctech-red" required>
                </div>
            </div>

            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="text-white text-2xl font-bold block w-full py-3 px-4 mb-3 bg-mecctech-red" required></textarea>
                </div>
            </div>
            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <button class="text-lg md:text-xl border-mecctech-red border-4 pl-5 pr-5 pt-1 pb-1 mt-5 hover:bg-mecctech-red hover:text-white transition transform ease-in-out duration-500" type="submit" >
                        Send
                    </button>
                </div>
            </div>
        </form>

        <transition name="fade">
            <div v-if="contact_form_successfully_sent" class="w-1/2 md:w-1/3 bg-green-600 p-10 m-5 font-bold text-xl fixed z-500 bottom-0 right-0 rounded-lg text-white">
                <p>Thanks for contacting me! I will reply as soon as possible.</p>
                <i @click="contact_form_successfully_sent = false" class="fa-solid fa-xmark absolute top-0 right-0 p-3 cursor-pointer"></i>
            </div>
        </transition>

    </div>


</template>

<script>
    export default {
        props: ['csrf_token', 'submit_contact_request_route', 'contact_form_successfully_sent'],

        mounted() {

        },
        methods : {

        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
