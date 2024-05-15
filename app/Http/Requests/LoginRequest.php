<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $login_type = filter_var($this->input('email'), FILTER_VALIDATE_EMAIL )
            ? 'email'
            : 'username';
        $this->merge([
            $login_type => $this->input('email')
        ]);

        if (! Auth::attempt($this->only($login_type, 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'auth.failed',
            ]);
        }
    }
}
