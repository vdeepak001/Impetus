<?php

namespace App\Services;

class CCAvenueService
{
    /**
     * Encrypt plain text using CCAvenue AES working key.
     */
    public function encrypt(string $plainText, string $key): string
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encrypted = openssl_encrypt($plainText, 'AES-128-CBC', $secretKey, OPENSSL_RAW_DATA, $initVector);
        return bin2hex($encrypted);
    }

    /**
     * Decrypt encrypted text using CCAvenue AES working key.
     */
    public function decrypt(string $encryptedText, string $key): string
    {
        $secretKey = $this->hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedBin = $this->hextobin($encryptedText);
        $decrypted = openssl_decrypt($encryptedBin, 'AES-128-CBC', $secretKey, OPENSSL_RAW_DATA, $initVector);
        return (string) $decrypted;
    }

    /**
     * Convert hex string to binary.
     */
    private function hextobin(string $hexString): string
    {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString .= $packedString;
            }
            $count += 2;
        }
        return $binString;
    }

    /**
     * Retrieve the gateway URL depending on sandbox setting.
     */
    public function getGatewayUrl(): string
    {
        $isSandbox = config('services.ccavenue.sandbox', true);
        return $isSandbox
            ? 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction'
            : 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
    }
}
