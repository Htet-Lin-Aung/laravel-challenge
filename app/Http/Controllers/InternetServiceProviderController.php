<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;
use App\Services\InternetServiceProvider\MonthlyPaymentCalculator;
use Illuminate\Http\Response;

class InternetServiceProviderController extends Controller
{
    public function getInvoiceAmount(Request $request,$operator)
    {
        switch ($operator) {
            case 'mpt':
                $internetServiceProvider = new Mpt();
                break;
            case 'ooredoo':
                $internetServiceProvider = new Ooredoo();
                break;
            default:
                return response()->json([
                    'status' => Response::HTTP_BAD_REQUEST,
                    'error' => 'Invalid operator selected',
                ]);
        }

        $calculator = new MonthlyPaymentCalculator($internetServiceProvider);
        $amount = $calculator->calculate($request->get('month') ?: 1);

        return response()->json([
            'data' => $amount,
        ]);
    }
}
