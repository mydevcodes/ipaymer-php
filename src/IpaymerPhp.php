<?php

namespace Mydevcodes\IpaymerPhp;

use Mydevcodes\IpaymerPhp\Customer\Create;
use Mydevcodes\IpaymerPhp\Customer\Details;
use Mydevcodes\IpaymerPhp\Customer\Invoices;
use Mydevcodes\IpaymerPhp\Customer\Link;
use Mydevcodes\IpaymerPhp\Customer\Plan;
use Mydevcodes\IpaymerPhp\Customer\Status;

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
     * Generates a checkout link
     * @param string $customer
     * @param string $plan
     * @param string $returlUrl
     * @return string
     */
    public function checkoutLink(string $customer, string $plan, $returlUrl = '')
    {
        return (new Link($customer))->checkout($plan, $returlUrl);
    }

    /**
     * Generates the redirect link to add new card to customer
     * @param string $customer
     * @return string
     */
    public function newCardLink(string $customer)
    {
        return (new Link($customer))->newCard();
    }

    /**
     * Get customer information
     * including packages and cards
     * @param string $customer
     * @return array|string
     */
    public function customer(string $customer)
    {
        return (new Details($this->configuration, $customer))->fetch();
    }

    /**
     * Customers status for all packages
     * @param string $customer
     * @return array|string
     */
    public function status(string $customer)
    {
        return (new Status($this->configuration, $customer))->check();
    }

    /**
     * Return all customer invoices
     * @param string $customer
     * @return array|string
     */
    public function invoices(string $customer)
    {
        return (new Invoices($this->configuration, $customer))->fetch();
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