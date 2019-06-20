<?php

namespace App\Http\Requests\Edit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserLevel;

class ProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->jenis == UserLevel::PENJUAL;
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
        ];
    }
}
