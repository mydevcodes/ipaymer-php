<?php


namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Status extends Request
{
    public $customer;

    public function __construct(Configuration $configuration, string $customer)
    {
        parent::__construct($configuration);
        $this->customer = $customer;
    }

    public function check()
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

        $activePacks = [];

        $packages = $this->httpBody->packages;
        foreach($packages as $package) {
            $activePacks[] = [
                'name' => $package->name,
                'code' => $package->code,
                'has_units' => $package->has_units,
                'units' => $package->quantity,
                'price' => $package->has_units ? ($package->amount * $package->quantity) : $package->amount,
                'last_payment' => $package->last_payment,
                'last_payment_status' => $package->last_payment_status,
                'next_billing' => $package->next_billing
            ];
        }

        return $activePacks;
    }
}