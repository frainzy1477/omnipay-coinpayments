<?php

namespace Omnipay\CoinPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\CoinPayments\Support\Helpers;

class RefundResponse extends AbstractResponse
{
    protected $redirectUrl;
    protected $message;
    protected $success;

    /**
     * RefundResponse constructor.
     *
     * @param RequestInterface $request
     * @param                  $data
     */
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
        $this->success = false;
        $this->parseResponse($data);
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->success;
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    private function parseResponse($data)
    {
        if (is_array($data->errors) && count($data->errors)) {
            $this->message = implode(" | ", $data->errors);
            $this->success = false;
            return false;
        }
        $this->success = true;
    }
}
