<template>
  <header class="header header--normal">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <div class="header__logo">
            <a href="./index.html">
              <img src="img/logo.png" alt />
            </a>
          </div>
        </div>
        <div class="col-lg-9 col-md-9">
          <div class="header__nav">
            <nav class="header__menu mobile-menu">
              <ul>
                <li :class="{ active: routeName === 'index' }">
                  <nuxt-link to="/">{{ $t('home') }}</nuxt-link>
                </li>
                <li :class="{ active: routeName === 'listing' }">
                  <nuxt-link to="/listing">{{ $t('list') }}</nuxt-link>
                </li>
                <li>
                  <a href="#">{{ $t('category') }}</a>
                </li>
                <li>
                  <a href="#">Pages</a>
                  <ul class="dropdown">
                    <li>
                      <a href="./about.html">About</a>
                    </li>
                    <li>
                      <a href="./listing-details.html">Listing Details</a>
                    </li>
                    <li>
                      <a href="./blog-details.html">Blog Details</a>
                    </li>
                    <li>
                      <a href="./contact.html">Contact</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="./blog.html">Blog</a>
                </li>
                <li>
                  <a href="#">Shop</a>
                </li>
              </ul>
            </nav>
            <div class="header__menu__right">
              <a href="#" class="primary-btn" v-if="isAuthenticated">
                <i class="fa fa-plus"></i>Add Listing
              </a>
              <a
                class="login-btn dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-user"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <nuxt-link to="/login" v-if="!isAuthenticated" class="dropdown-item">{{ $t('login') }}</nuxt-link>
                <template v-else>
                    <nuxt-link class="dropdown-item" to="/profile">{{ $t('profile') }}</nuxt-link>
                    <a class="dropdown-item" href="#" @click.prevent="logout">{{ $t('logout') }}</a>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="mobile-menu-wrap"></div>
    </div>
  </header>
</template>
<script>
import { mapGetters } from "vuex";

export default {
  name: "Header",
  computed: {
    routeName() {
      return this.$route.name;
    },
    ...mapGetters(["isAuthenticated"])
  },
  methods: {
      async logout() {
        await this.$auth.logout()
        this.$notify.success({
            title: 'Đăng xuất',
            message: 'Đăng xuất thành công'
        })
      }
  }
};
</script>

<style scoped>
.dropdown:hover > .dropdown-menu {
  display: block;
}

.dropdown > .dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
  pointer-events: none;
}
.dropdown-toggle::after{
    content: none;
}
</style>