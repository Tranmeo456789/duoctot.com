<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;

class LoginRequest extends AjaxFormRequest
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
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['email'] = (str_contains($this->email,'@'))?'Email':'Số điện thoại';
        return $arrAttr;
    }
}
