<?php

namespace App\Services;

use App\Enums\TransactionEnum;
use App\Http\Resources\CardResource;
use App\Repositories\CardRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Traits\PayWithCard;

class CardService {

    use PayWithCard;
    public $cardRepo, $transactionRepo, $userRepo;

    public function __construct(CardRepository $cardRepo, TransactionRepository $transactionRepo, UserRepository $userRepo) {
        $this->cardRepo = $cardRepo;
        $this->transactionRepo = $transactionRepo;
        $this->userRepo = $userRepo;
    }

    public function get() {
        $cards = $this->cardRepo->getByUser(auth()->user()->id);
        return CardResource::collection($cards);
    }

    public function getAll() {
        $cards = $this->cardRepo->getAll();
        return CardResource::collection($cards);
    }

    public function saveCard() {
        return $this->pay(10, TransactionEnum::SAVE_CARD, auth()->user()->id, $this->transactionRepo, $this->userRepo, null, true);
    }

    public function payLoan(int $amount, $loanId) {
        return $this->pay($amount, TransactionEnum::LOAN, auth()->user()->id, $this->transactionRepo, $this->userRepo, $loanId);
    }
}
