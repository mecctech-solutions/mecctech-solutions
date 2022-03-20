<x-master>
    <section id="home">
        <div class="flex h-screen">
            <view-my-work></view-my-work>
        </div>
    </section>
    <mecc-tech-header></mecc-tech-header>

    <section id="about-me">
        <div class="flex flex-col items-center">
            <h1 class="text-4xl font-bold mt-10">ABOUT ME</h1>
            <div class="border-t border-4 border-black mt-5 w-1/16"></div>

            <skills></skills>

            <div class="m-10 flex flex-col md:flex-row justify-center items-center md:space-x-20">
                <img class="rounded-full p-10" src="images/floris.jpeg" alt="">

                <div class="flex flex-col items-center md:w-1/4">
                    <h1 class="text-3xl font-bold mt-10 mb-5">Who am I?</h1>
                    <p class="text-2xl text-center md:text-left">I'm a full-stack web developer and freelancer specialized in e-commerce software. Count on me to write full web applications for your e-commerce business, with cutting edge technologies like Laravel and Vue.js.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="projects">
        <portfolio-items get_all_portfolio_items_route="{{ route("all-portfolio-items") }}"
                         get_portfolio_items_with_tag_route="{{ route("portfolio-items-with-tag") }}"></portfolio-items>
    </section>
    <section id="contact">
        <contact-form :submit_contact_request_route="'{{ route('submit-contact-request') }}'" :csrf_token="'{{ csrf_token() }}'" :contact_form_successfully_sent="{{ session()->get('submit_contact_request_successful') }}"></contact-form>
    </section>

    <footer>
        <mecc-tech-footer></mecc-tech-footer>
    </footer>
</x-master>

