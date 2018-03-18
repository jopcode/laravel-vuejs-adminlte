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
				component: () => import ('./pages/views/dashboard/Index.vue'), // lazy load
				name: 'dashboard',
			},
			{
				path: '/dashboard',
				redirect: '/',
			},
			{
				path: '/profile',
				component: () => import ('./pages/views/profile/Index.vue'),
				name: 'profile',
			},
			{
				path: '/users',
				component: () => import ('./pages/views/users/Index.vue'),
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