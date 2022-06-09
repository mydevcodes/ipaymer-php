<?php

namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class GenerateInvoice extends Request
{
    public $customer;

    public function __construct(Configuration $configuration, $customer)
    {
        parent::__construct($configuration);
        $this->customer = $customer;
    }

    public function generate($code, $price, $quantity = 1, $description = '')
    {
        try {
            $this->postAPI(Routes::INVOICE_GENERATE, [
                'customer' => $this->customer,
                'planCode' => $code,
                'price' => $price,
                'quantity' => $quantity,
                'description' => $description
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
        }

        return $this->prepareResponse("Invoice generated successfully!");
    }
}