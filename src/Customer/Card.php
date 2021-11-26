<?php


namespace Mydevcodes\IpaymerPhp\Customer;


use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Card extends Request
{
    public $customer;

    public function __construct(
        Configuration $configuration,
        string $customer
    )
    {
        parent::__construct($configuration);
        $this->customer = $customer;
    }

    /**
     * Returns all available plans within platform
     */
    public function remove(string $ipaymer_card_id)
    {
        try {
            $this->postAPI(Routes::CUSTOMER_REMOVE_CARD, [
                'ipaymer_card_id' => $ipaymer_card_id
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