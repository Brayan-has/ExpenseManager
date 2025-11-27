<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException;
class UserRequest extends FormRequest
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

        $method = $this->method();

        switch($method) {
            case 'POST':
                return [
                    'name' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string',
                ];
            case 'PUT':
                return [
                    'name' => 'sometimes',
                    'lastname' => 'sometimes',
                    'email' => 'sometimes',
                    'password' => 'sometimes',
                ];
            default:
                return [];
        }
        
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'  => 422,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422)
        );
    }
}
