<?php

namespace Borica\Manager;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use function bin2hex;
use function fclose;
use function file_exists;
use function filesize;
use function fopen;
use function fread;
use function hex2bin;
use function openssl_free_key;
use function openssl_get_privatekey;
use function openssl_pkey_get_public;
use function openssl_sign;
use function openssl_verify;
use function strtoupper;

trait CertificateManager
{
    protected function isValidSignature(string $message, string $signature, array $config): bool
    {
        $key = $this->readKey($config['public_key']);

        if (!$publicKey = openssl_pkey_get_public($key)) {
            throw new InvalidParameterException("Could not get public key!");
        }

        $verify = openssl_verify($message, hex2bin($signature), $publicKey, OPENSSL_ALGO_SHA256);

        openssl_free_key($publicKey);

        return 1 === $verify;
    }

    protected function sign($message, array $config): string
    {
        $privateKey = openssl_get_privatekey($this->readKey($config['private_key']), $config['private_key_password']);

        if (!$privateKey) {
            throw new InvalidParameterException('Could not get private key!');
        }

        if (!openssl_sign($message, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new InvalidParameterException("Could not generate signature!");
        }

        openssl_free_key($privateKey);

        return strtoupper(bin2hex($signature));
    }

    private function readKey(string $key): string
    {
        if (!file_exists($key)) {
            throw new FileNotFoundException($key);
        }

        if (!$fp = fopen($key, 'r')) {
            throw new FileException("Could not open the file!", 1);
        }

        if (!$read = fread($fp, filesize($key))) {
            throw new FileException("Could not read the file!", 1);
        }

        fclose($fp);

        return $read;
    }
}
