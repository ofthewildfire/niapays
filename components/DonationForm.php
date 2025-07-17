<?php namespace NiaInteractive\NiaPays\Components;
use Url;


use Cms\Classes\ComponentBase;
use NiaInteractive\NiaPays\Models\Donation;

class DonationForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Donation Form',
            'description' => 'Displays a donation form and processes Stripe payments using Elements.'
        ];
    }


public function onRender()
{
    $settings = \NiaInteractive\NiaPays\Models\Settings::instance();
    $redirect = $settings->stripe_success_redirect ?: '/thank-you'; // Define $redirect here
    $this->page['success_redirect'] = Url::to($redirect);
    $this->page['stripe_publishable_key'] = $settings->stripe_publishable_key;
}

    // Step 1: Create PaymentIntent for Stripe Elements
    public function onCreatePaymentIntent()
    {
        $data = post();
        $amount = $data['amount'] ?? null;

        if (!$amount || !is_numeric($amount) || $amount <= 0) {
            return ['error' => 'Please select or enter a valid donation amount.'];
        }

        try {
            $settings = \NiaInteractive\NiaPays\Models\Settings::instance();
            \Stripe\Stripe::setApiKey($settings->stripe_secret_key);

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount * 100, // cents
                'currency' => 'usd',
                'metadata' => [
                    'name' => $data['name'] ?? '',
                    'email' => $data['email'] ?? '',
                ],
                'description' => 'Donation',
            ]);

            return [
                'clientSecret' => $paymentIntent->client_secret
            ];
        } catch (\Exception $e) {
            \Log::error('Payment Intent creation failed: ' . $e->getMessage());
            return ['error' => 'Payment processing failed. Please try again.'];
        }
    }

    // Step 2: Save donation after successful payment
    public function onDonate()
    {
        $data = post();
        $amount = $data['amount'] ?? null;
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;

        if (!$amount || !is_numeric($amount) || $amount <= 0) {
            return ['error' => 'Invalid donation amount.'];
        }

        $donation = new Donation();
        $donation->name = $name;
        $donation->email = $email;
        $donation->amount = $amount;
        $donation->save();

        return ['success' => true];
    }
}