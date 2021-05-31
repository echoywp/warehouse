<template>
    <van-grid :border="false" :column-num="2" :gutter="10">
        <van-grid-item v-for="(item, index) in list" :key="index" class="product-box" @click="click(item)">
            <van-image class="product-cover" fit="cover" :src="item.good_pic"></van-image>
            <div class="info">
                <h1>{{item.name}}</h1>
                <span>{{item.desc}}  数量：{{item.available_inventory}}</span>
            </div>
        </van-grid-item>
    </van-grid>
</template>

<script>
    export default {
        name: 'list',
        props: {
            list: Array
        },
        methods: {
            click(product) {
                window.location.href = '/product/' + product.id
            }
        }
    }
</script>

<style scoped>
    .product-box>>>.van-grid-item__content {
        align-items: normal;
        border-radius: 5px;
    }
    .product-box .info{
        padding: 10px 10px 0 10px;
        clear: left;
        text-align: left;
    }
    .product-box .info h1 {
        font-size: 16px;
    }
    .product-box .info span {
        font-size: 12px;
    }
</style>
