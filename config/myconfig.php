<?php
    return [
        'token_check_login' => 'UAqaYzPVrCW56UgKumKdSN7t',
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
            'checkLoginStatus' => 'api/v0.3/checkLoginStatus',
        ],
        'template' => [
            'star' => "<span class='text-red ml-2'>*</span>",
            'form_element' => [
                'label' => ['class'=>'col-form-label'],
                'input' => [
                    'class' => 'form-control'
                ],
                'editor' => [
                    'class' => 'form-control editor'
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
                'parent_id' => 'Danh mục cha',
                'cat_product_id' => 'Danh mục thuốc',
                'producer_id' => 'Nhà sản xuất',
                'trademark_id' =>'Thương hiệu',
                'dosage_forms' => 'Dạng bào chế',
                'specification' => 'Quy cách',
                'country_id' => 'Nước sản xuất',
                'long' => 'Chiều dài (mm)',
                'wide' => 'Chiều rộng (mm)',
                'high' => 'Chiều cao (mm)',
                'mass' => 'Khối lượng (g)',
                'coefficient' => 'Hệ số VAT (%)',
                'price' => 'Giá bán thuốc (chưa VAT)',
                'price_vat' => 'Giá bán thuốc (có VAT)',
                'type_vat' => 'Loại VAT',
                'packing' => 'Quy cách đóng gói',
                'unit_id' => 'Đơn vị',
                'amout_max' => 'Số lượng đặt hàng lớn nhất',
                'inventory_min' => 'Số lượng tồn tối thiếu',
                'type_price' => 'Loại giá bán hàng',
                'general_info' =>'Thông tin chung',
                'benefit' => 'Công dụng',
                'prescribe' => 'Chỉ định',
                'dosage' => 'Liều lượng',
                'note' => 'Lưu ý',
                'preserve' => 'Bảo quản'
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
            'type_product' => [
                '1' => 'Sản phẩm loại thường',
                '2' => 'Quà tặng'
            ],
            'tick'=>[
                '1' => 'Hàng dễ vỡ',
                '2' => 'Hàng bảo quản lạnh'
            ],
            'yes_no' => [
                'yes' => 'Có',
                'no' => 'Không'
            ],
            'type_price' => [
                '1' => 'Giá bán hàng niêm yết',
                '2' => 'Giá theo doanh thu'
            ],
            'type_featurer' => [
                'noi_bat' => 'Sản phẩm nổi bật',
                'hau_covid' => 'Sản phẩm hậu covid',
                'tre_em' => 'Trẻ em',
                'nguoi_cao_tuoi' => 'Người cao tuổi',
                'phu_nu_cho_con_bu' => 'Phụ nữ cho con bú'
            ],
            'char_level' => "|---",
            'column' => [
                'typeProduct'      => [
                    'all'           => ['name' => 'Tất cả', 'class' => 'item-tab'],
                    'dang_ban'      => ['name' => 'Đang bán', 'class'      => 'item-tab'],
                    'ngung_ban'   => ['name' => 'Ngừng bán', 'class' => 'item-tab'],
                    'tam_het_hang' => ['name' => 'Tạm hết hàng', 'class' => 'item-tab'],
                    'gan_het_hang' => ['name' => 'Gần hết hàng', 'class' => 'item-tab'],
                    'cho_kiem_duyet' => ['name' => 'Chờ kiểm duyệt', 'class' => 'item-tab'],
                    'tu_choi' => ['name' => 'Từ chối', 'class' => 'item-tab'],
                ],
            ],
        ],
        'folderUpload' => [
            'mainFolder' =>'fileUpload'
        ]
    ];
?>