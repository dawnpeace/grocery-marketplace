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
            'nama_produk' => 'required|string|max:255',
            'jumlah_tersedia' => 'required|integer',
            'harga' => 'required|integer',
            'satuan_unit' => 'required|string',
            'deskripsi' => 'required|string',
            'foto_produk' => 'nullable|max:512|image|mimes:jpg,jpeg,png'
        ];
    }
}
