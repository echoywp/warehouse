@extends('layouts.app')

@section('title', '选择操作')

@section('content')
    <van-empty image="error" description="错误！不可以连续操作！"></van-empty>
    <countdown></countdown>
@endsection
