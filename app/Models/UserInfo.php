<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checkedByUser() {
        return $this->belongsTo(User::class, 'checked_by');
    }
    public function getSubmittedAtAttribute() {
        return $this->created_at->format('d M Y, h:i A');
    }
    public function status() {
        return $this->belongsTo(Status::class);
    }
}
