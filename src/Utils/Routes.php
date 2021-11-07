<?php


namespace Mydevcodes\IpaymerPhp\Utils;

class Routes
{
    const API_URL = 'http://ipaymer.loc:8001/api/v1/';
    const CUSTOMER_CREATE = "customer";
    const CUSTOMER_PLANS = "customer-plans";
    const CUSTOMER_ASSIGN_PLAN = "add-plan";
    const CUSTOMER_CHANGE_PLAN = "change-customer-plan";
    const CUSTOMER_CANCEL_PLAN = "cancel-plan";
    const PLANS = "platform-plans";
}