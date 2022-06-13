<?php

namespace App\Services;

use App\Enums\TransactionEnum;
use App\Repositories\CardRepository;
use App\Repositories\LoanRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class PaystackWebhookService {
    public $cardRepo, $transactionRepo, $loanRepo, $transactionService;

    public function __construct(
        CardRepository $cardRepo, TransactionRepository $transactionRepo,
        TransactionService $transactionService, LoanRepository $loanRepo
    ) {
        $this->cardRepo = $cardRepo;
        $this->transactionRepo = $transactionRepo;
        $this->transactionService = $transactionService;
        $this->loanRepo = $loanRepo;
    }

    public function handleWebhook(array $data) : bool {
        $transaction = $this->transactionRepo->getByReferenceNumber($data['reference']);
        if ($data['status'] == 'success') {
            if($data['metadata']['save_card'] == 'true') {
                $cardInfo = $data['authorization'];
                $transactionData = $this->saveCard(
                    $transaction->reference,
                    $cardInfo['authorization_code'],
                    $cardInfo['exp_month'],
                    $cardInfo['exp_month'],
                    $cardInfo['last4'],
                    $cardInfo['card_type'],
                    $cardInfo['bank']
                );
            }
            // Handle payment loan transaction
            if($transaction->type == TransactionEnum::LOAN) {
                $transactionData = $this->handleLoanTransaction($transaction->reference);
            }
            $this->transactionService->updateTransactionService($data['reference'], $transactionData + ['status_id' => status_completed_id()]);
            return true;
        } else {
            $this->transactionService->updateTransactionService($data['reference'], ['status_id' => status_failed_id()]);
            return false;
        }

    }

    public function saveCard(string $reference, string $token, string $expMonth, string $expYear, string $last4, string $cardType, string $bank) {
        $transaction = $this->transactionRepo->getByReferenceNumber($reference);
        // Check if this user has a default card
        $card = $this->cardRepo->getDefaultCardByUserId($transaction->user_id);
        // Check if this card is already existing in database
        $existingCard = $this->cardRepo->getByToken($token);
        if (!$existingCard) {
            $data = [
                'user_id' => $transaction->user_id,
                'token' => $token,
                'exp_month' => $expMonth,
                'exp_year' => $expYear,
                'last4' => $last4,
                'is_default' => $card ? false : true,
                'card_type' => $cardType,
                'bank' => $bank,
                'status_id' => status_active_id()
            ];
            $card = $this->cardRepo->create($data);
        }
        return [
            'transactable_type' => $this->cardRepo->getClassConstant(),
            'transactable_id' => $card->id,
        ];
    }

    public function handleLoanTransaction(string $reference) {
        $transaction = $this->transactionRepo->getByReferenceNumber($reference);
        $loan = $this->loanRepo->getById($transaction->transactable_id);
        if ($loan->total_amount_due == $transaction->amount) {
            $this->loanRepo->updateStatus($loan->id, status_completed_id());

            event(new \App\Events\LoanStatusUpdated($loan->id, status_completed_id()));
        }
        return [
            'transactable_type' => $this->loanRepo->getClassConstant(),
            'transactable_id' => $loan->id,
        ];
    }
}
