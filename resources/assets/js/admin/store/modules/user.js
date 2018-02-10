const state = {
    id: null,
    first_name: '',
    last_name: '',
};

const mutations = {
    SET_USER: (state, payload) => {
        state.id = payload.id;
        state.first_name = payload.first_name;
        state.last_name = payload.last_name;
    }
};

export default {
    state,
    mutations
}
