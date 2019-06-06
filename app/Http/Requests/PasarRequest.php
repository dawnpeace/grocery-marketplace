<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasarRequest extends FormRequest
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
            'nama_pasar' => 'required|string|max:191',
            'alamat' => 'required|string|max:191',
            'foto_pasar' => 'required|max:512|image|mimes:jpg,jpeg,png'
        ];
    }
}
