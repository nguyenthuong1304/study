export default {
  mode: 'universal',
  head: {
    title: process.env.npm_package_name || 'Admin Sexy Girl Collection',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1, shrink-to-fit=no' },
      { hid: 'description', name: 'description', content: process.env.npm_package_description || '' }
    ],
    script: [
      { src: 'https://code.jquery.com/jquery-3.5.1.slim.min.js' },
      { src: 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' },
      { src: 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: 'stylesheet',
        type: 'text/css',
        href: 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
      }
    ]
  },
  /*
  ** Customize the progress-bar color
  */
  loading: '~/components/loading.vue',
  /*
  ** Global CSS
  */
  css: [
    'element-ui/lib/theme-chalk/index.css',
    '@assets/css/nice-select.css',
    '@assets/css/bootstrap.min.css',
    '@assets/css/elegant-icons.css',
  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    '@/plugins/element-ui',
    '@/plugins/i18n',
    '@/plugins/vuetify',
  ],

  // router middleware
  router: {
    middleware: ['i18n']
  },
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
  ],
  /*
  ** Nuxt.js modules
  */
  modules: [
    // Doc: https://axios.nuxtjs.org/usage
    '@nuxtjs/axios',
    '@nuxtjs/pwa',
    // Doc: https://github.com/nuxt-community/dotenv-module
    '@nuxtjs/dotenv',
    '@nuxtjs/auth',
  ],
  /*
  ** Axios module configuration
  ** See https://axios.nuxtjs.org/options
  */
  axios: {
    headers: {
      "Access-Control-Allow-Origin": "*",
      "X-Requested-With": "XMLHttpRequest"
    }
  },
  auth: {
      strategies: {
          local: {
              endpoints: {
                  login: {url: `${process.env.API_AUTH}/login`, method: 'post', propertyName: 'access_token'},
                  user: {url: `${process.env.API_AUTH}/me`, method: 'post', propertyName: 'data'},
                  logout: { url: `${process.env.API_AUTH}/logout`, method: 'post' },
              }
          }
      }
  },
  /*
  ** Build configuration
  */
  build: {
    transpile: [/^element-ui/, '@nuxtjs/auth'],
    /*
    ** You can extend webpack config here
    */
    extend (config, ctx) {
    }
  }
}
