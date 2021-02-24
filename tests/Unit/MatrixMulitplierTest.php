<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\MatrixMultiplier;

class MatrixMultiplierTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $calculator = new MatrixMultiplier();

        $m1 = [[1, 2, 3],[4, 5, 6]];
        $m2 = [[7, 8],[9, 10],[11, 12]];

        $result = [[58, 64], [139, 154]];

        $this->assertEquals($calculator->multiply($m1, $m2), $result);
    }
}
