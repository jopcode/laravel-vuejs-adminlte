import Vue from 'vue';
import router from './router';

// check if the user is authenticated
router.beforeEach((to, from, next) => {
    console.log('AuthCheck', Vue.prototype.$auth.check());

    if (to.matched.some(record => record.meta.requiresAuth) && ! Vue.prototype.$auth.check()) {
        next({ name: 'login' });
    } else {
        next();
    }
});

// this check will be ran when page is loaded
router.onReady( route => {
    var auth = route.matched.some(record => { return record.meta.requiresAuth || false });

    if ( auth && !Vue.prototype.$auth.check() && route.name !== 'login') {
        router.push({ name: 'login' });
    }
    else if ( auth && Vue.prototype.$auth.check() && route.name === 'login') {
        router.push({ name: 'dashboard' });
    }
});