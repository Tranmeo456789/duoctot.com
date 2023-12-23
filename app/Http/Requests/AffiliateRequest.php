<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class AffiliateRequest extends AjaxFormRequest
{
    private $table            = 'affiliate';
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
        $condNameRef  = "bail|required";
       
        return  [
           
        ];
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        return $arrAttr;
    }
}
