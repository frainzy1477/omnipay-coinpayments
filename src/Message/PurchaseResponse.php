<?php
namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

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
     * @return null|string
     */
    public function getTransactionId()
    {
        return $this->data['result']['txn_id'] ?? null;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return isset($this->data['result']['status_url']);
    }

    /**
     * @return null|string
     */
    public function getRedirectUrl()
    {
        return $this->data['result']['status_url'] ?? null;
    }
}
