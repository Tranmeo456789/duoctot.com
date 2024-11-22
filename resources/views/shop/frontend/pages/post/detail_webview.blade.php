@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;

$timePost = MyFunction::formatDateLongTime($item['created_at']);
@endphp
@extends('shop.layouts.frontend_webview')
@section('content')
<div class="wp-inner mt-2"> 
    <h1 class="title-name">{{$item['title']}}</h1>
    <p>{{$timePost}}</p>
    <div class="content-post">
        {!! $item['content'] !!}
    </div>
</div>
@endsection