<?php


namespace Mydevcodes\IpaymerPhp\Customer;


use Mydevcodes\IpaymerPhp\Utils\Routes;

class Link
{
    public $customer;

    public function __construct(string $customer)
    {
        $this->customer = $customer;
    }

    public function checkout(string $plan, $returnUrl = '')
    {
        $checkoutParams = "?cus={cus}&pl={plan}";
        $checkoutParams = str_replace([
            '{cus}',
            '{plan}',
            '{return}',
        ], [
            $this->customer,
            $plan
        ], $checkoutParams);

        if($returnUrl)
        {
            $checkoutParams .= "&returnUrl=" . $returnUrl;
        }

        return Routes::CHECKOUT . $checkoutParams;
    }

    public function newCard($returnUrl = '')
    {
        $cardParam = "?cus=" . $this->customer;
        if($returnUrl)
        {
            $cardParam .= '&url=' . $returnUrl;
        }

        return Routes::CUSTOMER_NEW_CARD . $cardParam;
    }
}