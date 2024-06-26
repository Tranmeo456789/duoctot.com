@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));

    $formInputAttr    = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $inputFileDel     = isset($item['id'])?Form::hidden('file-del'):'';
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $elements = [
        [
            'label'   => HTML::decode(Form::label('title', 'Tiêu đề bài viết' .  $star, $formLabelAttr)),
            'element' => Form::text('title', $item['title']??null, array_merge($formInputAttr,['placeholder'=>'Tiêu đề bài viết'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('cat_post_id', 'Danh mục' .  $star , $formLabelAttr)),
            'element' => Form::select('cat_post_id',$itemsCatPost, $item['cat_post_id']??null, array_merge($formSelect2Attr,['style' =>'width:100%'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => Form::label('','Ảnh đại diện', ['class' => 'col-12 col-form-label']),
            'element' => Form::label('','Chọn ảnh', ['class' => 'btn btn-primary label-select-image']),
            'widthInput' => '',
        ],
        [
            'label'   => '',
            'element' => Template::showImageAndInputSingle('image', $item['image']?? null),
            'widthInput' => 'col-12',
        ],
        [
            'label'   =>  HTML::decode(Form::label('description', $label['description'] .  $star, $formLabelAttr)),
            'element' => Form::textarea('description', $item['description']?? null, array_merge($formInputAttr,['placeholder'=>$label['description'],"rows"=>"5"]))
        ]
        ,[
            'label'   => HTML::decode(Form::label('content', 'Nội dung bài viết' .  $star, $formLabelAttr)),
            'element' => Form::textarea('content', $item['content']?? null, array_merge($formEditorAttr,['placeholder'=>'Nội dung bài viết','id'=>'content']))
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
            <div class="col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'enctype'        => 'multipart/form-data',
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        @include ("$moduleName.pages.product.child_form.modal_img")
    </div>
</section>
@endsection