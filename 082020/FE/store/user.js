export const state = () => ({
    user: {}
});

export const mutations = {
    SET_USER (state, payload) {
        state.user = payload
    }
}

