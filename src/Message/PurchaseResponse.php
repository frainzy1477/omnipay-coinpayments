<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class PurchaseResponse
 * @package Omnipay\CoinPayments\Message
 */
class PurchaseResponse extends Response implements RedirectResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->data['error'] === 'ok';
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->data['result']['txn_id'];
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return !empty($this->data['result']['status_url']);
    }

    /**
     * @return null|string
     */
    public function getRedirectUrl()
    {
        if ($this->data['result']['error'] !== 'ok') {
            return null;
        }

        return $this->data['result']['status_url'];
    }
}
