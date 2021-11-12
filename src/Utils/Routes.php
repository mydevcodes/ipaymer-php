<?php


namespace Mydevcodes\IpaymerPhp\Utils;

class Routes
{
    const PLATFORM = 'http://ipaymer.loc:8001/';
    const API_URL = self::PLATFORM . 'api/v1/';
    const CHECKOUT = self::PLATFORM . 'portal';
    const CUSTOMER_NEW_CARD = self::PLATFORM . 'update-card';
    const CUSTOMER_CREATE = "customer";
    const CUSTOMER_PLANS = "customer-plans";
    const CUSTOMER_ASSIGN_PLAN = "add-plan";
    const CUSTOMER_CHANGE_PLAN = "change-customer-plan";
    const CUSTOMER_CANCEL_PLAN = "cancel-plan";
    const PLANS = "platform-plans";
    const CUSTOMER_INFO = "customerInfo";
    const INVOICES = "invoices";
}