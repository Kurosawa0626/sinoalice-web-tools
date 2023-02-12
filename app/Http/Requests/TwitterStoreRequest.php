<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TwitterStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'username' => 'required|string',
            'text' => 'required|string',
            'tweeted_at' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json($response, 422)
        );
    }
}
