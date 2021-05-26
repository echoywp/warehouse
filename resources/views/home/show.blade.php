@extends('layouts.app')

@section('title', '选择操作')

@section('content')
    <show :detail="{{$detail}}" :inventory="{{$inventory}}"></show>
@endsection
