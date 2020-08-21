<template>
    <div>
        <HeaderDetail :user="user"></HeaderDetail>
        <section class="listing-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="listing__details__text">
                            <div class="listing__details__about">
                                <h4>Overview</h4>
                                <p>Entries from over 70 countries cover every imaginable space; From ships to airports,
                                    museums to burger vans, from revered Michelin-starred establishments to the fleeting
                                    dynamism of pop-ups.</p>
                                <p>The judges are the most influential global personalities from hospitality, design and
                                    lifestyle media and have previously included the Editor in Chief of Wallpaper*, Marcus
                                    Wareing and Thomas Heatherwick.
                                    The Awards are followed by over 40,000 of the most influential architects, designers,
                                    hospitality professionals and lifestyle media from around the globe.</p>
                            </div>
                            <div class="listing__details__gallery">
                                <h4>Gallery</h4>
                                <div class="listing__details__gallery__pic">
                                    <div class="listing__details__gallery__item">
                                        <img class="listing__details__gallery__item__large"
                                             src="img/listing/details/listing-details-1.jpg" alt="">
                                        <span><i class="fa fa-camera"></i> 170 Image</span>
                                    </div>
                                    <div class="listing__details__gallery__slider owl-carousel">
                                        <img data-imgbigurl="img/listing/details/listing-details-1.jpg"
                                             src="img/listing/details/thumb-1.jpg" alt="">
                                        <img data-imgbigurl="img/listing/details/listing-details-1.jpg"
                                             src="img/listing/details/thumb-2.jpg" alt="">
                                        <img data-imgbigurl="img/listing/details/listing-details-1.jpg"
                                             src="img/listing/details/thumb-3.jpg" alt="">
                                        <img data-imgbigurl="img/listing/details/listing-details-1.jpg"
                                             src="img/listing/details/thumb-4.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <Rating></Rating>
                            <Comment></Comment>
                            <FormReview></FormReview>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="listing__sidebar">
                            <div class="listing__sidebar__contact">
                                <div class="listing__sidebar__contact__map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24168.833995532765!2d-74.79633710628465!3d40.78172222265886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c384de7a5300b9%3A0x8afc61979217d49d!2sLong%20Valley%2C%20NJ%2007853%2C%20USA!5e0!3m2!1sen!2sbd!4v1586852528126!5m2!1sen!2sbd"
                                        height="200" style="border:0;" allowfullscreen="" aria-hidden="false"
                                        tabindex="0"></iframe>
                                    <img src="img/listing/details/map-icon.png" alt="">
                                </div>
                            </div>
                            <Contact></Contact>
                            <div class="listing__sidebar__working__hours">
                                <h4>Working Hours</h4>
                                <ul>
                                    <li>Monday <span>09:00 AM - 20:00 PM</span></li>
                                    <li>Tuesday <span>09:00 AM - 20:00 PM</span></li>
                                    <li>Wednesday <span>09:00 AM - 20:00 PM</span></li>
                                    <li>Thursday <span>09:00 AM - 20:00 PM</span></li>
                                    <li>Friday <span class="opening">Opening</span></li>
                                    <li>Saturday <span>09:00 AM - 20:00 PM</span></li>
                                    <li>Saturday <span class="closed">Closed</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import HeaderDirecting from "../../../../layouts/HeaderDirecting";
    import Contact from "../../../../components/Sidebar/Contact";
    import Rating from "../../../../components/Rating";
    import Comment from "../../../../components/Comment";
    import FormReview from "../../../../components/FormReview";

    import { mapMutations } from 'vuex';
    import HeaderDetail from "@/layouts/HeaderDetail";

    export default {
        layout: 'PageLayout',
        name: "Directing",
        components: {HeaderDetail, FormReview, Comment, Rating, Contact, HeaderDirecting },
        data() {
            return {
                user: {}
            }
        },
        created() {
            this.serUser({name: 'abd'});
        },
        methods: {
            ...mapMutations({
                serUser: 'user/SET_USER'
            }),
        }
    }
</script>

