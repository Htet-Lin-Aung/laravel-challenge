<?php

namespace App\Services\InternetServiceProvider;

use App\Services\InternetServiceProvider\Interfaces\InternetServiceProvider;


class Ooredoo implements InternetServiceProvider
{
    protected $month = 0;
    protected $monthlyFees = 150;

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): float
    {
        return $this->month * $this->monthlyFees;
    }
}
