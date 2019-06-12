<?php

namespace App\Http\Requests\Edit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Penjual;
use App\Rules\IndonesianPhoneNumber;

class PenjualRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $penjualUser = Penjual::findOrFail($request->id)->user;
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore($penjualUser->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'username' => ['required', 'regex:/^[a-zA-Z0-9._]*$/', 'between:5,24', Rule::unique('users','username')->ignore($penjualUser->id)],
            'kota' => ['required','string', 'max:191'],
            'nama_toko' => ['required','string'],
            'alamat' => ['required','string', 'max:191'],
            'no_telp' => ['required','string', new IndonesianPhoneNumber],
            'foto_profil' => ['nullable','file','mimes:jpg,jpeg,png','max:1024']
        ];
    }
}
