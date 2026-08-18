<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class CommentRequest extends AjaxFormRequest
{
    private $table            = 'comment';
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
        return [];
    }
    public function attributes()
    {
        $arrAttr['content'] = 'Nội dung';
        return $arrAttr;
    }
}
