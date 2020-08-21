<template>
    <div class="listing__details__rating">
        <h4>Rate</h4>
        <div class="listing__details__rating__overall">
            <h2>4.7</h2>
            <div class="listing__details__rating__star">
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
                <span class="icon_star"></span>
            </div>
            <span>(120 Rating)</span>
        </div>
        <div class="listing__details__rating__bar">
            <div class="listing__details__rating__bar__item">
                <span>4.4</span>
                <div id="bar1" class="barfiller">
                    <span class="fill" data-percentage="100"></span>
                </div>
                <span class="right">Quality</span>
            </div>
            <div class="listing__details__rating__bar__item">
                <span>3.9</span>
                <div id="bar2" class="barfiller">
                    <span class="fill" data-percentage="75"></span>
                </div>
                <span class="right">Price</span>
            </div>
            <div class="listing__details__rating__bar__item">
                <span>4.2</span>
                <div id="bar3" class="barfiller">
                    <span class="fill" data-percentage="80"></span>
                </div>
                <span class="right">Space</span>
            </div>
            <div class="listing__details__rating__bar__item">
                <span>4.8</span>
                <div id="bar4" class="barfiller">
                    <span class="fill" data-percentage="80"></span>
                </div>
                <span class="right">Service</span>
            </div>
            <div class="listing__details__rating__bar__item">
                <span>4.0</span>
                <div id="bar5" class="barfiller">
                    <span class="fill" data-percentage="85"></span>
                </div>
                <span class="right">Location</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Rating"
    }
</script>

<style scoped>

</style>
