@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12 p-0';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $formSelect2Attr  = config('myconfig.template.form_element.select2');

    $elements = [
        [
            'label'   => HTML::decode(Form::label('name', 'Tên Nhà sản xuất' .  $star, $formLabelAttr)),
            'element' => Form::text('name', $item['name']??null, array_merge($formInputAttr,['placeholder'=>'Tên Nhà sản xuất'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('parent_id', $label['parent_id'] , $formLabelAttr)),
            'element' => Form::select('parent_id',$itemsParent, $item['parent_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => Form::label('image','Hình ảnh', ['class' => 'col-xs-3 col-form-label']),
            'element' => Template::createFileManager('image', $item['image']?? null),
            'widthInput' => 'col-9'
        ],[
            'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
    $title = (!isset($item['id']) || $item['id'] == '')  ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            {!! FormTemplate::show($elements,$formInputWidth)  !!}

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection