<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Exception\InvalidRequestException;

class RefundRequest extends AbstractRequest
{
    protected $endpoint = 'https://payeer.com/ajax/api/api.php';

    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->getParameter('account');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setAccount($value)
    {
        return $this->setParameter('account', $value);
    }

    /**
     * @return mixed
     */
    public function getApiId()
    {
        return $this->getParameter('api_id');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setApiId($value)
    {
        return $this->setParameter('api_id', $value);
    }

    /**
     * @return mixed
     */
    public function getApiSecret()
    {
        return $this->getParameter('api_secret');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setApiSecret($value)
    {
        return $this->setParameter('api_secret', $value);
    }

    /**
     * @return mixed
     */
    public function getPayeeAccount()
    {
        return $this->getParameter('payeeAccount');
    }

    /**
     * @param $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function setPayeeAccount($value)
    {
        return $this->setParameter('payeeAccount', $value);
    }

    /**
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('payeeAccount', 'amount', 'currency', 'description');

        $data['apiPass'] = $this->getApiSecret();
        $data['apiId'] = $this->getApiId();
        $data['account'] = $this->getAccount();
        $data['sum'] = $this->getAmount();
        $data['curIn'] = $this->getCurrency();
        $data['curOut'] = $this->getCurrency();
        $data['to'] = $this->getPayeeAccount();
        $data['comment'] = $this->getDescription();
        $data['action'] = 'transfer';

        return $data;
    }

    /**
     * @param mixed $data
     *
     * @return RefundResponse|\Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        $httpResponse = $this->httpClient->post($this->endpoint, null, $data)->send();
        $jsonResponse = json_decode($httpResponse->getBody(true));
        return $this->response = new RefundResponse($this, $jsonResponse);
    }
}
