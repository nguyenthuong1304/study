<template>
  <section class="hero set-bg" :data-setbg="bg" :style="{ backgroundImage: 'url(\'' + bg + '\')'}">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="hero__text">
            <div class="section-title">
              <h2>Discover The Best Services Near You</h2>
              <p>1.118.940.376 The best service package is waiting for you</p>
            </div>
            <div class="hero__search__form">
              <form action="#">
                <input
                  type="text"
                  :placeholder="$t('keyword_s')"
                  class="bg-white"
                  v-model="keyWord"
                />
                <input
                  type="text"
                  :placeholder="$t('location_s')"
                  class="bg-white"
                  v-model="location"
                  style="width: 22%"
                />
                <div class="select__option">
                  <el-select
                    v-model="cates"
                    multiple
                    collapse-tags
                    :placeholder="$t('chooseCate')"
                    :class="'nice-select pr-0'"
                    size="large"
                  >
                    <el-option
                      v-for="item in categories"
                      :key="item.id"
                      :label="item.name"
                      :value="item.id"
                    ></el-option>
                  </el-select>
                </div>
                <button type="submit" @click.prevent="submitSearch">{{ $t("searchInput") }}</button>
              </form>
            </div>
            <ul class="hero__categories__tags">
              <li v-for="(cate, index) in categories">
                <a href="#">
                  <img src="../assets/img/hero/cat-1.png" alt :key="index" />
                  {{ cate.name }}
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="../assets/img/hero/cat-6.png" alt /> All Categories
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import bg from "../assets/img/hero/hero-bg.jpg";

export default {
  props: ["categories"],
  name: "SectionSearch",
  data() {
    return {
      bg: bg,
      keyWord: "",
      cates: [],
      location: ""
    };
  },
  methods: {
    submitSearch() {
      this.$router.push(
        `/listing?keyword=${this.keyWord}&cates=${this.cates}&location=${this.location}`
      );
    }
  }
};
</script>

<style>
.el-input__inner {
  padding: 0px !important;
}
.el-select > .el-input {
  display: inline-block !important;
}
.nice-select:after {
  content: none;
}
</style>