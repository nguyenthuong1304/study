export const state = () => ({
    categories: [],
    locales: ['en', 'vi'],
    locale: 'vi',
    isLoadingPage: true,
});

export const mutations = {
    setCategories (state, payload) {
        state.categories = payload
    },
    SET_LANG (state, locale) {
        if (state.locales.indexOf(locale) !== -1) {
            state.locale = locale
        }
    },
    SET_LOADING_PAGE (state, payload) {
        state.isLoadingPage = payload
    }
}

export const getters = {
    isAuthenticated(state) {
        return state.auth.loggedIn
    },
    loggedInUser(state) {
        return state.auth.user
    }
}

export const actions = {

}
