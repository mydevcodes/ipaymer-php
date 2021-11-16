<?php


namespace Mydevcodes\IpaymerPhp\Customer;

use Mydevcodes\IpaymerPhp\Utils\Configuration;
use Mydevcodes\IpaymerPhp\Utils\Request;
use Mydevcodes\IpaymerPhp\Utils\Routes;

class Invoices extends Request
{
    public $customer;

    public function __construct(Configuration $configuration, string $customer)
    {
        parent::__construct($configuration);
        $this->customer = $customer;
    }

    public function fetch()
    {
        try {
            $this->postAPI(Routes::INVOICES, [
                'customer' => $this->customer
            ]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        if($this->httpStatus != 200)
        {
            return $this->prepareResponse("An error happened.");
        }

        $invoices = [];
        if(isset($this->httpBody->response))
        {
            foreach($this->httpBody->response as $row) {
                $invoices[] = [
                    'invoice_no' => $row->invoice_no,
                    'package' => $row->plan_code,
                    'package_name' => $row->plan_name,
                    'status' => $row->status,
                    'status_text' => $this->getInvoiceStatus($row->status),
                    'amount_due' => $row->amount_due,
                    'amount_paid' => $row->amount_paid,
                    'currency' => $row->currency,
                    'error' => $row->error,
                ];
            }
        }

        return $invoices;
    }

    private function getInvoiceStatus($status)
    {
        if($status == 1) {
            return "Paid";
        }elseif($status == 2) {
            return "Pending";
        }else {
            return "Failed";
        }
    }

}