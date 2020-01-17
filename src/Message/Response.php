<?php

/**
 * Paylane Response.
 */
namespace Omnipay\Paylane\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Stripe Response.
 *
 * This is the response class for all Stripe requests.
 *
 * @see \Omnipay\Paylane\Gateway
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Request id
     *
     * @var string URL
     */
    protected $requestId = null;

    /**
     * @var array
     */
    protected $headers = [];

    public function __construct(RequestInterface $request, $data, $headers = [])
    {
        $this->request = $request;
        $this->data = $data;
        $this->headers = $headers;
    }

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        if (!empty($this->data['success'])) {
            return true;
        }

        return false;
    }

    public function getResponse()
    {
        if ($this->isSuccessful()) {
            return $this->data;
        }

        return null;
    }

    public function getMessage()
    {
        if (!$this->isSuccessful() && isset($this->data['error']) && isset($this->data['error']['error_description'])) {
            return $this->data['error']['error_description'];
        }

        return null;
    }

    public function getCode()
    {
        if (!$this->isSuccessful() && isset($this->data['error']) && isset($this->data['error']['error_number'])) {
            return $this->data['error']['error_number'];
        }

        return null;
    }

    public function isRedirect()
    {
        if (isset($this->data['redirect_url'])) {
            return true;
        }

        return false;
    }

    public function redirect()
    {
        if (isset($this->data['redirect_url'])) {
            header('Location: '.$this->data['redirect_url']);
        }

        return false;
    }

    public function getRedirectUrl()
    {
        if (isset($this->data['redirect_url']) && !empty($this->data['redirect_url'])) {
            return $this->data['redirect_url'];
        }

        return null;
    }

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


    public function getRedirectMethod()
    {
        return 'GET';
    }


    public function getRedirectData()
    {
        return null;
    }

}
