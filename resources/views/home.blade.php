<x-master>
    <back-to-top></back-to-top>
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

<script>
    import HeroSection from "../js/components/HeroSection";
    import AboutMeV2 from "../js/components/AboutMeV2";
    import EducationAndExperience from "../js/components/EducationAndExperience";
    import MeccTechFooterV2 from "../js/components/MeccTechFooterV2";

    export default {
        components: {MeccTechFooterV2, EducationAndExperience, AboutMeV2, HeroSection}
    }
</script>
