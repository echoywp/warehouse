<style scoped>
    .login-form {
        margin-top: 20vh;
        background: #2f2f2f;
    }
    .login-form::after{
        border: none;
    }
    .input-top{
        padding: 18px;
        margin-bottom: 20px;
        border-radius: 10px;
        border-bottom: none;
    }
</style>

<template>
    <van-cell-group class="login-form">
        <van-field v-model="username" class="input-top" required label="用户名" placeholder="请输入用户名"></van-field>
        <van-field v-model="phone" class="input-top" required label="手机号" placeholder="请输入手机号"></van-field>
    </van-cell-group>
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
            console.log('Component mounted.')
        }
    }
</script>
