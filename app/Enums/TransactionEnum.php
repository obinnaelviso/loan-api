<?php

namespace App\Enums;

interface TransactionEnum {
    const PAYSTACK_CARD_PAYMENT = "paystack-card-payment";
    const CARD_REFUND = "card-refund";
    const SAVE_CARD = "save-card";
    const LOAN = "loan";
}
