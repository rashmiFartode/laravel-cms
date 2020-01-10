<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostsRequest extends FormRequest
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
            'title' => 'bail|required|string| max:100',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'sometimes|required|mimes:jpeg,jpg,png,gif|max:10000',
            'published_at' => 'nullable|string',
            'category_id' => 'required'
            //laravel-validation-bail-rule=> In this example, if the unique rule on the title attribute fails, the max rule will not be checked. Rules will be validated in the order they are assigned.
        ];
    }
}
