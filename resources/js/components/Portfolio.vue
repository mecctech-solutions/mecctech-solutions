<template>

    <!-- ====== Portfolio Section Start  -->
    <section id="portfolio" class="ud-pt-[120px] ud-pb-[70px] ud-bg-[#f8f9ff]">
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
                Creative Portfolios
              </span>
                        <h2
                            class="
                  ud-font-bold ud-text-black ud-text-3xl
                  sm:ud-text-4xl
                  md:ud-text-[45px]
                  ud-mb-5
                "
                        >
                            Recent Works
                        </h2>
                        <p class="ud-font-medium ud-text-lg ud-text-body-color">
                            There are many variations of passages of Lorem Ipsum available
                            but the majority have suffered alteration in some form.
                        </p>
                    </div>
                </div>
                <div class="ud-w-full ud-px-4">
                    <div
                        class="
                portfolio-buttons
                ud-flex ud-flex-wrap ud-items-center ud-justify-center ud-mb-12
              "
                    >
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  active
                "
                            data-filter="*"
                        >
                            All
                        </button>
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  hover:ud-bg-primary hover:ud-text-white
                "
                            data-filter=".web"
                        >
                            Web Design
                        </button>
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  hover:ud-bg-primary hover:ud-text-white
                "
                            data-filter=".graphics"
                        >
                            Graphics
                        </button>
                        <button
                            class="
                  sm:font-semibold
                  ud-text-sm
                  sm:ud-text-base
                  ud-block ud-py-2 ud-px-5
                  md:ud-mx-2
                  ud-mb-2 ud-rounded-full ud-text-body-color
                  hover:ud-bg-primary hover:ud-text-white
                "
                            data-filter=".app"
                        >
                            App
                        </button>
                    </div>
                </div>
            </div>

            <div class="portfolio-container ud-flex ud-justify-center ud--mx-4">
                <div class="ud-w-full xl:ud-w-10/12 ud-px-4">
                    <div
                        class="
                items-wrapper
                ud-flex ud-flex-wrap ud-justify-center ud-mx-[-16px]
              "
                    >
                        <div class="ud-w-full md:ud-w-1/2 ud-px-4 item web app">
                            <div class="ud-mb-12">
                                <div
                                    class="
                      ud-relative
                      ud-group
                      ud-mb-8
                      ud-overflow-hidden
                      ud-shadow-service
                      ud-rounded-md
                    "
                                >
                                    <img
                                        src="images/portfolio/portfolio-01.jpg"
                                        alt="image"
                                        class="ud-w-full"
                                    />
                                    <div
                                        class="
                        ud-absolute
                        ud-w-full
                        ud-h-full
                        ud-top-0
                        ud-left-0
                        ud-bg-primary
                        ud-bg-opacity-[17%]
                        ud-flex
                        ud-items-center
                        ud-justify-center
                        ud-opacity-0
                        ud-invisible
                        group-hover:ud-opacity-100 group-hover:ud-visible
                        ud-transition
                      "
                                    >
                                        <a
                                            href="images/portfolio/portfolio-01.jpg"
                                            class="
                          glightbox
                          ud-w-10
                          ud-h-10
                          ud-flex
                          ud-items-center
                          ud-justify-center
                          ud-bg-primary
                          ud-text-white
                          ud-rounded-full
                        "
                                        >
                                            <svg
                                                width="14"
                                                height="14"
                                                viewBox="0 0 14 14"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M14 8H8V14H6V8H0V6H6V0H8V6H14V8Z"
                                                    fill="white"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="mt-6">
                                    <a
                                        href="portfolio-details.html"
                                        class="
                        ud-font-semibold ud-text-black
                        hover:ud-text-primary
                        ud-text-xl ud-inline-block ud-mb-3
                      "
                                    >
                                        Startup landing page
                                    </a>
                                </h3>
                                <p class="ud-font-medium ud-text-base ud-text-body-color">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Maecenas vitae dolor ultrices libero.
                                </p>
                            </div>
                        </div>
                        <div class="ud-w-full md:ud-w-1/2 ud-px-4 item graphics web">
                            <div class="ud-mb-12">
                                <div
                                    class="
                      ud-relative
                      ud-group
                      ud-mb-8
                      ud-overflow-hidden
                      ud-shadow-service
                      ud-rounded-md
                    "
                                >
                                    <img
                                        src="images/portfolio/portfolio-02.jpg"
                                        alt="image"
                                        class="ud-w-full"
                                    />
                                    <div
                                        class="
                        ud-absolute
                        ud-w-full
                        ud-h-full
                        ud-top-0
                        ud-left-0
                        ud-bg-primary
                        ud-bg-opacity-[17%]
                        ud-flex
                        ud-items-center
                        ud-justify-center
                        ud-opacity-0
                        ud-invisible
                        group-hover:ud-opacity-100 group-hover:ud-visible
                        ud-transition
                      "
                                    >
                                        <a
                                            href="images/portfolio/portfolio-02.jpg"
                                            class="
                          glightbox
                          ud-w-10
                          ud-h-10
                          ud-flex
                          ud-items-center
                          ud-justify-center
                          ud-bg-primary
                          ud-text-white
                          ud-rounded-full
                        "
                                        >
                                            <svg
                                                width="14"
                                                height="14"
                                                viewBox="0 0 14 14"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M14 8H8V14H6V8H0V6H6V0H8V6H14V8Z"
                                                    fill="white"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="mt-6">
                                    <a
                                        href="portfolio-details.html"
                                        class="
                        ud-font-semibold ud-text-black
                        hover:ud-text-primary
                        ud-text-xl ud-inline-block ud-mb-3
                      "
                                    >
                                        Job portal landing page
                                    </a>
                                </h3>
                                <p class="ud-font-medium ud-text-base ud-text-body-color">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Maecenas vitae dolor ultrices libero.
                                </p>
                            </div>
                        </div>
                        <div class="ud-w-full md:ud-w-1/2 ud-px-4 item app">
                            <div class="ud-mb-12">
                                <div
                                    class="
                      ud-relative
                      ud-group
                      ud-mb-8
                      ud-overflow-hidden
                      ud-shadow-service
                      ud-rounded-md
                    "
                                >
                                    <img
                                        src="images/portfolio/portfolio-03.jpg"
                                        alt="image"
                                        class="ud-w-full"
                                    />
                                    <div
                                        class="
                        ud-absolute
                        ud-w-full
                        ud-h-full
                        ud-top-0
                        ud-left-0
                        ud-bg-primary
                        ud-bg-opacity-[17%]
                        ud-flex
                        ud-items-center
                        ud-justify-center
                        ud-opacity-0
                        ud-invisible
                        group-hover:ud-opacity-100 group-hover:ud-visible
                        ud-transition
                      "
                                    >
                                        <a
                                            href="images/portfolio/portfolio-03.jpg"
                                            class="
                          glightbox
                          ud-w-10
                          ud-h-10
                          ud-flex
                          ud-items-center
                          ud-justify-center
                          ud-bg-primary
                          ud-text-white
                          ud-rounded-full
                        "
                                        >
                                            <svg
                                                width="14"
                                                height="14"
                                                viewBox="0 0 14 14"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M14 8H8V14H6V8H0V6H6V0H8V6H14V8Z"
                                                    fill="white"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="mt-6">
                                    <a
                                        href="portfolio-details.html"
                                        class="
                        ud-font-semibold ud-text-black
                        hover:ud-text-primary
                        ud-text-xl ud-inline-block ud-mb-3
                      "
                                    >
                                        SaaS landing page
                                    </a>
                                </h3>
                                <p class="ud-font-medium ud-text-base ud-text-body-color">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Maecenas vitae dolor ultrices libero.
                                </p>
                            </div>
                        </div>
                        <div class="ud-w-full md:ud-w-1/2 ud-px-4 item graphics web">
                            <div class="ud-mb-12">
                                <div
                                    class="
                      ud-relative
                      ud-group
                      ud-mb-8
                      ud-overflow-hidden
                      ud-shadow-service
                      ud-rounded-md
                    "
                                >
                                    <img
                                        src="images/portfolio/portfolio-04.jpg"
                                        alt="image"
                                        class="ud-w-full"
                                    />
                                    <div
                                        class="
                        ud-absolute
                        ud-w-full
                        ud-h-full
                        ud-top-0
                        ud-left-0
                        ud-bg-primary
                        ud-bg-opacity-[17%]
                        ud-flex
                        ud-items-center
                        ud-justify-center
                        ud-opacity-0
                        ud-invisible
                        group-hover:ud-opacity-100 group-hover:ud-visible
                        ud-transition
                      "
                                    >
                                        <a
                                            href="images/portfolio/portfolio-04.jpg"
                                            class="
                          glightbox
                          ud-w-10
                          ud-h-10
                          ud-flex
                          ud-items-center
                          ud-justify-center
                          ud-bg-primary
                          ud-text-white
                          ud-rounded-full
                        "
                                        >
                                            <svg
                                                width="14"
                                                height="14"
                                                viewBox="0 0 14 14"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                    d="M14 8H8V14H6V8H0V6H6V0H8V6H14V8Z"
                                                    fill="white"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="mt-6">
                                    <a
                                        href="portfolio-details.html"
                                        class="
                        ud-font-semibold ud-text-black
                        hover:ud-text-primary
                        ud-text-xl ud-inline-block ud-mb-3
                      "
                                    >
                                        Business & corporate template
                                    </a>
                                </h3>
                                <p class="ud-font-medium ud-text-base ud-text-body-color">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Maecenas vitae dolor ultrices libero.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Portfolio Section End  -->
</template>

<script>
export default {
    name: "RecentWorks"
}
</script>

<style scoped>

</style>
