<?php

namespace App\Http\Requests;

use App\Rules\ArrayDimensionValidator;
use Illuminate\Foundation\Http\FormRequest;

class MatrixMultiplyRequest extends FormRequest
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
            'matrix1' => ['required', 'array', new ArrayDimensionValidator()],
            'matrix1.*' => ['required', 'array'],
            'matrix1.*.*' => ['required', 'integer'],
            'matrix2' => ['required', 'array', new ArrayDimensionValidator()],
            'matrix2.*' => ['required', 'array', 'size:' . count($this->matrix1)],
            'matrix2.*.*' => ['required', 'integer'],
        ];
    }
}
