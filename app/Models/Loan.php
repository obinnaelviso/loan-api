<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Loan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_at' => 'datetime',
        'due_at' => 'datetime',
    ];

    // Accessors & Mutators
    protected function balance(): Attribute {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100,
        );
    }
    public function getAmountStringAttribute() {
        return config('app.currency').$this->amount;
    }

    public function getPercentageStringAttribute() {
        return $this->percentage.'%';
    }

    public function getDurationStringAttribute() {
        return $this->duration.' '.Str::plural('day', $this->duration);
    }

    public function getInterestAttribute() {
        return $this->amount * ($this->percentage / 100);
    }

    public function getInterestStringAttribute() {
        return config('app.currency').$this->interest;
    }

    public function getTotalAmountDueAttribute() {
        return $this->amount + $this->interest;
    }

    public function getTotalAmountDueStringAttribute() {
        return config('app.currency').$this->total_amount_due;
    }

    // Relationships
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function status() {
        return $this->belongsTo(Status::class);
    }
    public function bankAccount() {
        return $this->belongsTo(BankAccount::class);
    }
}
