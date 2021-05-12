@extends('layouts.app')

@section('title', '选择操作')

@section('css')
    <style>
        .index{
            margin-top: 30px;
        }
        .nav>div{
            margin: 0 auto;
            max-width: 300px;
            max-height: 300px;
            border-radius: 50%;
            background: #52a1e1;
        }
        .index, .nav span {
            color: #ececec;
            font-size: 16px
        }
    </style>
@endsection

@section('content')
    <section>
        <van-card num="2" desc="描述信息" title="商品标题" thumb="https://img01.yzcdn.cn/vant/ipad.jpeg">
            <template #footer>
                <van-button icon="expand-o" color="#52a1e1" size="mini">入库</van-button>
                <van-button icon="logistics" color="#52a1e1" size="mini">出库</van-button>
            </template>
        </van-card>
    </section>
@endsection

