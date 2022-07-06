<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdVerification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getHiddenIdNumber() {
        return substr($this->attributes['id_number'], 0, 4) . '****' . substr($this->attributes['id_number'], -4);
    }
}
