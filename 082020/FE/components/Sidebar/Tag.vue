<template>
    <div class="blog__sidebar__tags">
        <h5>#Hashtag</h5>
        <a href="#" v-for="(tag, index) in tags" :key="index">{{ tag.title }}</a>
    </div>
</template>

<script>
    export default {
        props: {
            tags: Array
        },
        name: "Tag"
    }
</script>

<style scoped>

</style>
