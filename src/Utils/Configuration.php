<?php


namespace Mydevcodes\IpaymerPhp\Utils;


class Configuration
{
    /**
     * @var
     */
    public $secret_key;

    /**
     * @var
     */
    public $environment = 'production';

    public function __construct(
        string $secret_key,
        $environment = 'production'
    )
    {
        $this->secret_key = $secret_key;
        $this->environment = $environment;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }


}