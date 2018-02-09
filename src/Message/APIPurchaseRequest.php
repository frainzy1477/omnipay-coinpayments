<?php

namespace Omnipay\CoinPayments\Message;

class APIPurchaseRequest extends AbstractRequest
{
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
     */
	public function getCurrency2()
    {
        return $this->getParameter('currency2');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setCurrency2($value)
    {
        return $this->setParameter('currency2', $value);
    }

    /**
     * @return mixed
     */
    public function getBuyerEmail()
    {
        return $this->getParameter('buyer_email');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBuyerEmail($value)
    {
        return $this->setParameter('buyer_email', $value);
    }

    /**
     * @return mixed
     */
    public function getBuyerName()
    {
        return $this->getParameter('buyer_name');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setBuyerName($value)
    {
        return $this->setParameter('buyer_name', $value);
    }

    /**
     * @return mixed
     */
    public function getItemName()
    {
        return $this->getParameter('item_name');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setItemName($value)
    {
        return $this->setParameter('item_name', $value);
    }

    /**
     * @return mixed
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('private_key', 'public_key', 'ipn_secret');

        $data['version'] = 1;
        $data['cmd'] = 'create_transaction';
        $data['key'] = $this->getPublicKey();
        $data['private_key'] = $this->getPrivateKey();
        $data['format'] = 'json'; //supported values are json and xml

		$data['amount'] = $this->getAmount();
		$data['currency1'] = $this->getCurrency();
		$data['currency2'] = $this->getCurrency2();

        $data['buyer_email'] = $this->getBuyerEmail();
        $data['buyer_name'] = $this->getBuyerName();
        $data['item_name'] = $this->getItemName();

        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return APIPurchaseResponse|\Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('POST', $data);

        return $this->response = new APIPurchaseResponse($this, $httpResponse->json(), $this->getMerchantEndpoint());
    }
}
