<template>
    <section id="contact" class="ud-py-[120px]">
        <div class="ud-container">
            <div class="ud-flex ud-flex-wrap ud-mx-[-16px]">
                <div class="ud-w-full ud-px-4">
                    <div
                        class="ud-max-w-[600px] ud-mx-auto ud-text-center ud-mb-[50px]"
                    >
              <span
                  class="
                  ud-font-semibold ud-text-lg ud-text-primary ud-block ud-mb-2
                "
              >
                {{  $lang.get('contact.contact_me') }}
              </span>
                        <h2
                            class="
                  ud-font-bold ud-text-black ud-text-3xl
                  sm:ud-text-4xl
                  md:ud-text-[45px]
                  ud-mb-5
                "
                        >
                            {{  $lang.get('contact.project') }}
                        </h2>
                        <p class="ud-font-medium ud-text-lg ud-text-body-color">
                            {{  $lang.get('contact.project_text') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="ud-flex ud-justify-center ud--mx-4">
                <div class="ud-w-full lg:ud-w-9/12 ud-px-4">
                    <form :action="this.submit_contact_request_route" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" v-bind:value="this.csrf_token">

                        <div class="ud-flex ud-flex-wrap ud--mx-4">
                            <div class="ud-w-full md:ud-w-1/2 ud-px-4">
                                <div class="ud-mb-6">
                                    <input
                                        name="name"
                                        type="text"
                                        :placeholder="$lang.get('contact.name')"
                                        required
                                        class="input-field"
                                    />
                                </div>
                            </div>
                            <div class="ud-w-full md:ud-w-1/2 ud-px-4">
                                <div class="ud-mb-6">
                                    <input
                                        name="company"
                                        type="text"
                                        :placeholder="$lang.get('contact.company')"
                                        class="input-field"
                                    />
                                </div>
                            </div>
                            <div class="ud-w-full md:ud-w-1/2 ud-px-4">
                                <div class="ud-mb-6">
                                    <input
                                        name="email"
                                        type="email"
                                        :placeholder="$lang.get('contact.email')"
                                        class="input-field"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="ud-w-full md:ud-w-1/2 ud-px-4">
                                <div class="ud-mb-6">
                                    <input
                                        name="phone"
                                        type="text"
                                        :placeholder="$lang.get('contact.phone')"
                                        class="input-field"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="ud-w-full ud-px-4">
                                <div class="ud-mb-6">
                    <textarea
                        name="message"
                        rows="4"
                        :placeholder="$lang.get('contact.enter_project')"
                        class="input-field ud-resize-none"
                        required
                    ></textarea>
                                </div>
                            </div>
                            <div class="ud-w-full ud-px-4">
                                <div class="ud-pt-4 ud-text-center">
                                    <button
                                        type="submit"
                                        class="
                        ud-inline-flex
                        ud-justify-center
                        ud-items-center
                        ud-py-4
                        ud-px-9
                        ud-rounded-full
                        ud-font-semibold
                        ud-text-white
                        ud-bg-primary
                        ud-mx-auto
                        ud-transition
                        ud-duration-300
                        ud-ease-in-out
                        hover:ud-shadow-signUp hover:ud-bg-opacity-90
                      "
                                    >
                                        {{  $lang.get('contact.contact_me_2') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <transition name="fade">
            <div v-if="contact_form_successfully_sent" class="ud-w-1/2 md:ud-w-1/3 ud-bg-black ud-p-10 ud-m-5 ud-font-bold ud-text-xl ud-fixed ud-z-50 ud-bottom-0 ud-right-0 ud-rounded-lg ud-text-white">
                <p>Thanks for contacting me! I will reply as soon as possible</p>
                <i @click="contact_form_successfully_sent = false" class="fa-solid fa-xmark ud-absolute ud-top-0 ud-right-0 ud-p-3 ud-cursor-pointer"></i>
            </div>
        </transition>
    </section>
</template>

<script>
export default {
    name: "Contact",
    props: ['csrf_token', 'submit_contact_request_route', 'contact_form_successfully_sent'],

}
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
