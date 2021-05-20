@extends('layouts.app')

@section('title', '选择操作')

@section('css')
    <style>
        .product-box .van-grid-item__content {
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
@endsection

@section('content')
    <section>
        <van-goods-action>
            <van-goods-action-button color="#be99ff" type="warning" text="加入购物车" ></van-goods-action-button>
            <van-goods-action-button color="#7232dd" type="danger" text="立即购买" ></van-goods-action-button>
        </van-goods-action>
    </section>
@endsection

