<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\NumberToExcel;
use App\Services\MatrixMultiplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\MatrixMultiplyRequest;

class MatrixController extends Controller
{
    public function index(NumberToExcel $converter)
    {
        return $converter->convert(250);
    }
    
    public function multiply(MatrixMultiplyRequest $request, MatrixMultiplier $calculator, NumberToExcel $numberToExcel)
    {
        $requestData = $request->validated();

        $numberMatrix = $calculator->multiply($requestData['matrix1'], $requestData['matrix2']);

        return collect($numberMatrix)->map(function ($m) use ($numberToExcel) {
            return collect($m)->map(function ($l) use ($numberToExcel) {
                return $numberToExcel->convert($l);
            });
        });
    }
}
