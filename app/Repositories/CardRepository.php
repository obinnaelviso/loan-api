<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository {
    public $card;
    public function __construct(Card $card) {
        $this->card = $card;
    }

    public function getByToken(string $token) {
        return $this->card->where('token', $token)->first();
    }

    public function getAll() {
        return $this->card->all();
    }

    public function getByUser(int $userId) {
        return $this->card->where('user_id', $userId)->get();
    }

    public function getByUserId(int $userId) {
        return $this->card->where('user_id', $userId)->first();
    }

    public function getDefaultCardByUserId(int $userId) {
        return $this->card->where('user_id', $userId)->where('is_default', true)->first();
    }

    public function create(array $data) {
        return $this->card->create($data);
    }

    public function getClassConstant() {
        return Card::class;
    }
}
