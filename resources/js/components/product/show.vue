<template>
    <section>
        <van-cell-group class="product-detail">
            <van-cell title="产品名称" :value="detail.name" />
            <van-cell title="产品描述" :value="detail.desc" />
            <van-cell title="规格(CM)" :value="detail.length + ' * ' + detail.width + ' * ' + detail.height" />
            <van-cell title="分类" :value="detail.category_trans" />
            <van-cell title="重量(G)" :value="detail.weight" />
            <van-cell title="单位" :value="detail.unit_trans" />
            <van-cell title="仓库信息" :value="inventory.warehouse ? inventory.warehouse.name : ''" />
        </van-cell-group>
        <van-image src="https://img01.yzcdn.cn/vant/cat.jpeg"/>
        <van-goods-action>
            <van-goods-action-icon icon="apps-o" text="列表" @click="goList"></van-goods-action-icon>
            <van-goods-action-button color="#ff976a" type="warning" @click="out" text="出库"></van-goods-action-button>
            <van-goods-action-button color="#52a1e1" type="danger" @click="storage" text="入库"></van-goods-action-button>
        </van-goods-action>
        <van-dialog v-model="dialogShow" :title="title" show-cancel-button>
            <van-field v-model="quantity" :label="(title + '数量')" />
        </van-dialog>
    </section>
</template>

<script>
    import { storagePost } from '../../api'
    import { Dialog } from 'vant';

    export default {
        name: 'show',
        components: {
            [Dialog.Component.name]: Dialog.Component
        },
        props: {
            detail: Object,
            inventory: Object
        },
        data() {
            return {
                dialogShow: false,
                quantity: 0,
                title: ''
            }
        },
        methods: {
            goList() {
                window.location.href = '/product'
            },
            storage() {
                this.title = '入库'
                this.dialogShow = true
            },
            out() {
                this.title = '出库'
                this.dialogShow = true
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
