<?php

namespace App\Actions\Hitpay;

class PaymentCheckoutAction
{
    public function execute($validatedData)
    {
        try {
            $result = (new Hitpay)->paymentRequest(array('amount' => $validatedData['amount'], 'currency' => 'SGD', 'email' => $validatedData['email'], 'name' => $validatedData['name'],
                'redirect_url' => route('hitpay.payment.success', $validatedData['reference_number']), 'reference_number'=> $validatedData['reference_number']));

            $checkout = json_decode($result);
            return $checkout;
        } catch(\Exception $e){
                throw new \Error($e);
        }



    }

}
