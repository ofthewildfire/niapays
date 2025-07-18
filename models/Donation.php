<?php namespace NiaInteractive\NiaPays\Models;

use Model;

class Donation extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'niainteractive_niapays_donations';

    protected $fillable = [
        'name',
        'email',
        'amount',
        'stripe_payment_intent_id',
        'status'
    ];

    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'amount' => 'required|numeric|min:1',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function getStatusOptions()
    {
        return [
            'pending' => 'Pending',
            'completed' => 'Completed',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
        ];
    }
}