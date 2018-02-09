<?php

namespace Omnipay\CoinPayments;

use Omnipay\Common\AbstractGateway;

/**
 * Gateway Class
 */
class APIGateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'CoinPaymentsApi';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'merchant_id' => '',
            'private_key' 	=> '',
            'public_key' => '',
            'ipn_secret' 	=> ''
        );
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchant_id');
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchant_id', $value);
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getParameter('private_key');
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('private_key', $value);
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->getParameter('public_key');
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setPublicKey($value)
    {
        return $this->setParameter('public_key', $value);
    }

    /**
     * @return mixed
     */
    public function getIpnSecret()
    {
        return $this->getParameter('ipn_secret');
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setIpnSecret($value)
    {
        return $this->setParameter('ipn_secret', $value);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinPayments\Message\APIPurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinPayments\Message\APICompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinPayments\Message\APIRefundRequest', $parameters);
    }
}
