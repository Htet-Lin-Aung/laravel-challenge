<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\InternetServiceProvider\Ooredoo;

class OoredooTest extends TestCase
{
    /**
     * Test Ooredoo monthly payment calculation
     *
     * @return void
     */
    public function testOoredooMonthlyPaymentCalculation()
    {
        $ooredoo = new Ooredoo();
        $ooredoo->setMonth(2); // calculate monthly payment for 2 months
        $this->assertEquals(300, $ooredoo->calculateTotalAmount());
    }
}
