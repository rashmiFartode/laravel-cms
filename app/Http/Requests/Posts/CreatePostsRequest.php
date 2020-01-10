<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostsRequest extends FormRequest
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
            'title' => 'required|string| max:100 | unique:posts',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'sometimes|required|mimes:jpeg,jpg,png,gif|max:10000',
            'published_at' => 'nullable|string',
            'category_id' => 'required'
        ];
    }
}
