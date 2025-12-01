<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException;

class SavingRequest extends FormRequest
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

        switch($method){
            case 'POST':
                return [
                    'project_name' => 'required',
                    'saving_value' => 'required|numeric',
                    'status' => 'required',
                    'user_id' => 'required|exists:users,id',
                ];
            case 'PUT':
                return [
                    'project_name' => 'sometimes',
                    'saving_value' => 'sometimes|numeric',
                    'status' => 'sometimes',
                    'user_id' => 'sometimes|exists:users,id',
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
