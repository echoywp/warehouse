<template>
    <section>
        <van-cell-group class="product-detail">
            <van-cell title="产品名称" value="内容" />
            <van-cell title="产品描述" value="描述信描述信描述信描述信3描述信1息" />
            <van-cell title="规格" value="1213" />
            <van-cell title="分类" value="1213" />
            <van-cell title="重量" value="1213" />
            <van-cell title="仓库" value="1213" />
            <van-cell title="单位" value="1213" />
        </van-cell-group>
        <van-image src="https://img01.yzcdn.cn/vant/cat.jpeg"/>
        <van-goods-action>
            <van-goods-action-icon icon="apps-o" text="列表" @click="goList"></van-goods-action-icon>
            <van-goods-action-button color="#ff976a" type="warning" text="出库"></van-goods-action-button>
            <van-goods-action-button color="#52a1e1" type="danger" text="入库"></van-goods-action-button>
        </van-goods-action>
    </section>
</template>

<script>
    export default {
        name: 'show',
        methods: {
            goList() {
                window.location.href = '/product'
            }
        }
    }
</script>

<style scoped>
    .product-detail{
        background: #424242;
    }
    .product-detail:after{
        border: none;
    }
    .product-detail>div{
        margin: 0 auto;
        border-bottom: 1px #424242 dashed;
        border-collapse: collapse;
    }
    .product-detail>div:last-child{
        border-bottom: none;
    }
</style>
