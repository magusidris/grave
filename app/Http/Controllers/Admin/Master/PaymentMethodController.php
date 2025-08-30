<?php

namespace App\Http\Controllers\Admin\Master;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MasterPaymentMethod;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    /**
     * __invoke
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)
    {
        $paymentMethods = MasterPaymentMethod::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->paginate(10)->withQueryString();

        return Inertia::render('Admin/Master/PaymentMethods/Index', [
            'paymentMethods' => fn() => $paymentMethods
        ]);
    }
}
