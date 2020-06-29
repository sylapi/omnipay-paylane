<?php

namespace Omnipay\Paylane\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Response
 * @package Omnipay\Paylane\Message
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @var null
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Response constructor.
     * @param RequestInterface $request
     * @param $data
     * @param array $headers
     */
    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = $data;
        $this->headers = $headers;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if (!empty($this->data['success'])) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed|null
     */
    public function getResponse()
    {
        if ($this->isSuccessful()) {
            return $this->data;
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {

            if (isset($this->data['error']) && isset($this->data['error']['error_description'])) {
                return $this->data['error']['error_description'];
            }
            else if ($this->request->statusCode == 401) {
                return 'Login error';
            }
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getCode()
    {
        if (isset($this->data['error']) && isset($this->data['error']['error_number'])) {
            return $this->data['error']['error_number'];
        }

        return $this->request->statusCode;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        if (isset($this->data['redirect_url'])) {
            return true;
        }

        return false;
    }

    /**
     * @return bool|void
     */
    public function redirect()
    {
        if (isset($this->data['redirect_url'])) {
            header('Location: '.$this->data['redirect_url']);
        }

        return false;
    }

    /**
     * @return string|null
     */
    public function getRedirectUrl()
    {
        if (isset($this->data['redirect_url']) && !empty($this->data['redirect_url'])) {
            return $this->data['redirect_url'];
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        if (isset($this->data['id_3dsecure_auth'])) {
            return $this->data['id_3dsecure_auth'];
        }
        else if (isset($this->data['id_sale'])) {
            return $this->data['id_sale'];
        }

        return null;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * @return array|null
     */
    public function getRedirectData()
    {
        return null;
    }
}