<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class PostRequest extends AjaxFormRequest
{
    private $table           = 'posts';
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
        $condTitle  = "bail|required|between:1,255|unique:$this->table,title";
        $condSlug  = "bail|between:1,255|unique:$this->table,slug";
        $condContent  =  "bail|required";
        if (!empty($id)) { // edit
            $condTitle  .= ",$id";
            $condSlug  .= ",$id";
        }
        $rules =  [
            'title'           => $condTitle,
            'slug'           => $condSlug,
            'content'           => $condContent,
        ];
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
