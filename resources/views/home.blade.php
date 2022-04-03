<x-master>
    <section id="home">
        <div class="flex h-screen">
            <view-my-work></view-my-work>
        </div>
    </section>
    <mecc-tech-header></mecc-tech-header>

    <section id="about-me">
        <about-me></about-me>
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

