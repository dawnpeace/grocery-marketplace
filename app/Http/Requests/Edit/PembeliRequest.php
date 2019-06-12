<?php

namespace App\Http\Requests\Edit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Pembeli;
use Illuminate\Validation\Rule;
use App\Rules\IndonesianPhoneNumber;

class PembeliRequest extends FormRequest
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
        $pembeliUser = Pembeli::findOrFail($request->id)->user;
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users','email')->ignore($pembeliUser->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'username' => ['required', 'regex:/^[a-zA-Z0-9._]*$/', 'between:5,24', Rule::unique('users','username')->ignore($pembeliUser->id)],
            'kota' => ['required','string', 'max:191'],
            'alamat' => ['required','string', 'max:191'],
            'no_telp' => ['required','string',new IndonesianPhoneNumber],
            'foto_profil' => ['nullable','file','mimes:jpg,jpeg,png','max:1024']
        ];
    }
}
