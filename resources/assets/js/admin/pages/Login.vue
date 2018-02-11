<template>
	<div class="login-box">
        <div class="login-logo"><b>TEST</b> Admin</div>

        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <div class="form-group has-feedback" :class="{ 'has-error': errors.has('email') }">
                <input type="text"
                    name="email"
                    v-model="email"
                    class="form-control"
                    placeholder="Email"
                    v-validate="'required|email'"
                    @keyup.enter="signIn()"
                    @keyup="clearSignInError()">

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback" :class="{ 'has-error': errors.has('password') }">
                <input type="password"
                    name="password"
                    v-model="password"
                    class="form-control"
                    placeholder="Password"
                    v-validate="'required|min:6'"
                    @keyup.enter="signIn()"
                    @keyup="clearSignInError()">

                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" @click="signIn()" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>

        </div><!-- /.login-box-body -->

        <animated-slide-in-down>
            <app-alert type="danger" :message="signin_error" v-if="signin_error"></app-alert>
        </animated-slide-in-down>
    </div>
</template>

<script>
import axios from 'axios';
import AppAlert from './../components/Alert';

export default {
    data() {
        return {
            email: '',
            password: '',
            signin_error: null,
        }
    },
    components: { AppAlert },
    methods: {
        signIn() {
            this.$validator.validateAll().then(valid => {
                if (valid) {
                    this.$auth.login(this.email, this.password)
                        .then(() => { this.$router.push({ name: 'dashboard' }); })
                        .catch(error => { this.signin_error = error.response.data.message; });
                }else{
                    this.signin_error = this.errors.all()[0];
                }
            });
        },
        clearSignInError() {
            this.signin_error = null;
        }
    }
}
</script>

<style lang="scss" scoped>
.login-box-body {
    position: relative;
    z-index: 1;
}
</style>