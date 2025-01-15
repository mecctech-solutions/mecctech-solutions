<x-app>
    <hero-section></hero-section>
    <about-me></about-me>
    <skills></skills>
    <approach></approach>
    <portfolio get_all_portfolio_items_route="{{ route("all-portfolio-items") }}"></portfolio>
    <clients></clients>
    <education-and-experience></education-and-experience>
    <contact-form :submit_contact_request_route="'{{ route('submit-contact-request') }}'" :csrf_token="'{{ csrf_token() }}'" :contact_form_successfully_sent="{{ session()->get('submit_contact_request_successful') }}"></contact-form>
</x-app>
