<template>
    <div class="blog-details-hero set-bg" :style="{ backgroundImage: 'url(\'' + bg + '\')'}">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="blog__hero__text">
                        <div class="label">Trending</div>
                        <h2>{{ user.last_name }}</h2>
                        <ul>
                            <li><i class="fa fa-clock-o"></i> {{ user.birth_date || "19th March, 2019" }}</li>
                            <li><i class="fa fa-user"></i> {{ user.first_name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import bg from '../assets/img/blog/details/blog-hero.jpg';

    export default {
        props: {
            user: Object,
        },
        name: "HeaderDetail",
        data() {
            return {
                bg,
            }
        }
    }
</script>

<style scoped>

</style>
