<?php

namespace Tests\Feature;

use Tests\TestCase;

class MatrixControllerText extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $m1 = [
            [1, 2, 3],
            [4, 5, 6]
        ];

        $m2 = [
            [7, 8],
            [9, 10],
            [11, 12]
        ];

        $response = $this->post('/api/matrix/multiply', ['matrix1' => $m1,'matrix2' => $m2])
        ->assertJson([
                ['BF', 'BL'], 
                ['EI', 'EX']
        ])
        ->assertStatus(200);
    }
}
