<x-master>
{{--    <section id="home">--}}
{{--        <div class="flex h-screen">--}}
{{--            <view-my-work></view-my-work>--}}
{{--        </div>--}}
{{--    </section>--}}
    <mecc-tech-header-v2></mecc-tech-header-v2>
    <hero-section></hero-section>
    <about-me-v2></about-me-v2>
    <services></services>
    <portfolio></portfolio>
    <cta></cta>
    <education-and-experience></education-and-experience>
    <contact-form-v2></contact-form-v2>

{{--    <section id="about-me">--}}
{{--        <about-me></about-me>--}}
{{--    </section>--}}
{{--    <section id="projects">--}}
{{--        <portfolio-items get_all_portfolio_items_route="{{ route("all-portfolio-items") }}"></portfolio-items>--}}
{{--    </section>--}}
{{--    <section id="contact">--}}
{{--        <contact-form :submit_contact_request_route="'{{ route('submit-contact-request') }}'" :csrf_token="'{{ csrf_token() }}'" :contact_form_successfully_sent="{{ session()->get('submit_contact_request_successful') }}"></contact-form>--}}
{{--    </section>--}}

{{--    <footer>--}}
{{--        <mecc-tech-footer></mecc-tech-footer>--}}
{{--    </footer>--}}
</x-master>

<script>
    import HeroSection from "../js/components/HeroSection";
    import AboutMeV2 from "../js/components/AboutMeV2";
    import EducationAndExperience from "../js/components/EducationAndExperience";
    export default {
        components: {EducationAndExperience, AboutMeV2, HeroSection}
    }
</script>
