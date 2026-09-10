<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class PrescriptionRequest extends AjaxFormRequest
{
    private $table            = 'prescriptions';
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
        $condFullName = "bail|required";

        if(!empty($id)){ // edit
            $condFullName  .= ",$id";
        }
        return  [
            'fullname'        => $condFullName
        ];
    }
    public function attributes()
    {
        $arrAttr['fullname'] = 'Họ tên';
        return $arrAttr;
    }
}
