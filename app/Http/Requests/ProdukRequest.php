<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
            'nama_produk' => 'required|string|max:191',
            'deskripsi' => 'required|string|max:600',
            'harga' => 'required|integer|min:0',
            'satuan_unit' => 'required|string|max:8',
            'jumlah_tersedia' => 'required|integer|min:0',
            'foto_produk' => 'required|max:512|image|mimes:jpg,jpeg,png'
        ];
    }
}
