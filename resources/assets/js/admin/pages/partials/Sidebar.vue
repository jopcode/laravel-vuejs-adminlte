<template>
    <aside class="main-sidebar">
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img :src="auth_user.profile_image" class="img-circle">
                </div>
                <div class="pull-left info">
                    <p>{{ auth_user.name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"></li>

                <router-link :to="{ name:'dashboard' }" tag="li">
                    <a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </router-link>

                <router-link :to="{ name:'users' }" tag="li">
                    <a href="#"><i class="fa fa-list"></i> <span>Users</span></a>
                </router-link>
            </ul>
        </section>
    </aside>
</template>

<script>
export default {
	computed: {
		auth_user(){
			return this.$store.state.user;
		}
	},
	created(){
		this.$store.dispatch('getUserData');
	}
}
</script>
