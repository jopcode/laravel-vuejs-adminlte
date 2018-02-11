import Vue from 'vue';
import axios from 'axios';

axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response.status === 500) {
            Vue.prototype.$awn.alert('Whoops, something went wrong');
        }
        return Promise.reject(error);
    }
);