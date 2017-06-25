<template>
    <div class="content center">
        <div class="title">首页</div>
        <router-link to="demo" class="links" append>Demo首页</router-link>
        <demo></demo>
    </div>
</template>

<script lang="babel">
    import Demo from '/components/Demo.vue'

    export default{
        components: {
            Demo
        },
        data(){
            return {

            }
        },
        mounted(){
        },
        methods: {

        },
    }
</script>

<style lang="scss">
    @import "~/assets/scss/abstracts";

    .content{
        background: #f5f5f5;
        @include margin_auto(50%);

        .links{
            color: blue;
        }
    }
</style>
