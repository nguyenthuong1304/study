<template>
    <section class="listing-hero set-bg" :style="{ backgroundImage: 'url(\'' + bg + '\')'}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="listing__hero__option">
                        <div class="listing__hero__icon">
                            <img src="../assets/img/listing/details/ld-icon.png" alt="">
                        </div>
                        <div class="listing__hero__text">
                            <h2>Cosiana Sour Restaurant</h2>
                            <div class="listing__hero__widget">
                                <div class="listing__hero__widget__rating">
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star-half_alt"></span>
                                </div>
                                <div>120 Review</div>
                            </div>
                            <p><span class="icon_pin_alt"></span> 1012 Vesper Dr. Columbus, Georgia, United States</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="listing__hero__btns">
                        <a href="#" class="primary-btn share-btn"><i class="fa fa-mail-reply"></i> Share</a>
                        <a href="#" class="primary-btn"><i class="fa fa-bookmark"></i> Bookmark</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import bg from '../assets/img/listing/details/listing-hero.jpg';
    export default {
        name: "HeaderDirecting",
        data() {
            return {
                bg,
            }
        }
    }
</script>

<style scoped>

</style>
