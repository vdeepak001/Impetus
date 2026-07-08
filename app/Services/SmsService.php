<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function sendForgotPasswordOtp(string $phone, string $otp): bool
    {
        $cleanedPhone = $this->formatPhone($phone);
        if (! $cleanedPhone) {
            Log::warning("SmsService: Invalid phone number: {$phone}");

            return false;
        }

        $message = str_replace('{otp}', $otp, config('sms.messages.forgot_password_otp'));

        return $this->send($cleanedPhone, $message, config('sms.templates.forgot_password_otp'));
    }

    public function sendTestOtp(string $phone, string $otp): bool
    {
        $cleanedPhone = $this->formatPhone($phone);
        if (! $cleanedPhone) {
            Log::warning("SmsService: Invalid phone number: {$phone}");

            return false;
        }

        $message = str_replace('{otp}', $otp, config('sms.messages.test_otp'));

        return $this->send($cleanedPhone, $message, config('sms.templates.test_otp'));
    }

    public function sendRegistrationCredentials(
        string $phone,
        string $username,
        string $password,
        ?string $ihsId = null
    ): bool {
        $cleanedPhone = $this->formatPhone($phone);
        if (! $cleanedPhone) {
            Log::warning("SmsService: Invalid phone number: {$phone}");

            return false;
        }

        $message = str_replace(
            ['{username}', '{password}', '{ihs_id}'],
            [$username, $password, $ihsId ?? 'N/A'],
            config('sms.messages.registration')
        );

        return $this->send($cleanedPhone, $message, config('sms.templates.registration'));
    }

    public function sendPurchaseConfirmation(string $phone, string $packageDetails): bool
    {
        $cleanedPhone = $this->formatPhone($phone);
        if (! $cleanedPhone) {
            Log::warning("SmsService: Invalid phone number: {$phone}");

            return false;
        }

        $packageDetails = substr(trim($packageDetails), 0, 50);

        $message = str_replace(
            '{package}',
            $packageDetails,
            config('sms.messages.purchase')
        );

        return $this->send($cleanedPhone, $message, config('sms.templates.purchase'));
    }

    protected function send(string $phone, string $message, string $tempId): bool
    {
        $url = config('sms.api_url');

        Log::info('SmsService: Sending SMS', [
            'phone' => $phone,
            'tempId' => $tempId,
            'entityId' => config('sms.dlt_entity_id'),
            'messageLen' => strlen($message),
            'message' => $message,
        ]);

        try {
            $response = Http::get($url, [
                'username' => config('sms.username'),
                'pass' => config('sms.password'),
                'senderid' => config('sms.sender_id'),
                'dest_mobileno' => $phone,
                'message' => $message,
                'dltentityid' => config('sms.dlt_entity_id'),
                'dlttempid' => $tempId,
                'response' => 'Y',
            ]);

            Log::info('SmsService: API Response', [
                'phone' => $phone,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error("SmsService: Failed to send SMS to {$phone}", [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;

        } catch (\Exception $e) {
            Log::error("SmsService: Exception sending SMS to {$phone}: ".$e->getMessage());

            return false;
        }
    }

    protected function formatPhone(string $phone): ?string
    {
        $digits = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($digits) >= 10) {
            return '91'.substr($digits, -10);
        }

        return null;
    }
}
