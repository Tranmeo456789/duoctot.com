<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class CatalogRequest extends AjaxFormRequest
{
    private $table            = 'catalog';
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
        $condName  = "bail|required|between:1,500|unique:$this->table,name";

        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return  [
            'name'        => $condName,
        ];
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên danh mục bài viết';
        return $arrAttr;
    }
}
