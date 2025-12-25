<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Payment;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', [
            'order' => $order,
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {
        $order->loadMissing('items');
        $amount = $order->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $stripe = new StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => (int) round($amount * 100),
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
        ]);
        $payment = new Payment();
        $payment->forceFill([
            'order_id' => $order->id,
            'amount' => $paymentIntent->amount,
            'currency' => $paymentIntent->currency,
            'method' => $paymentIntent->payment_method_types[0] ?? 'stripe',
            'status' => 'pending',
            'transaction_id' => $paymentIntent->id,
            'transaction_data' => json_encode($paymentIntent),
        ])->save();

        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }

    public function confirm(Request $request, Order $order)
    {
        $stripe = new StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),[]);

        if ($paymentIntent->status == 'succeeded') {
            // update payment
            $payment = Payment::where('order_id', $order->id)->first();
            $payment->forceFill([
                'status' => 'completed',
                'transaction_data' => json_encode($paymentIntent),
            ])->save();

            $order->forceFill([
                'payment_status' => 'paid',
                'payment_method' => $paymentIntent->payment_method_types[0] ?? 'stripe',
            ])->save();

            event('payment.created', $payment->id);

            return redirect()->route('home', [
                'status' => 'payment-succeeded',
            ]);
        }
        return redirect()->route('orders.payments.create', [
            'order' => $order->id,
            'status' => $paymentIntent->status,
        ]);
    }
}
