<template>
	<div class="login-box">
        <div class="login-logo"><b>TEST</b> Admin</div>

        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <div class="form-group has-feedback" :class="{ 'has-error': errors.has('username') }">
                <input type="text" 
                    name="username"
                    v-model="username" 
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
            username: '',
            password: '',
            signin_error: null,
        }
    },
    components: { AppAlert },
    methods: {
        signIn() {
            this.$validator.validateAll().then(valid => {
                if (valid) {
                    axios.post( Ziggy.baseUrl + 'oauth/token', this.getParams())
                        .then( response => {
                            this.$auth.setToken(response.data.access_token, response.data.expires_in);
                            this.$router.push({ name: 'dashboard' });
                        })
                        .catch( error => {
                            this.signin_error = error.response.data.message;
                        });
                }else{
                    this.signin_error = this.errors.all()[0];
                }
            });
        },
        getParams() {
            return {
                username: this.username,
                password: this.password,
                client_id: 2,
                client_secret: 'OaBdufeaVNlg2efPFv4EHvJF6gCrs17wcbwzsJD7',
                grant_type: 'password',
            };
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
    z-index: 999999;
}
</style>