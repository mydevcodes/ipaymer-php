<?php

namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;
use Rakit\Validation\Validator;

class Create extends Request
{
    public $customerId;

    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
    }

    public function __toString()
    {
        return $this->customerId;
    }

    /**
     * Creates a new (customer &) subscription
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $data): mixed
    {
        $validatior = new Validator;
        $validation = $validatior->make($data, [
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $validation->validate();

        if($validation->fails())
        {
            return $validation->errors()->all();
        }

        try {
            $this->postAPI(Routes::CUSTOMER_CREATE, $data);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
        }

        return isset($this->httpBody->customer) ? $this->httpBody->customer : "";
    }
}