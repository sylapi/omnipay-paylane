<?php
/**
 * Paylane Abstract Request
 */

namespace Omnipay\Paylane\Message;


abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://direct.paylane.com/rest';
    protected $testEndpoint = 'https://direct.paylane.com/rest';


    public function getIp() {
        return $this->getParameter('ip');
    }
    public function setIp($value) {
        return $this->setParameter('ip', $value);
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


    public function getVerificationCode() {
        return $this->getParameter('verificationCode');
    }
    public function setVerificationCode($value) {
        return $this->setParameter('verificationCode', $value);
    }


    public function getLanguage() {
        return $this->getParameter('language');
    }
    public function setLanguage($value) {
        return $this->setParameter('language', $value);
    }

    public function getId3DSecureAuth() {
        return $this->getParameter('id_3dsecure_auth');
    }
    public function setId3DSecureAuth($value) {
        return $this->setParameter('id_3dsecure_auth', $value);
    }


    public function getAmount() {
        return $this->getParameter('amount');
    }
    public function setAmount($value) {
        return $this->setParameter('amount', $value);
    }


    public function getCurrency() {
        return $this->getParameter('currency');
    }
    public function setCurrency($value) {
        return $this->setParameter('currency', $value);
    }


    public function getDescription() {
        return $this->getParameter('description');
    }
    public function setDescription($value) {
        return $this->setParameter('description', $value);
    }


    public function getName() {
        return $this->getParameter('name');
    }
    public function setName($value) {
        return $this->setParameter('name', $value);
    }


    public function getEmail() {
        return $this->getParameter('email');
    }
    public function setEmail($value) {
        return $this->setParameter('email', $value);
    }


    public function getStreetHouse() {
        return $this->getParameter('street_house');
    }
    public function setStreetHouse($value) {
        return $this->setParameter('street_house', $value);
    }


    public function getCity() {
        return $this->getParameter('city');
    }
    public function setCity($value) {
        return $this->setParameter('city', $value);
    }


    public function getZip() {
        return $this->getParameter('zip');
    }
    public function setZip($value) {
        return $this->setParameter('zip', $value);
    }


    public function getCountryCode() {
        return $this->getParameter('country_code');
    }
    public function setCountryCode($value) {
        return $this->setParameter('country_code', $value);
    }


    public function getIdSecureAuth() {
        return $this->getParameter('id_secure_auth');
    }
    public function setIdSecureAuth($value) {
        return $this->setParameter('id_secure_auth', $value);
    }

    public function getIdSale() {
        return $this->getParameter('id_sale');
    }
    public function setIdSale($value) {
        return $this->setParameter('id_sale', $value);
    }


    public function getReturnUrl() {
        return $this->getParameter('back_url');
    }
    public function setReturnUrl($value) {
        return $this->setParameter('back_url', $value);
    }

    public function setTransactionId($value) {
        return $this->setParameter('transactionId', $value);
    }

    public function getTransactionId() {
        return $this->getParameter('transactionId');
    }


    public function getRequestMethod() {
        $method = $this->getParameter('request_method');
        return ($method) ? $method : 'POST';
    }
    public function setRequestMethod($value) {
        return $this->setParameter('request_method', $value);
    }

    public function getAction() {
    }

    public function getCard()
    {
        return $this->getParameter('card');
    }

    public function getHeaders()
    {
        $headers = array(
            'Content-type' => 'application/json'
        );

        return $headers;
    }

    public function sendData($data)
    {
        $headers = array_merge(
            $this->getHeaders(),
            array('Authorization' => 'Basic ' . base64_encode($this->getApiKey() . ':' . $this->getApiPassword()))
        );


        $httpResponse = $this->httpClient->request($this->getRequestMethod(), $this->getEndpoint(), $headers, json_encode($data));
        $responseBody = json_decode($httpResponse->getBody()->getContents(), true);


        if (isset($responseBody['error']['error_number']) && $responseBody['error']['error_number'] == 720) {

            $httpResponse = $this->httpClient->request($this->getRequestMethod(), $this->getEndpointUrl().'/cards/sale', $headers, json_encode($data));
            $responseBody = json_decode($httpResponse->getBody()->getContents(), true);
        }


        return $this->createResponse($responseBody, $httpResponse->getHeaders());
    }


    protected function createResponse($data, $headers = [])
    {
        if (isset($data['id_sale'])) {
            $this->setIdSale($data['id_sale']);
        }
        if (isset($data['id_3dsecure_auth'])) {
            $this->setIdSecureAuth($data['id_3dsecure_auth']);
        }

        return $this->response = new Response($this, $data, $headers);
    }


    protected function getEndpointUrl()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
