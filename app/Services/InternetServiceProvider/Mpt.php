<?php

namespace App\Services\InternetServiceProvider;

use App\Services\InternetServiceProvider\Interfaces\InternetServiceProvider;

class Mpt implements InternetServiceProvider
{
    protected $month = 0;
    protected $monthlyFees = 200;

    public function setMonth(int $month)
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): float
    {
        return $this->month * $this->monthlyFees;
    }
}