import axios from 'axios';

export default function (Vue) {
	Vue.auth = {
		setToken(token, expiration) {
			let expiration_miliseconds = parseInt(expiration) * 1000;

			localStorage.setItem('token', token);
			localStorage.setItem('expiration', Date.now() + expiration_miliseconds);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
		},
		getToken() {
			let token = localStorage.getItem('token');
			let expiration = localStorage.getItem('expiration');

			if( ! token || ! expiration ) {
				return null;
			}

			if( Date.now() > parseInt(expiration) ) {
				this.destroyToken();
				return null;
			}

			return token;
		},
		destroyToken() {
			localStorage.removeItem('token');
			localStorage.removeItem('expiration');
		},
		isAuthenticated() {
			return this.getToken() ? true : false;
		}
	}

	Object.defineProperties(Vue.prototype, {
		$auth: {
			get() {
				return Vue.auth;
			}
		}
	});
}