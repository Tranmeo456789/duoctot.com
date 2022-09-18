<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;

class RegisterRequest extends AjaxFormRequest
{
   // private $table            = 'user';
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
        $condName  = "bail|required|between:1,255";
        $condEmail = '';
        if (str_contains($this->email,'@')){
            $condEmail  = "bail|required|email|unique:mysql_share_data.user,email";
        }else{
            $condEmail = "bail|required|numeric|phone|unique:mysql_share_data.user,phone";
        }

        $condPassword  = "bail|required|between:6,255";
        $condProvince = "bail|required|exists:mysql_share_data.province,id";
        return  [
            'fullname'    => $condName,
            'email'       => $condEmail,
            'password'    => $condPassword,
            'province_id' => $condProvince
        ];
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Họ tên';
        $arrAttr['email'] = (str_contains($this->email,'@'))?'Email':'Số điện thoại';
        $arrAttr['province_id'] = 'Địa chỉ';
        return $arrAttr;
    }
}
