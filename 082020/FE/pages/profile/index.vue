<template>
  <div class="container-xs mt-15">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
      rel="stylesheet"
    />
    <div class="row">
      <div class="col-md-1 col-lg-1"></div>
      <CardProfile :user="user"></CardProfile>
      <div class="col-md-9 col-lg-9 col-xl-12 row">
        <UserFavorite v-for="(user, index) in user.favoriters" :key="index" :user="user"/>
      </div>
    </div>
  </div>
</template>
<script>
import { mapMutations } from "vuex";
import global from "~/mixins/global.js";
import CardProfile from "../../components/Sidebar/CardProfile";
import UserFavorite from "../../components/Home/UserFavorite";

export default {
  middleware: ['isAuthenticated'],
  components: { CardProfile, UserFavorite },
  data() {
    return {
      user: this.$store.state.auth.user
    }
  },
  created() {
    this.setLoading(false);
  },
  methods: {
    ...mapMutations({
      setLoading: "SET_LOADING_PAGE"
    })
  }
};
</script>
<style lang="scss">
@import '../../assets/sass/profile.scss';
</style>