<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kategori' => ['required', Rule::exists('kategori', 'id')],
            'nama' => 'required|string',
            'deskripsi' => 'sometimes',
            'sku' => 'sometimes',
            'harga' => 'required|regex:/^[0-9,.]+$/',
            'berat' => 'required|regex:/^[0-9,.]+$/',
            'ukuran' => 'sometimes|array',
        ];
    }
}
