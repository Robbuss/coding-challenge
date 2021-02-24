<?php 

namespace App\Services;

// cheatsheet: 
// https://www.mathsisfun.com/algebra/matrix-multiplying.html

class MatrixMultiplier {
    public function multiply(array $matrix1, array $matrix2) :array {

        $result = [];
        
        // loop throught first matrix rows 
        for($row = 0; $row < count($matrix1); $row++) {

            $result[$row] = []; 
            
            // loop through second matrix columns 
            for($col = 0; $col < count($matrix2[$row]); $col++){

                $result[$row][$col] = 0;
                // sum multiplication for each row - col combination
                for($r = 0; $r < count($matrix1[$row]); $r++){
                    $result[$row][$col] += $matrix2[$r][$col] * $matrix1[$row][$r]; 
                }
            }
        }

        return $result;
    }
}