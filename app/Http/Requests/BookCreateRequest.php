<?php

namespace App\Http\Requests;

class BookCreateRequest extends BaseRequest
{
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
        return [
            'name' => 'required|string',
            'pages' => 'required|integer',
            'annotation' => 'required|string',
            'image' => 'required|string',
            'author_id' => 'required|exists:authors,id'
        ];
    }
}
