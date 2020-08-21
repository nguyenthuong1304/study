<template>
  <div>
    <HeaderDetail :user="user"></HeaderDetail>
    <section class="blog-details spad">
      <div class="container" v-if="!isEmpty(user)">
        <div class="row">
          <div class="col-lg-8">
            <div class="blog__details__text">
              <div class="blog__details__video set-bg">
                <img :src="user.information.avatar" alt />
              </div>
              <p>{{ user.information.bio }}</p>
              <h5>Cattle She’d Days Lights Light Saw Spirit Shall</h5>
              <p>
                Free promotions such as search engines and directories would give your web site the deserved
                traffic you always wanted. Make sure to check your web site’s ranking to know whether or not
                this type of free promotion is right for you. – Make a deal with other web sites on trading
                links which could help both web sites. Make sure to use words that could easily interest the
                audience.
              </p>
              <img src="img/blog/details/blog-item.jpg" alt />
              <p>
                Analyze your techniques, keep track of your customers and learn what works. Then be ready to
                try new methods and repeat those methods that are already working. It has been said that the
                best things in life are free and this saying also applies to the many forms of free
                advertising that are available on the internet. Give this form of advertising a try and you
                also may become a true believer in the power of free internet advertising.
              </p>
            </div>
            <div class="blog__details__tags">
              <span>Tags</span>
              <a href="#" v-for="(tag, index) in user.tags" :key="index">{{ tag.title }}</a>
            </div>
            <div class="blog__details__share" v-if="socials = user.information.socials">
              <a
                :href="socials.fb"
                class="blog__details__share__item"
                target="_blank"
                v-if="socials.fb"
              >
                <i class="fa fa-facebook"></i>
                <span>Facebook</span>
              </a>
              <a
                :href="socials.tw"
                class="blog__details__share__item twitter"
                target="_blank"
                v-if="socials.tw"
              >
                <i class="fa fa-twitter"></i>
                <span>Twitter</span>
              </a>
              <a
                :href="socials.ig"
                class="blog__details__share__item instagram"
                target="_blank"
                v-if="socials.ig"
              >
                <i class="fa fa-instagram"></i>
                <span>Instagram</span>
              </a>
              <a
                :href="socials.tik"
                class="blog__details__share__item tiktok"
                target="_blank"
                v-if="socials.tik"
              >
                <i class="fa fa-tiktok"></i>
                <span>Tiktok</span>
              </a>
            </div>
            <div class="blog__details__new__post">
              <div class="blog__details__new__post__title">
                <h4>News Post</h4>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/bp-5.jpg"></div>
                    <div class="blog__item__text">
                      <ul class="blog__item__tags">
                        <li>
                          <i class="fa fa-tags"></i> Videos
                        </li>
                      </ul>
                      <h5>
                        <a href="#">Citrus Heights Snack Man Helps Feed The Homeless</a>
                      </h5>
                      <ul class="blog__item__widget">
                        <li>
                          <i class="fa fa-clock-o"></i> 19th March, 2019
                        </li>
                        <li>
                          <i class="fa fa-user"></i> John Smith
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="img/blog/bp-6.jpg"></div>
                    <div class="blog__item__text">
                      <ul class="blog__item__tags">
                        <li>
                          <i class="fa fa-tags"></i> Travel
                        </li>
                      </ul>
                      <h5>
                        <a href="#">Homeless woman’s viral subway opera performance</a>
                      </h5>
                      <ul class="blog__item__widget">
                        <li>
                          <i class="fa fa-clock-o"></i> 19th March, 2019
                        </li>
                        <li>
                          <i class="fa fa-user"></i> John Smith
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="blog__sidebar">
              <div class="blog__sidebar__search">
                <form action="#">
                  <input type="text" placeholder="Searching..." />
                  <button type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </form>
              </div>
              <RecentPost></RecentPost>
              <Category></Category>
              <Tag :tags="user.tags"></Tag>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import HeaderDetail from "../../../layouts/HeaderDetail";
import RecentPost from "../../../components/Sidebar/RecentPost";
import Category from "../../../components/Sidebar/Category";
import Tag from "../../../components/Sidebar/Tag";

import axios from "axios";
import { mapMutations, mapState } from "vuex";
import global from "~/mixins/global.js";

export default {
  mixins: [global],
  async asyncData({ params, error }) {
    try {
      let { data } = await axios.get(
        process.env.URL_API + `/users/${params.id}`
      );
      return { user: data.data };
    } catch (e) {
      error({ statusCode: 404, message: "Not found" });
    }
  },
  validate({ params }) {
    return /^\d+$/.test(params.id);
  },
  data() {
    return {};
  },
  layout: "PageLayout",
  name: "Detail",
  components: { Category, RecentPost, HeaderDetail, Tag },
  methods: {
    ...mapMutations({
      serUser: "user/SET_USER"
    })
  }
};
</script>

<style>
.instagram {
  background: #f09433;
  background: -moz-linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  background: -webkit-linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  background: linear-gradient(
    45deg,
    #f09433 0%,
    #e6683c 25%,
    #dc2743 50%,
    #cc2366 75%,
    #bc1888 100%
  );
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
}

.tiktok {
    background: #304163;
}
</style>