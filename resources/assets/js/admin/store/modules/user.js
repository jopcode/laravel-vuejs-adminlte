import axios from 'axios';

const state = {
    id: null,
    name: '',
    email: '',
    profile_image: null,
    created_at: null,
    updated_at: null,
    roles: [],
};

const mutations = {
    SET_USER: (state, payload) => {
        state.id = payload.id;
        state.name = payload.name;
        state.email = payload.email;
        state.profile_image = payload.profile_image;
        state.created_at = payload.created_at;
        state.updated_at = payload.updated_at;
        state.roles = payload.roles;
    }
};

const actions = {
    getUserData: (context, payoload) => {
        axios.get( route('admin.api.auth.user') )
            .then( (response) => {
                context.commit('SET_USER', response.data);
            });
    }
};

export default {
    state,
    mutations,
    actions
}
