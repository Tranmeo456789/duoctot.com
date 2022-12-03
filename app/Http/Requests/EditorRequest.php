<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class EditorRequest extends AjaxFormRequest
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
        $condName  = "bail|required|between:1,255";
        $condEmail  = "bail|required";
        $condPassword = "bail|required";
        // if(!empty($id)){ // edit
        //     $condEmail  .= ",$id";
        // }
        return  [
            'fullname'        => $condName,
            'email'       => $condEmail,
            'password'    => $condPassword,
        ];
    }
    public function attributes()
    {
        $arrAttr['fullname'] = 'Họ tên';
        $arrAttr['email'] = 'Username';
        $arrAttr['password'] = 'password';
        return $arrAttr;
    }
}
