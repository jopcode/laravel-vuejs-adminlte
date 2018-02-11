import VueRouter from 'vue-router';
import routes from './../routes';

export default new VueRouter({
    routes: routes,
    mode: 'hash',
    linkExactActiveClass: 'active',
    scrollBehavior: function (to, from, savedPosition) {
        return savedPosition || { x: 0, y: 0 }
    }
});