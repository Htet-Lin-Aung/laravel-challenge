<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\InternetServiceProvider\Mpt;


class MptTest extends TestCase
{
    /**
     * Test Mpt monthly payment calculation
     *
     * @return void
     */
    public function testMptMonthlyPaymentCalculation()
    {
        $mpt = new Mpt();
        $mpt->setMonth(3); // calculate monthly payment for 3 months
        $this->assertEquals(600, $mpt->calculateTotalAmount());
    }
}
