<template>
  <div>
    <SectionSearch :categories="categories"></SectionSearch>
    <MostCate></MostCate>
    <section class="most-search spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>{{ $t('collections') }}</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="most__search__tab">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" v-for="(cate, index) in categories">
                  <a
                    class="nav-link"
                    :class="{active: index === 0}"
                    data-toggle="tab"
                    :href="`#tabs-${index}`"
                    role="tab"
                    @click.prevent="changeCate(cate.id)"
                  >
                    <span class="flaticon-039-fork"></span>
                    {{ cate.name }}
                  </a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane active" id="tabs-1" role="tabpanel">
                <div class="row">
                  <div class="col-lg-4 col-md-6" v-for="(user, index) in collections">
                    <ItemUser :user="user" :key="index"></ItemUser>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center">
              <el-pagination
                background
                @current-change="changePage"
                layout="prev, pager, next"
                :total="total"
              ></el-pagination>
            </div>
          </div>
        </div>
      </div>
    </section>
    <Section2></Section2>
  </div>
</template>

<script>
import axios from "axios";
import SectionSearch from "../layouts/SectionSearch";
import MostCate from "../layouts/MostCate";
import Section2 from "../layouts/Section2";
import ItemUser from "../components/Home/ItemUser";

import { mapMutations } from "vuex";
import global from "~/mixins/global.js";

export default {
  head() {
    return {
      title: this.$t("titleIndex")
    };
  },
  components: {
    ItemUser,
    Section2,
    MostCate,
    SectionSearch
  },
  data() {
    return {
      categories: [],
      collections: [],
      page: 1,
      total: 0,
      categoryId: 1
    };
  },
  async created() {
    await this.getCategories();
    await this.getCollection();
    this.setLoading(false);
  },
  methods: {
    async getCategories() {
      const { data } = await axios.get(process.env.URL_API + "/categories", {
        headers: {
          "Access-Control-Allow-Origin": "*",
          "X-Requested-With": "XMLHttpRequest"
        }
      });
      this.categories = data.data.categories;
    },
    async getCollection() {
      const { data } = await axios.get(
        process.env.URL_API +
          `/home?category_id=${this.categoryId}&page=${this.page}`,
        {
          headers: {
            "Access-Control-Allow-Origin": "*",
            "X-Requested-With": "XMLHttpRequest"
          }
        }
      );
      this.collections = data.data.data;
      this.total = data.data.total;
    },
    changeCate(cate) {
      this.categoryId = cate;
      this.page = 1;
      this.getCollection();
    },
    changePage(event) {
      this.page = event;
      this.getCollection();
    },
    ...mapMutations({
      setLoading: "SET_LOADING_PAGE"
    })
  }
};
</script>
