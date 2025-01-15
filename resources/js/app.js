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
app.component('portfolio-item-modal', require('./components/PortfolioItemModal.vue').default);
app.component('section-title', require('./components/SectionTitle.vue').default);
app.component('site-footer', require('./components/Footer.vue').default);
app.component('site-header', require('./components/Header.vue').default);
app.component('hero-section', require('./components/HeroSection.vue').default);
app.component('about-me', require('./components/AboutMe.vue').default);
app.component('approach', require('./components/Approach.vue').default);
app.component('portfolio', require('./components/Portfolio.vue').default);
app.component('cta', require('./components/Cta.vue').default);
app.component('education-and-experience', require('./components/EducationAndExperience.vue').default);
app.component('contact-form', require('./components/ContactForm.vue').default);
app.component('portfolio-details', require('./components/PortfolioDetails.vue').default);
app.component('portfolio-item', require('./components/PortfolioItem.vue').default);
app.component('clients', require('./components/Clients.vue').default);
app.component('skills', require('./components/Skills.vue').default);
app.component('skill', require('./components/Skill.vue').default);
app.component('back-to-top', require('./components/BackToTop.vue').default);
app.component('whatsapp', require('./components/Whatsapp.vue').default);

app.mount('#app');
app.use(vClickOutside)
