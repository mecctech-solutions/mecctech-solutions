import vClickOutside from "click-outside-vue3"
import {createStore} from 'vuex'
import Lang from 'lang.js'

var translations = require('./vue-translations');

require('./bootstrap');

const app = Vue.createApp({
    props: ['view_my_work_button_clicked'],
    el: '#app',
    methods: {
        rerenderComponents() {
            console.log('Rerendering components...')
            this.$forceUpdate();
        },
        baseUrl() {
            return window.location.origin;
        }
    }
});

var lang = new Lang({
    'messages' : translations,
    'locale' : 'nl'
});

// Create a new store instance.
const store = createStore({
    state () {
        return {
            currentNavElement: "home",
            locale: "nl"
        }
    },
    mutations: {
        changeCurrentNavElement (state, navElement) {
            state.currentNavElement = navElement;
        },
        changeLocale (state, locale) {
            state.locale = locale;
        }
    }
})

app.use(store)

app.config.globalProperties.$lang = lang;
app.component('view-my-work', require('./components/ViewMyWork.vue').default);
app.component('portfolio-item-modal-v2', require('./components/PortfolioItemModalV2.vue').default);
app.component('section-title', require('./components/SectionTitle.vue').default);
app.component('mecc-tech-footer-v2', require('./components/MeccTechFooterV2.vue').default);
app.component('mecc-tech-header-v2', require('./components/MeccTechHeaderV2.vue').default);
app.component('hero-section', require('./components/HeroSection.vue').default);
app.component('about-me-v2', require('./components/AboutMeV2.vue').default);
app.component('approach', require('./components/Approach.vue').default);
app.component('portfolio', require('./components/Portfolio.vue').default);
app.component('cta', require('./components/Cta.vue').default);
app.component('education-and-experience', require('./components/EducationAndExperience.vue').default);
app.component('contact-form-v2', require('./components/ContactFormV2.vue').default);
app.component('portfolio-details', require('./components/PortfolioDetails.vue').default);
app.component('portfolio-item-v2', require('./components/PortfolioItemV2.vue').default);
app.component('clients', require('./components/Clients.vue').default);
app.component('skills-v2', require('./components/SkillsV2.vue').default);
app.component('skill-v2', require('./components/SkillV2.vue').default);
app.component('back-to-top', require('./components/BackToTop.vue').default);
app.component('whatsapp', require('./components/Whatsapp.vue').default);

app.mount('#app');
app.use(vClickOutside)
