@php
    use App\Helpers\MyFunction;
    use App\Helpers\Form as FormTemplate;
    $date             = isset($item['date'])?MyFunction::formatDateFrontend($item['date']):'';
    $formDateMaskAttr = config('myconfig.template.form_element.input_datemask');
    $formInputWidth['widthInput']  =  'col-12';
    $elementsFilterDay =[
            [
            'label'   => '',
            'element' => Form::text('day_start', $date, array_merge($formDateMaskAttr,['placeholder'=>'Từ ngày'])),
            'widthElement' => 'col-6 col-lg-4'
            ],
            [
            'label'   => '',
            'element' => Form::text('day_end', $date, array_merge($formDateMaskAttr,['placeholder'=>'Đến ngày'])),
            'widthElement' => 'col-6 col-lg-4'
            ],
        ];
@endphp

<div class="card card-outline card-primary mb800-0">
    <div class="card-body my-card-filter">
        <div class="row">
            {!! FormTemplate::show($elementsFilterDay,$formInputWidth) !!}
            <div class="text-center col-6 col-lg-3"><button class="btn btn-primary" id="btn-filter-day">Lọc kết quả</button></div>
            <div class="col-6 col-lg-1"><button id="btn-clear-search" type="button" class="btn btn-danger" style="margin-right: 0px"><i class="fa fa-times" aria-hidden="true"></i></button></div>
        </div>
    </div>
</div>