<template>
    <div>
        <Header></header>
        <nuxt />
        <Footer></Footer>
    </div>
</template>
<script>
    import Header from "../layouts/Header";
    import Footer from "../layouts/Footer";
    import HeaderDetail from "./HeaderDetail";

    export default {
        components: { HeaderDetail, Header, Footer },
    }
</script>
<style lang="scss">
    @import "assets/sass/style.scss";
</style>
