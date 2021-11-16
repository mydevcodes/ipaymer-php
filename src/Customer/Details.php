<?php

namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Details extends Request
{
    public $customer;

    public function __construct(Configuration $configuration, string $customer)
    {
        parent::__construct($configuration);
        $this->customer = $customer;
    }

    public function fetch()
    {
        try {
            $this->postAPI(Routes::CUSTOMER_INFO, [
                'customer' => $this->customer
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
        }

        return $this->prepareResponse("Information fetched successfully!");
    }

}