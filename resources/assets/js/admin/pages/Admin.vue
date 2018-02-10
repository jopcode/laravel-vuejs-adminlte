<template>
	<div class="wrapper">
		<app-header></app-header>

		<app-sidebar></app-sidebar>
		
		<!-- Content Wrapper -->
		<div class="content-wrapper">
			<router-view></router-view>
		</div>
		
		<app-footer></app-footer>

		<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
</template>

<script>
import AppHeader from './partials/Header';
import AppSidebar from './partials/Sidebar';
import AppFooter from './partials/Footer';

export default {
	components: {
		AppHeader, AppSidebar, AppFooter
	}
}
</script>
