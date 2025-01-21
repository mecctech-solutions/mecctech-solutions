import {Ref, ref} from 'vue'

export default function useScreenSize() {
    const mobileBreakpoint = 768;
    const tabletBreakpoint = 1024;
    const desktopBreakpoint = 1280;

    const isMobile: Ref = ref(window.innerWidth < mobileBreakpoint);
    const isTablet: Ref = ref(window.innerWidth >= tabletBreakpoint && window.innerWidth < desktopBreakpoint);
    const isDesktop: Ref = ref(window.innerWidth >= desktopBreakpoint);

    window.addEventListener("resize", updateMobileStatus);

    function updateMobileStatus() {
        isMobile.value = window.innerWidth < mobileBreakpoint;
        isTablet.value = window.innerWidth >= mobileBreakpoint && window.innerWidth < desktopBreakpoint;
        isDesktop.value = window.innerWidth >= desktopBreakpoint;
    }

    return {isMobile, isTablet, isDesktop};
}
