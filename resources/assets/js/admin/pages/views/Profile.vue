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

                            <div class="form-group" :class="{ 'has-error': errors.has('name') }">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control"
                                    v-model="params.name"
                                    v-validate="'required'"
                                    placeholder="Enter your name">
                            </div>

                            <div class="form-group" :class="{ 'has-error': errors.has('email') }">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control"
                                    v-model="params.email"
                                    v-validate="'required|email'"
                                    placeholder="Enter your email">
                            </div>

                            <div class="form-group" :class="{ 'has-error': errors.has('roles') }">
                                <label>Roles</label>
                                <v-select name="roles"
                                    @input="setRole"
                                    :options="roles"
                                    label="name"
                                    v-validate="'required'"
                                    placeholder="Select at least one role"
                                    multiple></v-select>
                            </div>

                            <hr>

                            <div class="form-group" :class="{ 'has-error': errors.has('password') }">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control"
                                    v-model="params.password"
                                    v-validate="(params.password.length > 0) ? 'required|min:6' : ''"
                                    placeholder="Enter your password">
                            </div>

                            <div class="form-group" :class="{ 'has-error': errors.has('password_confirmation') }">
                                <label>Password Repeat</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    v-model="params.password_confirmation"
                                    v-validate="'confirmed:password'"
                                    placeholder="Repeat your password">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary btn-block" @click="save()"><strong>Save</strong></button>
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
import axios from 'axios';
import _ from 'lodash';

export default {
    components: {
        vSelect
    },
    data() {
        return {
            params: {
                name: '',
                email: '',
                roles: [],
                password: '',
                password_confirmation: '',
            },
            roles: [],
        }
    },
    computed: {
		auth_user(){
			return this.$store.state.user;
		}
    },
    mounted() {
        this.params.name = this.auth_user.name;
        this.params.email = this.auth_user.email;
        this.params.roles = _.clone(this.auth_user.roles);

        axios.get(route('admin.api.roles.index'))
            .then((response) => {
                this.roles = response.data;
            });
    },
    methods: {
        save() {
            this.$validator.validateAll().then(valid => {
                if (valid) {
                    axios.put(route('admin.api.auth.user.update'), this.params)
                        .then(() => {
                            this.$awn.success('params was saved successfully');
                        });
                }
                console.log(this.$validator.errors);
            });
        },
        setRole(selections){
            this.params.roles = _.map(selections, (selection) => { return selection.id });
        }
    }
}
</script>