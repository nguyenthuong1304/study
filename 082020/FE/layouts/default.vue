<template>
    <div>
        <div id="preloder" v-if="isLoading">
            <div class="loader"></div>
        </div>
        <Header></header>
        <nuxt />
        <Footer></Footer>
    </div>
</template>
<script>
    import Header from "../layouts/Header";
    import Footer from "../layouts/Footer";

    import { mapState } from 'vuex';
    export default {
        components: { Footer, Header },
        computed: {
            ...mapState({
                isLoading: 'isLoadingPage',
            })
        }
    }
</script>
<style lang="scss">
    @import "assets/sass/style.scss";
</style>
