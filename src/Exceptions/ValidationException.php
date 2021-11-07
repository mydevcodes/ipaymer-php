<?php


namespace Mydevcodes\IpaymerPhp\Exceptions;

class ValidationException extends \Exception
{
    public static function noSecretKeyProvided(): self
    {
        return new static('Secret Key has not been provided!', 401);
    }

    public static function generalError(): self
    {
        return new static('General error happened!',400);
    }

    public static function missingRequiredParameter(string $parameter): self
    {
        return new static('Missing required parameter: ' . $parameter, 400);
    }

    public static function authorizationFailed(): self
    {
        return new static('Your platform is not whitelisted in our system!',401);
    }
}