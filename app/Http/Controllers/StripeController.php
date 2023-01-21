<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function stripe_payment () {
        $validator = Validator::make(request()->all(), [
            'card_number' => 'required',
            'expiry_date' => 'required',
            'cvc' => 'required',
            'amount' => 'required',
            'invoice_id' => 'required',
        ]);

        if ($validator->fails()) {
            flash()->addWarning('Please fill in all the fields');
            return redirect()->back()->withErrors($validator);
        } else {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            try {
                $token = $stripe->tokens->create([
                    'card' => [
                        'number' => request()->card_number,
                        'exp_month' => explode('/', request()->expiry_date)[0],
                        'exp_year' => explode('/', request()->expiry_date)[1],
                        'cvc' => request()->cvc,
                    ] 
                ]);
            } catch (\Exception $e) {
                flash()->addWarning('Invalid card details');
                return redirect()->back();
            }

            $charge = $stripe->charges->create([
                'amount' => intval(request()->amount * 100 ),
                'currency' => 'usd',
                'source' => $token->id,
                'description' => 'Payment for invoice #'.request()->invoice_id,
            ]);

            Payment::create([
                'invoice_id' => request()->invoice_id,
                'amount' => request()->amount,
                'transaction_id' => $charge->id
            ]);

            flash()->addSuccess('Payment successful');
            return redirect()->back();
        }
    }

    public function cash_payment () {
        $validator = Validator::make(request()->all(), [
            'amount' => 'required',
            'invoice_id' => 'required',
        ]);

        if ($validator->fails()) {
            flash()->addWarning('Please fill in all the fields');
            return redirect()->back()->withErrors($validator);
        } else {
            Payment::create([
                'invoice_id' => request()->invoice_id,
                'amount' => request()->amount,
                'transaction_id' => '123456789'
            ]);

            flash()->addSuccess('Payment successful');
            return redirect()->back();
        }
    }
}
