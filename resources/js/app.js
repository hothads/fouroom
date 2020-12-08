require('./bootstrap');

window.Vue = require('vue');

import InstantSearch from "vue-instantsearch";
Vue.use(InstantSearch);

let authorizations = require('./authorizations');

//глобальная переменная
window.Vue.prototype.authorize = function(...params){
    if (typeof params[0] === 'string') {
        return authorizations[params[0]](params[1]);
    }
    return params[0](window.App.user);
};

window.Vue.prototype.signedIn = window.App.signedIn;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('main-menu', require('./components/MenuComponent.vue').default);
Vue.component('thread-view', require('./pages/Thread.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);
Vue.component('search', require('./components/SearchOnFly.vue').default);

Vue.component('wysiwyg', require('./components/Wysiwyg.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', { message, level });
};

const app = new Vue({
    el: '#app',
});
