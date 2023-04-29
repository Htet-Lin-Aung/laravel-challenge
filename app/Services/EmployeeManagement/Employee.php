<?php

namespace App\Services\EmployeeManagement;

interface Employee
{
    public function applyJob(): bool;

    public function salary(): float;
}
