<?php

namespace Omnipay\CoinPayments\Message;

class PurchaseRequest extends AbstractRequest
{
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
     * @return \Omnipay\Common\Message\AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
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
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setIpnSecret($value)
    {
        return $this->setParameter('ipn_secret', $value);
    }

    /**
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('merchant_id', 'private_key', 'public_key', 'ipn_secret');

        $data['cmd'] = '_pay_simple';
        $data['reset'] = 1;
        $data['merchant'] = $this->getMerchantId();
        $data['currency'] = $this->getCurrency();
        $data['amountf'] = $this->getAmount();
        $data['item_name'] = $this->getDescription();
        $data['cancel_url'] = $this->getCancelUrl();
        //dump($this->getParameters());
        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return PurchaseResponse|\Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data, $this->getMerchantEndpoint());
    }
}
