<?php

namespace Omnipay\Paylane;

use Omnipay\Common\AbstractGateway;

/**
 * Class Gateway.
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Paylane';
    }

    /**
     * @return array
     */
    public function getDefaultParameters()
    {
        return [
            'apiKey'      => '',
            'apiPassword' => '',
            'ip'          => '',
            'language'    => 'pl',
        ];
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function setPosId($value)
    {
        return $value;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @param $value
     *
     * @return Gateway
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return mixed
     */
    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
    }

    /**
     * @param $value
     *
     * @return Gateway
     */
    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->getParameter('ip');
    }

    /**
     * @param $value
     *
     * @return Gateway
     */
    public function setIp($value)
    {
        return $this->setParameter('ip', $value);
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     * @param $value
     *
     * @return Gateway
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paylane\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paylane\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function authorize(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paylane\Message\CardCheckRequest', $parameters);
    }

    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function saleBy3DSecureAuthorization(array $parameters = [])
    {
        return $this->createRequest('\Omnipay\Paylane\Message\SaleBySecureAuthorizationRequest', $parameters);
    }
}
