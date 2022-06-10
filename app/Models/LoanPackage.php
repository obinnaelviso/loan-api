<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LoanPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    // Mutators
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

    // Query
    public function scopeActive($query) {
        return $query->where('status_id', status_active_id());
    }
    public function scopeInactive($query) {
        return $query->where('status_id', status_inactive_id());
    }
    public function scopeOrderByScore($query) {
        return $query->orderBy('loan_score', 'asc');
    }
}
