<template>
  <div class="col-lg-3">
    <div class="card card-one">
      <div class="header-card">
        <div class="avatar">
          <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt />
        </div>
      </div>
      <h3>{{ user.last_name }}</h3>
      <div
        class="desc"
      >Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.</div>
      <div class="contacts">
        <a href="#">
          <i class="fas fa-plus"></i>
        </a>
        <a href="#">
          <i class="fab fa-whatsapp"></i>
        </a>
        <a href="#">
          <i class="fas fa-envelope"></i>
        </a>
        <div class="clear"></div>
      </div>
      <div class="footer">
        <a href="#">
          <i class="fab fa-facebook"></i>
        </a>
        <a href="#">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="#">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: Object
  },
  name: "UserFavorite"
};
</script>

<style>
</style>