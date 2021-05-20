@extends('layouts.app')

@section('title', '选择操作')

@section('content')
    <list :list="{{$list}}"></list>
@endsection
