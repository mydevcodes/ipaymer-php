<?php


namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Exceptions\ValidationException;
use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Plan extends Request
{
    public $customerId;
    public $planCode;

    public function __construct(
        Configuration $configuration,
        string $customerId,
        string $planCode
    )
    {
        parent::__construct($configuration);
        $this->customerId = $customerId;
        $this->planCode = $planCode;
        $this->validate();
    }

    /**
     * Assign a new subscription to customer
     * It might be a recurring plan or a fixed payment intent
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function assign($quantity = NULL)
    {
        try {
            $this->postAPI(Routes::CUSTOMER_ASSIGN_PLAN, [
                'customer_id' => $this->customerId,
                'plan_code' => $this->planCode,
                'quantity' => $quantity
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
        }

        return $this->prepareResponse("Plan added to customer");
    }

    /**
     * Changes current plan with another one!
     * Usually used between same plan prices
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function change(string $from_plan)
    {
        try {
            $this->postAPI(Routes::CUSTOMER_CHANGE_PLAN, [
                'customer_id' => $this->customerId,
                'plan_code' => $this->planCode,
                'change_from_plan' => $from_plan
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
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
                'plan_code' => $this->planCode
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
        }

        return $this->prepareResponse("Subscription has been cancelled successfully!");

    }

    public function validate()
    {
        if(!$this->customerId)
        {
            throw ValidationException::missingRequiredParameter('customer_id', 400);
        }

        if(!$this->planCode)
        {
            throw ValidationException::missingRequiredParameter('plan_code', 400);
        }
    }
}