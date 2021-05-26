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
        <van-popup v-model="dialogShow" position="bottom" closeable round class="inventory" @closed="close">
            <van-field v-model="quantity" :label="(title + '数量')" type="digit" />
            <van-button :loading="loading" type="primary" round color="#52a1e1" @click="httpRequest" class="inventory-btn">提 交</van-button>
        </van-popup>
    </section>
</template>

<script>
    import { product } from '../../api'
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
                loading: false,
                quantity: 0,
                type: 0, // 0默认，1：入库，2出库
                title: ''
            }
        },
        methods: {
            goList() {
                window.location.href = '/product'
            },
            storage() {
                this.title = '入库'
                this.type = 1
                this.dialogShow = true
            },
            out() {
                this.title = '出库'
                this.type = 2
                this.dialogShow = true
            },
            httpRequest() {
                if (this.quantity < 1) {
                    this.$notify({
                        type: 'warning',
                        message: '操作数量不能小于1',
                        duration: 2000
                    })
                    return false
                }
                this.loading = true
                product.inventoryPost({
                    type: this.type,
                    quantity: this.quantity
                }).then(res => {
                    const data = res.data
                    this.$notify({
                        type: data.type,
                        message: data.message,
                        duration: 2000
                    })
                    if (data.code === 200) {
                        this.dialogShow = false
                    }
                    this.loading = false
                }).catch(error => {
                    console.log(error)
                })
            },
            close() {
                this.dialogShow = false
                this.loading = false
                this.quantity = 0
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
    .inventory{
        padding: 30px 0;
        text-align: center;
    }
    .inventory-btn {
        margin: 0 auto;
        width: 90%;
    }
</style>
