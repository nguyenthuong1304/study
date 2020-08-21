<template>
  <div class="filter nice-scroll">
    <div class="filter__title">
      <h5>
        <i class="fa fa-filter"></i> Filter
      </h5>
    </div>
    <div class="filter__search">
      <input type="text" v-model="keyword" placeholder="Tên" />
    </div>
    <div class="filter__select">
      <el-select
        v-model="category"
        multiple
        filterable
        allow-create
        default-first-option
        :placeholder="$t('chooseCate')"
      >
        <el-option v-for="item in options" :key="item.name" :label="item.name" :value="item.id"></el-option>
      </el-select>
    </div>
    <div class="filter__location">
      <input type="text" placeholder="Location" v-model="address" />
      <i class="fa fa-map-marker"></i>
    </div>
    <div class="filter__radius">
      <p>Radius:</p>
      <div class="price-range-wrap">
        <div
          class="price-range-radius ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
        >
          <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
          <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
        </div>
        <div class="range-slider">
          <div class="price-input">
            <input type="text" id="radius" />
          </div>
        </div>
      </div>
    </div>
    <div class="filter__price">
      <p>Price:</p>
      <div class="price-range-wrap">
        <div
          class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
        >
          <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
          <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
        </div>
        <div class="range-slider">
          <div class="price-input">
            <input type="text" id="minamount" />
            <input type="text" id="maxamount" value="$80" />
          </div>
        </div>
      </div>
    </div>
    <div class="filter__tags">
      <h6>Tag</h6>
      <label for="coupon">
        Coupons
        <input type="checkbox" id="coupon" />
        <span class="checkmark"></span>
      </label>
      <label for="sa">
        Smoking Allowed
        <input type="checkbox" id="sa" />
        <span class="checkmark"></span>
      </label>
      <label for="camping">
        Camping
        <input type="checkbox" id="camping" />
        <span class="checkmark"></span>
      </label>
      <label for="hot-spots">
        Hot Spots
        <input type="checkbox" id="hot-spots" />
        <span class="checkmark"></span>
      </label>
      <label for="internet">
        Internet
        <input type="checkbox" id="internet" />
        <span class="checkmark"></span>
      </label>
      <label for="tr">
        Top Rated
        <input type="checkbox" id="tr" />
        <span class="checkmark"></span>
      </label>
      <label for="hd">
        Hot Deal
        <input type="checkbox" id="hd" />
        <span class="checkmark"></span>
      </label>
    </div>
    <div class="filter__btns">
      <button type="submit" @click.prevent="search">Filter Results</button>
      <button type="submit" class="filter__reset">Reset All</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    options: Array,
    queryString: Object
  },
  name: "FilterSidebar",
  data() {
    return {
      ...this.queryString,
    };
  },
  methods: {
    search() {
      this.$parent.search(this.$data);
    }
  }
};
</script>

<style scoped>
</style>
