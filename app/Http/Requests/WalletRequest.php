<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use Illuminate\Http\Exceptions\HttpResponseException;

class WalletRequest extends FormRequest
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
     * @return array<string, \Illumiñnate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         $methods = $this->getActionMethod();

        switch ($methods) {
            case 'store':
                return [
                    "name" => "required",
                    "origin" => "required",
                    "quantity" => "required",
                    "project_id" => "required|exists:projects,id"
                    ];
            case "update":
                return [
                    "name" => "sometimes",
                    "origin" => "sometimes",
                    "quantity" => "sometimes",
                    "project_id" => "sometimes|exists:projects,id"
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
