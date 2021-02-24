<?php

namespace Tests\Unit;

use App\Services\NumberToExcel;
use PHPUnit\Framework\TestCase;

class NumberToExcelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testConversionTest()
    {
        $numberToExcel = new NumberToExcel();
        
        // Examples: 1 => A, 26 => Z, 27 => AA, 28 => AB.
        $this->assertEquals($numberToExcel->convert(1), "A");
        $this->assertEquals($numberToExcel->convert(26), "Z");
        $this->assertEquals($numberToExcel->convert(27), "AA");
        $this->assertEquals($numberToExcel->convert(28), "AB");
    }
}
