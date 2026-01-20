<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class CustomerFeedBackRequest extends AjaxFormRequest
{
    private $table           = 'customer_feedback';
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
        if (!empty($id)) { // edit
        }
        $rules =  [];
        return array_merge($rules);
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['title'] = 'Tiêu đề';
        $arrAttr['content'] = 'Nội dung';
        return $arrAttr;
    }
}
