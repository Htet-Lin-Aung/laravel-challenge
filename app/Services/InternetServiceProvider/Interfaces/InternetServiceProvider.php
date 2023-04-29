<?php

namespace App\Services\InternetServiceProvider\Interfaces;

interface InternetServiceProvider
{
    public function setMonth(int $month);
    public function calculateTotalAmount(): float;
}