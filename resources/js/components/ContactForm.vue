<template>
    <section-title class="mt-10" :title="'CONTACT'"></section-title>
    <div class="grid grid-cols-2 mt-10 mb-10">
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
        <form :action="this.upload_contact_form_route" method="POST" enctype="multipart/form-data">>
            <input type="hidden" name="_token" v-bind:value="this.csrf_token">

            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="firstname">First Name</label>
                    <input id="firstname" name="firstname" type="text" class="p-2 text-mecctech-red appearance-none block w-full border rounded py-3 px-4 mb-3 leading-tight focus:outline-none bg-black" required>
                </div>

                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="lastname">Last Name</label>
                    <input id="lastname" name="lastname" type="text" class="p-2 text-mecctech-red block w-full border rounded py-3 px-4 mb-3 leading-tight focus:outline-none bg-black" required>
                </div>
            </div>
            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="email">Email</label>
                    <input id="email" name="email" type="text" class="p-2 text-mecctech-red appearance-none block w-full border rounded py-3 px-4 mb-3 leading-tight focus:outline-none bg-black" required>
                </div>
            </div>

            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block text-xs font-bold mb-2" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="p-2 text-mecctech-red appearance-none block w-full border rounded py-3 px-4 mb-3 leading-tight focus:outline-none bg-black" required></textarea>
                </div>
            </div>
            <div class="flex flex-wrap justify-center">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <button class="bg-mecctech-red shadow transition transform ease-in-out duration-500 hover:bg-black hover:text-mecctech-red focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" >
                        Send
                    </button>
                </div>
            </div>

        </form>
    </div>


</template>

<script>
    export default {
        props: ['csrf_token', 'upload_contact_form_route'],
        mounted() {

        },
        methods : {

        }
    }
</script>
