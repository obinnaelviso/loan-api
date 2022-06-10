<?php

namespace App\Repositories;

use App\Models\Otp;
use App\Models\User;

class OtpRepository {
    protected $otp;

    public function __construct(Otp $otp) {
        $this->otp = $otp;
    }

    public function create(array $data) {
        return $this->otp->create($data);
    }

    public function get(string $entity, string $type) {
        return $this->otp->where('entity', $entity)
            ->where('type', $type)
            ->where('expired_at', '>', now())
            ->first();
    }

}
