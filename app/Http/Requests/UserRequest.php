<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;

class UserRequest extends AjaxFormRequest
{
    private $table            = 'user';
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
        $task = $this->task;

        switch ($task) {
            case 'register':
                $condName  = "bail|required|between:1,255";
                $condEmail = '';
                if (str_contains($this->email,'@')){
                    //$condEmail  = "bail|required|email|unique:mysql_share_data.user,email";
                    $condEmail  = "bail|required|email|unique:user,email";
                }else{
                    //$condEmail = "bail|required|numeric|phone|unique:mysql_share_data.user,phone";
                    $condEmail = "bail|required|numeric|phone|unique:user,phone";
                }
                $condPassword  = "bail|required|between:6,255";
                //$condProvince = "bail|required|exists:mysql_share_data.province,id";
                $condProvince = "bail|required|exists:province,id";
                return  [
                    'fullname'    => $condName,
                    'email'       => $condEmail,
                    'password'    => $condPassword,
                    'province_id' => $condProvince
                ];
                break;
            case 'login':
                $condEmail = '';
                if (str_contains($this->email,'@')){
                    $condEmail  = "bail|required|email";
                }else{
                    $condEmail = "bail|required|numeric|phone";
                }
                $condPassword  = "bail|required|between:6,255";
                return  [
                    'email'       => $condEmail,
                    'password'    => $condPassword
                ];
                break;
            case 'change-password':
                $condPasswordOld = 'bail|required|between:6,100|old_password:' . \Session::get('user')['password'];
                $condPassword = 'bail|required|between:6,100';
                $condPasswordComfirmation ='bail|required|between:6,100|same:password';
                return  [
                    'password_old' => $condPasswordOld,
                    'password'    => $condPassword,
                    'password_confirmation' => $condPasswordComfirmation
                ];
                break;
            default:
                return  [];
                break;
        }

    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Họ tên';
        $arrAttr['email'] = (str_contains($this->email,'@'))?'Email':'Số điện thoại';
        $arrAttr['province_id'] = 'Địa chỉ';
        $arrAttr['password_old'] = 'Mật khẩu cũ';
        $arrAttr['password_confirmation'] = 'Mật khẩu mới (nhập lại)';
        return $arrAttr;
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // $user = \App\Model\UserModel::where('user_id',Session::get('user')['user_id'])->first();
            // if ($this->has('password_old') && !Hash::check($this->password_old, $user->password)) {
            //     $validator->errors()->add('password_old', 'Mật khẩu cũ không đúng');
            // }else if ($this->has('password_old') && Hash::check($this->password,$user->password)){
            //     $validator->errors()->add('password', 'Mật khẩu mới phải khác mật khẩu cũ');
            // }
        });
    }
}
