import vClickOutside from "click-outside-vue3"

require('./bootstrap');

const app = Vue.createApp({
    props: ['view_my_work_button_clicked'],
    el: '#app',
});

app.component('view-my-work', require('./components/ViewMyWork.vue').default);
app.component('skill', require('./components/Skill.vue').default);
app.component('portfolio-items', require('./components/PortfolioItems.vue').default);
app.component('portfolio-item', require('./components/PortfolioItem.vue').default);
app.component('portfolio-item-modal', require('./components/PortfolioItemModal.vue').default);
app.component('contact-form', require('./components/ContactForm.vue').default);
app.component('section-title', require('./components/SectionTitle.vue').default);
app.component('mecc-tech-footer', require('./components/MeccTechFooter.vue').default);

app.mount('#app');
app.use(vClickOutside)
