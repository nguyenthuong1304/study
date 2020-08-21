<template>
  <div class="ov-hid">
    <FilterSidebar :options="options" :queryString="queryString"></FilterSidebar>
    <section class="listing nice-scroll">
      <div class="listing__text__top">
        <div class="listing__text__top__left">
          <h5>Restaurants</h5>
          <span>18 Results Found</span>
        </div>
        <div class="listing__text__top__right">
          Nearby
          <i class="fa fa-sort-amount-asc"></i>
        </div>
      </div>
      <div class="listing__list">
        <ItemUser v-for="(user, index) in collection" :user="user" :key="index"></ItemUser>
      </div>
      <div class="text-center">
        <el-pagination
          background
          @current-change="changePage"
          layout="prev, pager, next"
          :total="total"
        ></el-pagination>
      </div>
    </section>
    <div class="listing__map">
      <RecentPost></RecentPost>
      <Category :cateCount="cateCount"></Category>
      <Tag :tags="tags"></Tag>
    </div>
  </div>
</template>

<script>
import RecentPost from "../../components/Sidebar/RecentPost";
import Category from "../../components/Sidebar/Category";
import Tag from "../../components/Sidebar/Tag";
import FilterSidebar from "../../components/Sidebar/FilterSidebar";
import axios from "axios";
import ItemUser from "../../components/Home/ItemUser";

import { mapMutations } from "vuex";
import global from "~/mixins/global.js";

export default {
  mixins: [global],
  watchQuery: ['page'],
  async asyncData({ query }) {
    const { data } = await axios.get(process.env.URL_API + "/categories", {
      headers: {
        "Access-Control-Allow-Origin": "*",
        "X-Requested-With": "XMLHttpRequest"
      }
    });

    return {
      options: data.data.categories,
      tags: data.data.tags,
      queryString: {
        category: query.cates ? query.cates.split(",").map(Number) : [],
        keyword: query.keyword ? query.keyword : "",
        address: query.location ? query.location : ""
      }
    };
  },
  created() {
    this.search(this.queryString);
    this.getCateAndCount();
  },
  name: "listing",
  components: { ItemUser, FilterSidebar, Category, RecentPost, Tag },
  data() {
    return {
      collection: [],
      page: 1,
      total: 0,
      cateCount: []
    };
  },
  methods: {
    async changePage(event) {
      this.page = event;
      const query = this.$route.query;
      let queryParams = {
          category: query.cates ? query.cates.split(",").map(Number) : [],
          keyword: query.keyword ? query.keyword : "",
          address: query.location ? query.location : "",
          page: event
      }
      await this.search(queryParams, false);
      window.scroll({top: 0, left: 0, behavior: 'smooth' });
    },
    async getCateAndCount() {
      const { data } = await axios.get(
        process.env.URL_API + "/categories_count_user"
      );
      this.cateCount = data.data;
    },
    ...mapMutations({
      setLoading: "SET_LOADING_PAGE"
    })
  },
  watchQuery(newQuery, oldQuery) {
    // console.log(newQuery)
  }
};
</script>