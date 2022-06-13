<?php

namespace App\Http\Controllers;

use App\Repositories\LoanRepository;
use App\Services\CardService;
use App\Services\PaystackWebhookService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    protected $cardService, $pWebhookService, $loanRepo;
    public function __construct(
        CardService $cardService,
        PaystackWebhookService $pWebhookService,
        LoanRepository $loanRepo
    ) {
        $this->cardService = $cardService;
        $this->pWebhookService = $pWebhookService;
        $this->loanRepo = $loanRepo;
    }

    public function index() {
        $cards = $this->cardService->get();
        return apiSuccess($cards, 'Cards retrieved successfully!');
    }

    public function all() {
        $cards = $this->cardService->getAll();
        return apiSuccess($cards, 'Cards retrieved successfully!');
    }

    public function pay(Request $request, $card_id = null) {
        // $request->validate([
        //     'amount' => ['required', 'integer', 'min:10']
        // ]);
        // $data = $this->cardService->initiatePayment($request->amount, $card_id);
        return CardService::class;
    }

    public function payLoan($loanId, $card_id = null) {
        $loan = $this->loanRepo->getById($loanId);
        $data = $this->cardService->payLoan($loan->total_amount_due, $loan->id);
        return $data;
    }

    public function saveCard() {
        $data = $this->cardService->saveCard();
        return $data;
    }

    public function webhook(Request $request) {
        $isSuccessful = $this->pWebhookService->handleWebhook($request->data);
        if ($isSuccessful) {
            return apiSuccess(null, "Webhook successfully handled!");
        } else {
            return apiError("Oops, something went wrong. Please try again later!");
        }
    }
}
