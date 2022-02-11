<template>
    <section-title class="mt-10" :title="'CONTACT'"></section-title>
    <div class="grid grid-cols-2 mt-10">
        <div class="flex flex-col items-center">
            <div class="flex flex-col justify-left w-1/2">
                <h2 class="text-2xl font-bold">Get in Touch</h2>
                <p>If you want to hire me for your project, feel free to contact me with this contact form. You can also contact me directly via email, phone or social media.</p>
            </div>
            <div>
                <div class="flex">
                    <svg aria-hidden="true" focusable="false" class="w-8 h-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
                    <div class="info">
                        <div>Name</div>
                        <div>Floris Meccanici</div>
                    </div>
                </div>
                <div>
                    <svg aria-hidden="true" focusable="false" class="w-8 h-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z"></path></svg>
                    <div>
                        <div>Address</div>
                        <div>Delft, Netherlands</div>
                    </div>
                </div>
                <div class="row">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope" class="w-8 h-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z"></path></svg>
                    <div>Email</div>
                    <div>florismeccanici@mecctech-solutions.nl</div>
                </div>
            </div>

        </div>
        <form :action="this.upload_contact_form_route" method="POST" enctype="multipart/form-data">>
            <input type="hidden" name="_token" v-bind:value="this.csrf_token">

            <div class="flex flex-wrap justify-center mt-5">
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
