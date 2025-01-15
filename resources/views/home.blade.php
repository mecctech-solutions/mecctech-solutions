<x-app>
    <hero-section/>
    <about-me/>
    <skills/>
    <approach/>
    <portfolio get_all_portfolio_items_route="{{ route("all-portfolio-items") }}"></portfolio>
    <clients/>
    <education-and-experience/>
    <contact-form :submit_contact_request_route="'{{ route('submit-contact-request') }}'" :csrf_token="'{{ csrf_token() }}'" :contact_form_successfully_sent="{{ session()->get('submit_contact_request_successful') }}"></contact-form>
</x-app>
