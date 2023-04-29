<?php

namespace App\Services\InternetServiceProvider;

use App\Services\InternetServiceProvider\Interfaces\InternetServiceProvider;

class MonthlyPaymentCalculator
{
    private $internetServiceProvider;

    public function __construct(InternetServiceProvider $internetServiceProvider)
    {
        $this->internetServiceProvider = $internetServiceProvider;
    }

    public function calculate(int $month): float
    {
        $this->internetServiceProvider->setMonth($month);
        return $this->internetServiceProvider->calculateTotalAmount();
    }
}