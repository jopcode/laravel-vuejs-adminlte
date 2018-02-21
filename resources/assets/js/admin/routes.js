const routes = [{
		path: '/login',
		component: require('./pages/Login.vue'),
		name: 'login',
		meta: {
			requiresAuth: false
		},
	},
	{
		path: '/',
		component: require('./pages/Admin.vue'),
		meta: {
			requiresAuth: true
		},
		children: [{
				path: '/',
				component: () => import ('./pages/views/Dashboard.vue'), // lazy load
				name: 'dashboard',
			},
			{
				path: '/dashboard',
				redirect: '/',
			},
			{
				path: '/profile',
				component: () => import ('./pages/views/Profile.vue'), // lazy load
				name: 'profile',
			},
			{
				path: '/users',
				component: () => import ('./pages/views/Users.vue'), // lazy load
				name: 'users',
			}
		]
	},
	{
		// not found handler
		path: '*',
		component: require('./pages/NotFound.vue'),
	}
];

export default routes;