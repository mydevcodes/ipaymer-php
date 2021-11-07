<?php


namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Exceptions\ValidationException;
use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Plan extends Request
{
    public $customerId;
    public $planId;

    public function __construct(
        Configuration $configuration,
        string $customerId,
        int $planId
    )
    {
        parent::__construct($configuration);
        $this->customerId = $customerId;
        $this->planId = $planId;
        $this->validate();
    }

    /**
     * Assign a new subscription to customer
     * It might be a recurring plan or a fixed payment intent
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function assign()
    {
        try {
            $this->postAPI(Routes::CUSTOMER_ASSIGN_PLAN, [
                'customer_id' => $this->customerId,
                'plan_id' => $this->planId
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        return $this->prepareResponse("Plan added to customer");
    }

    /**
     * Changes current plan with another one!
     * Usually used between same plan prices
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function change()
    {
        try {
            $this->postAPI(Routes::CUSTOMER_CHANGE_PLAN, [
                'customer_id' => $this->customerId,
                'plan_id' => $this->planId
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        return $this->prepareResponse($this->httpBody);
    }

    /**
     * Cancel customer plan
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel()
    {
        try {
            $this->postAPI(Routes::CUSTOMER_CANCEL_PLAN, [
                'customer_id' => $this->customerId,
                'plan_id' => $this->planId
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function validate()
    {
        if(!$this->customerId)
        {
            throw ValidationException::missingRequiredParameter('customer_id', 400);
        }

        if(!$this->planId)
        {
            throw ValidationException::missingRequiredParameter('planId', 400);
        }
    }
}