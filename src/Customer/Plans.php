<?php


namespace Mydevcodes\IpaymerPhp\Customer;


use Mydevcodes\IpaymerPhp\Exceptions\ValidationException;
use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;
use Rakit\Validation\Validator;

class Plans extends Request
{

    public function __construct(Configuration $configuration)
    {
        parent::__construct($configuration);
    }

    /**
     * Returns all customer plans!
     * @param string $customerId
     * @return mixed
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieve(string $customerId)
    {
        if(!$customerId)
        {
            throw ValidationException::missingRequiredParameter('customerId');
        }

        $this->getAPI(Routes::CUSTOMER_PLANS);
        return $this->httpBody;
    }

}