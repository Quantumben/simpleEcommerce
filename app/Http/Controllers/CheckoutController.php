<?php

namespace App\Http\Controllers;
use Cart;
use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {

        if( Cart::content()->count() == 0)
        {

            Session::flash('info', 'Your cart is still empty. do some shopping');
            return redirect()->back();
        }
        return view('checkout');
    }

    public function pay()
    {

        Stripe::setApiKey("sk_test_62bQpTPhmiXDjY5bAiL5Mam8");

        $charge = Charge::create([
            'amount' => (float)Cart::total() * 100,
            'currency' => 'usd',
            'description' => 'udemy course practice selling books',
            'source' => request()->stripeToken
        ]);

        Session::flash('success', 'Purchase successfull. wait for our email.');

        Cart::destroy();

        Mail::to(request()->stripeEmail)->send(new \App\Mail\PurchaseSuccessful);

        return redirect('/');
    }
}
