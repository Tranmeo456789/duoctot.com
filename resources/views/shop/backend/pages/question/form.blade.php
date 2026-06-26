@php
    use App\Helpers\Form as FormTemplate;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12 p-0';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $elements = [
        [
        'type'    => 'input-hidden',
        'element' => 'product_id',
        'value'   => $productId,
    ],
        [
            'label'   =>  HTML::decode(Form::label('ques', $label['ques'] .  $star, $formLabelAttr)),
            'element' => Form::textarea('ques', $item['ques']?? null, array_merge($formInputAttr,['placeholder'=>$label['ques'],"rows"=>"5"]))
        ],
        [
            'label'   =>  HTML::decode(Form::label('ans', $label['ans'] .  $star, $formLabelAttr)),
            'element' => Form::textarea('ans', $item['ans']?? null, array_merge($formEditorAttr,['placeholder'=>$label['ans'],"rows"=>"5"]))
        ],
        [
            'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
    $title = (!isset($item['id']) || $item['id'] == '')  ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
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