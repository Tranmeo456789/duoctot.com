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
            'getListProvince' => 'api/v0.3/province/get-list',
        ],
        'template' => [
            'form_element' => [
                'label' => ['class'=>'col-form-label'],
                'input' => [
                    'class' => 'form-control'
                ],
                'select2' => [
                    'class' => 'form-control col-md-12 col-xs-12 select2'
                ]
            ]
,
            'label' => [
                'fullname' => 'Họ tên',
                'password' => 'Mật khẩu',
                'phone' => 'Số điện thoại'
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
        ]
    ];
?>