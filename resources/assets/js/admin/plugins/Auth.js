import axios from 'axios';
import { client_id, client_secret } from './../env';

export default function (Vue) {
	Vue.auth = {
		/**
		 * Login user
		 *
		 * @param {string} email
		 * @param {string} password
		 */
		login(email, password) {
			let vm = this;

			let params = {
				username: email,
				password: password,
				client_id: client_id,
				client_secret: client_secret,
				grant_type: 'password',
				scope: '',
			};

			let promise = new Promise( (resolve, reject) => {
				axios.post(Ziggy.baseUrl + 'oauth/token', params)
					.then(response => {
						if (response.data.access_token !== undefined) {
							vm.setToken(
								response.data.access_token,
								response.data.refresh_token,
								response.data.expires_in
							);
						}

						resolve(response);
					})
					.catch( error => {
						reject(error);
					});
			});

			return promise;
		},

		/**
		 * Logout user by destroying token
		*/
		logout() {
			this.destroy();
		},

		/**
		 * Check if user is authenticated
		*/
		async check() {
			let access_token = await this.getToken();

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;

			return access_token ? true : false;
		},

		/**
		 * Refresh token
		*/
		refreshToken() {
			let vm = this;

			let params = {
				grant_type: 'refresh_token',
				refresh_token: localStorage.getItem('refresh_token'),
				client_id: client_id,
				client_secret: client_secret,
				scope: '',
			};

			let promise = new Promise((resolve, reject) => {
				axios.post(Ziggy.baseUrl + 'oauth/token', params)
					.then(response => {
						if (response.data.access_token !== undefined) {
							vm.setToken(
								response.data.access_token,
								response.data.refresh_token,
								response.data.expires_in
							);
						}

						resolve(response);
					})
					.catch(error => {
						reject(error);
					});
			});

			return promise;
		},

		/**
		 * Set new access and refresh token
		 *
		 * @param {string} access_token
		 * @param {string} refresh_token
		 * @param {integer} expiration
		 */
		setToken(access_token, refresh_token, expiration) {
			let expiration_miliseconds = parseInt(expiration) * 1000;

			localStorage.setItem('access_token', access_token);
			localStorage.setItem('refresh_token', refresh_token);
			localStorage.setItem('expiration', Date.now() + expiration_miliseconds);

			axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token;
		},

		/**
		 * Get access token or if it has expired
		 * get a new one using refresh token
		*/
		async getToken() {
			let access_token = localStorage.getItem('access_token');
			let expiration = localStorage.getItem('expiration');

			if (!access_token || !expiration) {
				return null;
			}

			if (Date.now() < parseInt(expiration)) {
				return access_token;
			}

			await this.refreshToken()
				.then( response => {
					console.info('Token refreshed');
					access_token = response.data.access_token;
				})
				.catch( () => {
					this.destroy();
					access_token = null;
				});

			return access_token;
		},

		/**
		 * Clear tokens from local storage
		*/
		destroy() {
			localStorage.removeItem('access_token');
			localStorage.removeItem('refresh_token');
			localStorage.removeItem('expiration');
		},
	}

	Object.defineProperties(Vue.prototype, {
		$auth: {
			get() {
				return Vue.auth;
			}
		}
	});
}