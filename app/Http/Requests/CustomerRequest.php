<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class CustomerRequest extends AjaxFormRequest
{
    private $table            = 'customers';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id;
        $condName  = "bail|required|between:1,255|unique:$this->table,name";
        $condCode_customer  = "bail|required";
        $condPhone  = "bail|required|numeric";
        $condPassword  = "bail|required";
        $condAddress_detail  = "bail|required";
        $condProvince  = "bail|required";
        $condDistrict  = "bail|required";
        $condWards  = "bail|required";
        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return  [
            'name'        => $condName,
            'code_customer'=>$condCode_customer,
            'phone'=>$condPhone,
            'address_detail'=>$condAddress_detail,
            'province'=>$condProvince,
            'district'=>$condDistrict,
            'wards'=>$condDistrict,
            'password'=>$condPassword,
        ];
    }
    public function attributes()
    {
        $arrAttr['name'] = 'Tên khách hàng';
        $arrAttr['code_customer'] = 'Mã khách hàng';
        $arrAttr['phone'] = 'Số điện thoại';
        $arrAttr['address_detail'] = 'Địa chỉ';
        $arrAttr['province'] = 'Tỉnh/thành phố';
        $arrAttr['district'] = 'Quận/huyện';
        $arrAttr['wards'] = 'Xã/phường';
        $arrAttr['password'] = 'Mật khẩu';
        return $arrAttr;
    }
}
