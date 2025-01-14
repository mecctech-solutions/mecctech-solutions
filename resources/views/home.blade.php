<x-master>
    <back-to-top></back-to-top>
    <whatsapp></whatsapp>
    <mecc-tech-header-v2></mecc-tech-header-v2>
    <hero-section></hero-section>
    <about-me-v2></about-me-v2>
    <skills-v2></skills-v2>
    <approach></approach>
    <portfolio get_all_portfolio_items_route="{{ route("all-portfolio-items") }}"></portfolio>
    <clients></clients>
    <education-and-experience></education-and-experience>
    <contact-form-v2 :submit_contact_request_route="'{{ route('submit-contact-request') }}'" :csrf_token="'{{ csrf_token() }}'" :contact_form_successfully_sent="{{ session()->get('submit_contact_request_successful') }}"></contact-form-v2>
    <mecc-tech-footer-v2></mecc-tech-footer-v2>

</x-master>
