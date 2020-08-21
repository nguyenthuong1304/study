<template>
    <div class="listing__item">
        <div class="listing__item__pic set-bg" :style="{ backgroundImage: 'url(\'' + user.information.avatar + '\')'}">
            <img src="../../assets/img/listing/list_icon-6.png" alt="">
            <div class="listing__item__pic__tag">Popular</div>
            <div class="listing__item__pic__btns">
                <nuxt-link :to="`/detail/${user.id}`">
                    <span class="icon_zoom-in_alt"></span>
                </nuxt-link>
                <a href="#" @click.prevent="addFavorite(user.id)">
                    <span :class="isFavorites(user.id)"></span>
                </a>
            </div>
        </div>
        <div class="listing__item__text">
            <div class="listing__item__text__inside">
                <h5>{{ user.first_name }}</h5>
                <div class="listing__item__text__rating">
                    <div class="listing__item__rating__star">
                        <span class="icon_star"></span>
                        <span class="icon_star"></span>
                        <span class="icon_star"></span>
                        <span class="icon_star"></span>
                        <span class="icon_star-half_alt"></span>
                    </div>
                    <h6>
                        <template v-if="user.information.hidden_price === 0">{{ user.information.price }}$ /h</template>
                        <template v-else>Thương lượng</template>
                    </h6>
                </div>
                <ul>
                    <li>
                        <span class="icon_pin_alt"></span>
                        {{ user.information.address }}
                    </li>
                    <li>
                        <span class="icon_phone"></span>
                        {{ user.phone }}
                    </li>
                </ul>
            </div>
            <div class="listing__item__text__info">
                <div class="listing__item__text__info__left">
                    <img :src="user.information.avatar" alt="">
                    <span>Hotel</span>
                </div>
                <div class="listing__item__text__info__right">{{ $t('book_now') }}</div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters } from 'vuex';
    export default {
        props: {
            user: Object
        },
        name: 'ItemUser',
        methods: {
            addFavorite(userId){
                this.$parent.addFavorite(userId)
            },
            isFavorites(userId) {
                return (this.loggedInUser() && this.loggedInUser().favoritersIds.includes(userId))
                    ? "icon_heart text-red"
                    : "icon_heart_alt"
            },
            ...mapGetters(['loggedInUser'])
        }
    }
</script>
<style>
    .text-red {
        color: crimson;
    }
</style>