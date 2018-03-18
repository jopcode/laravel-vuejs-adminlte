<template>
	<header class="main-header">
		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini">
				<b>A</b>LT</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg">
				<b>Admin</b>LTE</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- Messages: style can be found in dropdown.less-->
					<li class="dropdown messages-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-envelope-o"></i>
							<span class="label label-success">4</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 4 messages</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
									<li>
										<!-- start message -->
										<a href="#">
											<div class="pull-left">
												<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
											</div>
											<h4>
												Support Team
												<small>
													<i class="fa fa-clock-o"></i> 5 mins</small>
											</h4>
											<p>Why not buy a new awesome theme?</p>
										</a>
									</li>
									<!-- end message -->
								</ul>
							</li>
							<li class="footer">
								<a href="#">See All Messages</a>
							</li>
						</ul>
					</li>

					<!-- Notifications: style can be found in dropdown.less -->
					<li class="dropdown notifications-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i>
							<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">You have 10 notifications</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu">
									<li>
										<a href="#">
											<i class="fa fa-users text-aqua"></i> 5 new members joined today
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-users text-red"></i> 5 new members joined
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-shopping-cart text-green"></i> 25 sales made
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-user text-red"></i> You changed your username
										</a>
									</li>
								</ul>
							</li>
							<li class="footer">
								<a href="#">View all</a>
							</li>
						</ul>
					</li>

					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu" :class="{ open: dropdown.user }">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" @click="dropdown.user = !dropdown.user">
							<span class="hidden-xs">{{ auth_user.name }}</span>
						</a>
						<ul class="dropdown-menu" @mouseleave="dropdown.user = false">
							<!-- User image -->
							<li class="user-header">
								<img :src="auth_user.profile_image" class="img-circle">

								<p>
									{{ auth_user.name }}
									<small>Member since {{ registered_at }}</small>
								</p>
							</li>
							<!-- Menu Body -->
							<li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</div>
								<!-- /.row -->
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<router-link :to="{ name: 'profile' }" class="btn btn-default btn-flat">Profile</router-link>
								</div>
								<div class="pull-right">
									<button @click="signOut" class="btn btn-default btn-flat">Sign out</button>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
	</header>
</template>

<script>
import moment from 'moment';

export default {
	data() {
		return {
			dropdown: {
				user: false,
			}
		}
	},
	computed: {
		auth_user(){
			return this.$store.state.user;
		},
		registered_at() {
			return moment(this.auth_user.created_at).format('MMM YYYY');
		}
	},
	methods: {
		signOut() {
			this.$auth.logout();

			this.$router.push({ name: 'login' });
		}
	}
}
</script>
