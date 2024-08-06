<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCustomerRequest extends FormRequest
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
          'name'                  => 'required|max:25',
          'alamat'                => 'required',
          'no_telp'               => 'required',
        ];
    }

    public function messages()
    {
      return [
        'name.required'                 => 'Nama tidak boleh kosong.',
        'name.max'                      => 'Nama tidak boleh lebih dari 50 karakter.',
        // 'email.required'                => 'Email tidak boleh kosong.',
        'email.max'                     => 'Email tidak boleh lebih dari 50 karakter.',
        'alamat.required'               => 'Alamat tidak boleh kosong.',
        'alamat.max'                    => 'Alamat tidak boleh lebih dari 50 karakter.',
        'no_telp.required'              => 'Nomor Telepon tidak boleh kosong.'
      ];
    }
}
