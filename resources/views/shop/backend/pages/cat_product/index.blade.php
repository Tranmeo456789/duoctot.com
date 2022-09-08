@php
    $title = '';
    $title = $title . $pageTitle;
@endphp
@extends('shop.layouts.backend')

@section('title', 'Danh sách ' . $title)

@section('header_title', $title)

@section('body_content')
<div class="card">
    @include("$moduleName.blocks.notify")
    @include("$moduleName.blocks.title",['pageTitle' => 'Danh sách '.$title,
                                         'pageIndex' => true])
    <div class="set-withscreen">
        <div class="card-body list-productwp">
            @include("$moduleName.pages.$controllerName.list")
            {{$items->links()}}
        </div>
    </div>
</div>
@endsection