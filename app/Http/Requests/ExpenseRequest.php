<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException; 
class ExpenseRequest extends FormRequest
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

        switch ($method) {
            case 'POST':
                return [
                    "name" => "required|string|max:255",
                    "description" => "nullable|string",
                    "value" => "required|numeric|min:0",
                    "date" => "sometimes",
                    "status" => "required|in:pending,paid,overdue",
                    "daily" => "boolean",
                    "by_week" => "boolean",
                    "by_month" => "boolean",
                    "annual" => "boolean",
                    "user_id" => "required|exists:users,id",
                    "wallet_id" => "required|exists:wallets,id",
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    "name" => "sometimes|required|string|max:255",
                    "description" => "sometimes|nullable|string",
                    "value" => "sometimes|required|numeric|min:0",
                    "date" => "sometimes|required|date",
                    "status" => "sometimes|required|in:pending,paid,overdue",
                    "daily" => "sometimes|boolean",
                    "by_week" => "sometimes|boolean",
                    "by_month" => "sometimes|boolean",
                    "annual" => "sometimes|boolean",
                    "user_id" => "sometimes|required|exists:users,id",
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
