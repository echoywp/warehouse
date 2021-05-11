<style scoped>
    .index{
        margin-top: 30vh;
    }
    .nav>>>div{
        border-radius: 50%;
        background: #ff976a;
    }
    .index, .nav>>>span {
        color: #ececec;
        font-size: 16px
    }
</style>

<template>
    <section>
        <van-grid class="index" :gutter="30" square :clickable="false" :border="false" :column-num="2">
            <van-grid-item class="nav" icon="expand-o" text="入库" url="/"></van-grid-item>
            <van-grid-item class="nav" icon="logistics" text="出库" url="/"></van-grid-item>
        </van-grid>
    </section>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        mounted() {
        }
    }
</script>
