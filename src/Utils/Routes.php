<?php


namespace Mydevcodes\IpaymerPhp\Utils;

class Routes
{
    const PLATFORM = 'https://ipaymer.com/';
    const API_URL = self::PLATFORM . 'api/v1/internal';
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
    const CUSTOMER_REMOVE_CARD = "remove-card";
    const INVOICE_GENERATE = "generate-invoice";
}