@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@php
    use Illuminate\Support\Str;
    $slugName = Str::slug($item['fullname']);   
@endphp
<section class="content">
    <div class="container-fluid">
        <h5 class="my-3">Link shop:<a href="{{ route('fe.product.drugstore', ['slug' => $slugName,'shopId'=> $item['user_id']]) }}" target="_blank">{{ route('fe.product.drugstore', ['slug' => $slugName,'shopId'=> $item['user_id']]) }}</a></h5>
        <div class="card card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Cập nhật thông tin'])
            <div class="card-body">
                @if ($item->user_type_id > 3)
                @include("$moduleName.pages.$controllerName.child_form.info_drugstore")
                @else
                @include("$moduleName.pages.$controllerName.child_form.info_default")
                @endif
            </div>
        </div>
        @include ("$moduleName.pages.product.child_form.modal_img")
    </div>
</section>
@endsection