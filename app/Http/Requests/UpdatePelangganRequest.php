<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelangganRequest extends FormRequest
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
            'nama' => 'required|string',
            'nomor_telepon' => 'required|regex:/^[0-9]+$/|min:6',
            'nama_prov' => 'required|string',
            'nama_kab' => 'required|string',
            'nama_kec' => 'required|string',
            'kode_pos' => 'required|regex:/^[0-9]+$/|size:5',
            'alamat' => 'required|string',
            'lainnya' => 'sometimes',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ];
    }
}
