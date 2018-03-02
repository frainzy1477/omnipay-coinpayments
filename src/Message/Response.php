<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Class Response
 * @package Omnipay\CoinPayments\Message
 */
class Response extends AbstractResponse
{
    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['result']) && 'ok' === $this->data['error'];
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        if (isset($this->data['error']) && $this->data['error'] !== 'ok') {
            return $this->data['error'];
        } 
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        if (isset($this->data['result'])) {
			
			foreach($this->data['result'] as $key => $value){
				
			}
			
            return $this->data['result'];
        }
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return null
     */
    public function getRedirectData()
    {
        return null;
    }
}