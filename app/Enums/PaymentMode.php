<?php

namespace App\Enums;

enum PaymentMode: string
{
    case InternetBanking = 'internet_banking';
    case CreditDebitCard = 'credit_debit_card';
    case PaymentGateway = 'payment_gateway';
    case Paytm = 'paytm';
    case OthersNeft = 'others_neft';

    public function label(): string
    {
        return match ($this) {
            self::InternetBanking => 'Internet Banking',
            self::CreditDebitCard => 'Credit or debit card',
            self::PaymentGateway => 'Payment Gateway',
            self::Paytm => 'PayTM',
            self::OthersNeft => 'Others / NEFT',
        };
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
