<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function __construct() {

    }

    // Accessors
    public function getBalanceStringAttribute() {
        return config('app.currency').$this->balance;
    }
    public function getLoanBalanceStringAttribute() {

        return config('app.currency').$this->loan_balance;
    }
    // Mutators
    protected function balance(): Attribute {
        return Attribute::make(
            get: fn($value) => ($value == 0) ? 0 : $value * 0.01,
            set: fn($value) => ($value == 0) ? 0 :$value * 100,
        );
    }
    protected function loanBalance(): Attribute {
        return Attribute::make(
            get: fn($value) =>($value == 0) ? 0 : $value * 0.01,
            set: fn($value) =>($value == 0) ? 0 : $value * 100,
        );
    }
}
