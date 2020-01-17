<?php

namespace Omnipay\Paylane;

use Omnipay\Common\AbstractGateway;


/**
 * Paylane Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName() {

        return 'Paylane';
    }

    public function getDefaultParameters(){

        return array(
            'apiKey' => '',
            'apiPassword' => '',
            'ip' => '',
            'language' => 'pl',
        );

    }

    public function getApiKey() {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value) {
        return $this->setParameter('apiKey', $value);
    }

    public function getApiPassword() {
        return $this->getParameter('apiPassword');
    }

    public function setApiPassword($value) {
        return $this->setParameter('apiPassword', $value);
    }

    public function getIp() {
        return $this->getParameter('ip');
    }

    public function setIp($value) {
        return $this->setParameter('ip', $value);
    }

    public function getLanguage() {
        return $this->getParameter('language');
    }

    public function setLanguage($value) {
        return $this->setParameter('language', $value);
    }

    public function purchase(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Paylane\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Paylane\Message\CompletePurchaseRequest', $parameters);
    }

    public function authorize(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Paylane\Message\CardCheckRequest', $parameters);
    }

    public function saleBy3DSecureAuthorization(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Paylane\Message\SaleBySecureAuthorizationRequest', $parameters);
    }

}
