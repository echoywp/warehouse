@extends('home.layouts.app')

@section('title', '选择操作')

@section('css')
    <style>
        .index{
            margin-top: 30vh;
        }
        .nav>div{
            border-radius: 50%;
            background: #e2982a;
        }
        .index, .nav span {
            color: #ececec
        }
    </style>
@endsection

@section('content')
    <van-grid class="index" :gutter="30" square :clickable="false" :border="false" :column-num="2">
        <van-grid-item class="nav" icon="expand-o" text="入库" url="/"></van-grid-item>
        <van-grid-item class="nav" icon="logistics" text="出库" url="/"></van-grid-item>
    </van-grid>
@endsection


