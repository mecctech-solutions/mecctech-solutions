/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('view-my-work', require('./components/ViewMyWork.vue').default);
Vue.component('skill', require('./components/Skill.vue').default);
Vue.component('portfolio-items', require('./components/PortfolioItems.vue').default);
Vue.component('portfolio-item', require('./components/PortfolioItem.vue').default);
Vue.component('portfolio-item-modal', require('./components/PortfolioItemModal.vue').default);
Vue.component('contact-form', require('./components/ContactForm.vue').default);

Vue.directive('click-outside', {
    bind: function (el, binding, vnode) {
        this.event = function (event) {
            if (!(el === event.target || el.contains(event.target))) {
                vnode.context[binding.expression](event);
            }
        };
        document.body.addEventListener('click', this.event)
    },
    unbind: function (el) {
        document.body.removeEventListener('click', this.event)
    },
});

const app = new Vue({
    props: ['view_my_work_button_clicked'],
    el: '#app',
});
