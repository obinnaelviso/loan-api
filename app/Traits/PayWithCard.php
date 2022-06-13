<?php

namespace App\Traits;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Http;

trait PayWithCard {
    use ReferenceNumbers;

    public function pay(
        int $amount, string $type, $userId,
        TransactionRepository $transactionRepo,
        UserRepository $userRepo, $modelId = null, bool $saveCard = false
    ) {
        $user = $userRepo->getById($userId);
        $reference = $this->generatePaymentReference($transactionRepo);
        $body = [
            'amount' => $amount * 100,
            'email' => $user->email,
            'reference' => $reference,
            'metadata' => [
                'save_card' => $saveCard
            ]
        ];
        $response = $this->initializeApi()
            ->post(config('paystack.url') . '/transaction/initialize', $body);

        if ($response->successful()) {
            $transactionRepo->create([
                'user_id' => $userId,
                'transactable_type' => 'null',
                'transactable_id' => $modelId ?? 0,
                'reference' => $reference,
                'type' => $type,
                'amount' => $amount,
                'status_id' => status_pending_id()
            ]);
            return $response->object()->data;
        } else {
            // throw new \Exception($response->object()->message);
            return $response->json();
        }
    }

    protected function initializeApi() {
        return Http::withToken(config('paystack.sk'));
    }

}
