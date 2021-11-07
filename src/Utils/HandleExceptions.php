<?php


namespace Mydevcodes\IpaymerPhp\Utils;

use Mydevcodes\IpaymerPhp\Exceptions\ValidationException;

class HandleExceptions
{
    public static function handle($responseCode)
    {
        switch ($responseCode) {
            case 404:
                throw ValidationException::generalError();
                break;

            default:
                throw ValidationException::authorizationFailed();
        }
    }
}