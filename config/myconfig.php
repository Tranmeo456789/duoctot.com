<?php
    return [
        'url' => [
            'api' => 'http://tdoctor.xyz/',
            'prod' => 'shop.tdoctor.vn',
            'dev' => 'shop.tdoctor.xyz',
            'prefix_admin' => 'admincp',
            'prefix_frontEnd'  => '',
        ],
        'baseRequest' => [
            'login' => 'api/v0.4/login',
            'register' => 'api/v0.4/register',
            'getListProvince' => '/api/v0.3/province/get-list',
        ],
        'template' => [
            'star' => "<span class='text-red ml-2'>*</span>",
            'form_element' => [
                'label' => ['class'=>'col-form-label'],
                'input' => [
                    'class' => 'form-control'
                ],
                'select2' => [
                    'class' => 'form-control col-md-12 col-xs-12 select2'
                ],
                'get_child' =>[
                    'class' => 'get_child'
                ]
            ],
            'label' => [
                'fullname' => 'Họ tên',
                'password' => 'Mật khẩu',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'member_id' => 'Mã thành viên',
                'province_id' => 'Tỉnh, thành phố',
                'district_id' => 'Quận, Huyện',
                'ward_id' => 'Xã, phường, thị trấn',
                'sell_area' => 'Khu vực bán hàng',
                'tax_code' => 'Mã số thuế',
                'person_represent' =>'Người đại diện pháp luật',
                'address' => 'Địa chỉ',
                'parent_id' => 'Danh mục cha'
            ],
            'type_user' => [
                '1' => 'Bệnh nhân',
                '2' => 'Bác sĩ',
                '3' => 'Phòng khám',
                '4' => 'Nhà thuốc',
                '5' => 'Bệnh viện',
                '6' => 'Trung tâm y tế',
                '7' => 'Nha khoa',
                '8' => 'Thẩm mỹ viện',
                '9' => 'Công ty dược phẩm'
            ],
            'char_level' => "|---",
        ]
    ];
?>