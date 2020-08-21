export default function ({ isHMR, app, store, route, params, error, redirect }) {
    const defaultLocale = app.i18n.fallbackLocale
    if (isHMR) return
    const locale = route.query.lang || defaultLocale
    if (store.state.locales.indexOf(locale) === -1) {
        redirect(route.path + `?lang=${defaultLocale}`)
    }
    store.commit('SET_LANG', locale)
    app.i18n.locale = store.state.locale
}
