<?php

namespace App\Http\Requests;

use App\Rules\PhoneLengthRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    /** Define parameters for validation
     *
     * @return array
     */
    public function validationData() : array
    {
        $request['name'] = $this->input('name');
        $request['email'] = $this->input('email');
        $request['country'] = $this->input('country');
        $request['phone'] = $this->input('phone');
        $request['phone_length'] = [
          'country' => $this->input('country'),
          'phone'   => $this->input('phone')
        ];
        return $request;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|min:5|max:50',
            'email'         => 'required|string|email|max:255|unique:users',
            'country'       => 'required|string|exists:countries,id',
            'phone'         => 'required|string|unique:phone_book,phone',
            'phone_length'  =>  new PhoneLengthRule()
        ];
    }
}
