import Vue from 'vue';
import router from './router';

// check if the user is authenticated
router.beforeEach( async (to, from, next) => {
    let is_authenticated  = await Vue.prototype.$auth.check();

    if (to.matched.some(record => record.meta.requiresAuth) && ! is_authenticated) {
        next({ name: 'login' });
    } else {
        next();
    }
});

// this check will be ran when page is loaded
router.onReady( async (route) => {
    let auth = route.matched.some(record => { return record.meta.requiresAuth || false });
    let is_authenticated = await Vue.prototype.$auth.check();

    if ( auth && ! is_authenticated && route.name !== 'login') {
        router.push({ name: 'login' });
    }
    else if ( auth && is_authenticated && route.name === 'login') {
        router.push({ name: 'dashboard' });
    }
});