@extends('home.layouts.app')

@section('title', '选择操作')

@section('css')
    <style>
        .input-top{
            margin-bottom: 20px;
        }
    </style>
@endsection
@section('content')
    <van-cell-group>
        <van-field v-model="username" class="input-top" required label="用户名" placeholder="请输入用户名"></van-field>
        <van-field v-model="phone" required label="手机号" placeholder="请输入手机号"></van-field>
    </van-cell-group>
@endsection
@section('js')
    <script type="text/javascript">
        Vue.$data = {
            username: '',
            phone: ''
        }
    </script>
@endsection


