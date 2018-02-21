<template>
    <div>
        <section class="content-header">
            <h1>User Profile</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-sm-8 col-md-6 col-lg-4">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="">

                            <h3 class="profile-username text-center">{{ auth_user.name }}</h3>

                            <p class="text-muted text-center">
                                <span v-for="role in auth_user.roles">{{ role.name }}</span>
                            </p>

                            <hr>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Enter your name">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" v-model="email" placeholder="Enter your email">
                            </div>

                            <div class="form-group">
                                <label>Roles</label>
                                <v-select :options="roles" multiple></v-select>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" v-model="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group">
                                <label>Password Repeat</label>
                                <input type="password" class="form-control" v-model="password_repeat" placeholder="Repeat your password">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary btn-block"><strong>Save</strong></button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import vSelect from 'vue-select';

export default {
    components: {
        vSelect
    },
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_repeat: '',
            roles: [{
                label: 'Admin',
                value: 1,
            }],
        }
    },
    computed: {
		auth_user(){
			return this.$store.state.user;
		}
	},
}
</script>
