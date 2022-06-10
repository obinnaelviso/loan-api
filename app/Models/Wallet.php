<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Mutators
    public function getBalanceStringAttribute() {
        return config('app.currency').$this->balance;
    }
}
