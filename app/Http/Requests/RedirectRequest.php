<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class RedirectRequest extends AjaxFormRequest
{
    private $table            = 'redirects';
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
        $condOldSlug  = "bail|required|between:1,255|unique:$this->table,old_slug";

        if(!empty($id)){ // edit
            $condOldSlug  .= ",$id";
        }
        return  [
            'old_slug'        => $condOldSlug
        ];
    }
    public function attributes()
    {
        $arrAttr['old_slug'] = 'Slug cũ';
        return $arrAttr;
    }
}
