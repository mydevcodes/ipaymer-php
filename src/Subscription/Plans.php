<?php

namespace Mydevcodes\IpaymerPhp\Subscription;

use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Plans extends Request
{
    public function __construct(
        Configuration $configuration
    )
    {
        parent::__construct($configuration);
    }

    /**
     * Returns all available plans within platform
     */
    public function retrieve(string $customer = NULL)
    {
        try {
            $this->getAPI(Routes::PLANS);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        return $this->httpBody->response;
    }
}