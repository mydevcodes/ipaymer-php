<?php

namespace Mydevcodes\IpaymerPhp;

use Mydevcodes\IpaymerPhp\Customer\Create;
use Mydevcodes\IpaymerPhp\Customer\Plan;

class IpaymerPhp
{
    /**
     * Defined string
     * @var
     */
    protected $configuration;

    public function __construct(
        \Mydevcodes\IpaymerPhp\Utils\Configuration $configuration
    )
    {
        $this->configuration = $configuration;
    }

    /**
     * Initialize a new inheritance
     * @param string $secret_key
     * @param string $production
     * @return IpaymerPhp
     */
    public static function init(string $secret_key, $production = 'production')
    {
        $configuration = (new Utils\Configuration($secret_key, $production));

        return new self($configuration);
    }

    /**
     * Create a new customer
     * This will mostly be referred as Customer.
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $params)
    {
        return (new Create($this->configuration))->create($params);
    }














    /**
     *  Returns all available plans for a specific platform
     * @param string $customer Specify a customer if the customer is already created
     * @return void
     */
    public function plans(string $customer = NULL)
    {
        return (new \Mydevcodes\IpaymerPhp\Subscription\Plans($this->configuration))->retrieve($customer);
    }

    /**
     * Attach a new subscription plan to customer
     * @param string $customer
     * @param int $plan_id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function assign(string $customer, int $plan_id)
    {
        return (new Plan($this->configuration, $customer, $plan_id))->assign();
    }

    /**
     * Change customer plan
     * Usually used within the same plan
     * @param string $customer
     * @param int $plan_id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function change(string $customer, int $plan_id)
    {
        return (new Plan($this->configuration, $customer, $plan_id))->change();
    }
    
    /**
     * Cancel a customer's plan
     * Removes a plan from customer recurring state
     * @param string $customer
     * @param int $plan_id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancel(string $customer, int $plan_id)
    {
        return (new Plan($this->configuration, $customer, $plan_id))->cancel();
    }


}
