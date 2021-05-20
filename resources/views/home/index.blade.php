@extends('layouts.app')

@section('title', '选择操作')

@section('css')
    <style>
        .product-box{
            align-items: normal;
        }
        .product-box .info{
            padding: 10px;
            clear: left;
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <section>
            <van-grid :border="false" :column-num="2" :gutter="10">
                @foreach($list as $item)
                    <van-grid-item class="product-box">
                        <van-image class="product-cover" fit="cover" src="https://img01.yzcdn.cn/vant/apple-1.jpg"></van-image>
                        <div class="info">
                            <h3>{{$item->name}}</h3>
                            <span>{{$item->desc}}  数量：{{$item->getInventory()->sum('available_inventory')}}</span>
                        </div>
                    </van-grid-item>
                @endforeach
            </van-grid>
    </section>
@endsection

