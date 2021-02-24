<?php 

namespace App\Services;

class NumberToExcel {
    // number - 1 to offset starting at 0 so that A -> 1 as per assignment
    public function convert(int $number)
    {
        $currentPos = ($number - 1) % 26; 
        $letter = chr(65 + $currentPos);
        $alphaMultiple = intval(($number - 1) / 26);

        if ($alphaMultiple > 0)
            return $this->convert($alphaMultiple) . $letter;
        return $letter;
    }
}