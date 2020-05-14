<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookEntryRequest extends FormRequest
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
            'isbn' => 'required|max:25|unique:books,isbn',
            'call_number' => 'required|numeric',
            'title' => 'required|max:60',
            'author' => 'required|max:50',
            'publisher' => 'required|max:160',
            'description' => 'required|max:255',
            'category_id' => 'required|numeric',
            'date_published' => 'required|date_format:Y-m-d',
            'series' => 'required|max:30',
            'total_copies' => 'required|numeric',
            'price' => 'required|numeric'
        ];
    }
}
