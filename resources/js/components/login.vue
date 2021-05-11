<style scoped>
    .title{
        padding: 14px;
        margin-top: 10px;
        text-align: center;
        color: #ff976a;
    }
    .login-form {
        text-align: center;
        background: #424242;
    }
    .login-form::after{
        border: none;
    }
    .input-top{
        padding: 18px;
        margin: 20px auto;
        width: 93%;
        border-radius: 10px;
        border-bottom: none;
    }
    .login-btn {
        margin: 0 auto;
        width: 93%;
    }
</style>

<template>
    <section>
        <van-row type="flex" justify="center">
            <van-col span="24" class="title">
                <h1>员工登录</h1>
            </van-col>
        </van-row>
        <van-cell-group class="login-form">
            <van-field v-model="username" class="input-top" required label="用户名" placeholder="请输入用户名"></van-field>
            <van-field v-model="phone" class="input-top" required label="手机号" placeholder="请输入手机号"></van-field>
            <van-button class="login-btn" round type="warning">登录</van-button>
        </van-cell-group>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                username: '',
                phone: ''
            }
        },
        mounted() {
        }
    }
</script>
