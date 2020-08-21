<template>
    <div class="blog__sidebar__categories">
        <h5>{{ $t('category') }}</h5>
        <ul>
            <li v-for="(item, index) in cateCount" :key="index">
                <a href="#">{{ item.name }} <span>{{ item.users_count }} </span></a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            cateCount: Array
        },
        name: "Category",
    }
</script>

<style scoped>

</style>
