@php
    use App\Helpers\Form as FormTemplate;
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputWidth['widthInput'] = 'col-12';
@endphp
<div class="row">
    <div class="col-10">
        @if (count($items) > 0)
            @php
                $address = isset($params['filter']['district_id'])?$items[0]->district->name . ', ':'';
                $address .= $items[0]->province->name;
                $xhtml = "";
                $i = 1;
                foreach ($items as $val){
                    $elements = [
                        'label' => Form::label('', $val['address'],''),
                        'element' => Form::radio('pharmacy[warehouse_id]',$val['id'],($i==1)),
                        'type' =>'inline-text-right',
                        'widthElement' => 'col-10 p-0',
                        'styleFormGroup' => 'mb-0'
                    ];
                    $xhtml .= '<div class="local_drugstore d-flex justify-content-between flex-wrap">';
                    $xhtml .=     FormTemplate::formGroup($elements,$formInputWidth);
                    $xhtml .= '     <div class="col-2 p-0 text-right"><a href="">Xem bản đồ</a></div>';
                    $xhtml .= '    <div class="col-12 p-0"><span class="text-success">Có hàng</span></div>';
                    $xhtml .= '</div>';
                    $i++;
                }
            @endphp
            <p class="font-weight-bold mt-2">Có {{count($items)}} nhà thuốc tại <span class="">{{$address}}</span></p>
            {!! $xhtml !!}
        @endif
    </div>
</div>