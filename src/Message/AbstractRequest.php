<?php

namespace Omnipay\Paylane\Message;

/**
 * Class AbstractRequest.
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * @var string
     */
    protected $liveEndpoint = 'https://direct.paylane.com/rest';
    /**
     * @var string
     */
    protected $testEndpoint = 'https://direct.paylane.com/rest';

    /**
     * @var int
     */
    public $statusCode = 0;

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
     * @return AbstractRequest
     */
    public function setIp($value)
    {
        return $this->setParameter('ip', $value);
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
     * @return AbstractRequest
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
     * @return AbstractRequest
     */
    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    /**
     * @return mixed
     */
    public function getVerificationCode()
    {
        return $this->getParameter('verificationCode');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setVerificationCode($value)
    {
        return $this->setParameter('verificationCode', $value);
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
     * @return AbstractRequest
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     * @return mixed
     */
    public function getId3DSecureAuth()
    {
        return $this->getParameter('id_3dsecure_auth');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setId3DSecureAuth($value)
    {
        return $this->setParameter('id_3dsecure_auth', $value);
    }

    /**
     * @return mixed|string
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * @param string|null $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    /**
     * @return mixed|string
     */
    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    /**
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->getParameter('description');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->getParameter('name');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getParameter('email');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return mixed
     */
    public function getStreetHouse()
    {
        return $this->getParameter('street_house');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setStreetHouse($value)
    {
        return $this->setParameter('street_house', $value);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->getParameter('city');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setCity($value)
    {
        return $this->setParameter('city', $value);
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->getParameter('zip');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setZip($value)
    {
        return $this->setParameter('zip', $value);
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->getParameter('country_code');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setCountryCode($value)
    {
        return $this->setParameter('country_code', $value);
    }

    /**
     * @return mixed
     */
    public function getIdSecureAuth()
    {
        return $this->getParameter('id_secure_auth');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setIdSecureAuth($value)
    {
        return $this->setParameter('id_secure_auth', $value);
    }

    /**
     * @return mixed
     */
    public function getIdSale()
    {
        return $this->getParameter('id_sale');
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setIdSale($value)
    {
        return $this->setParameter('id_sale', $value);
    }

    /**
     * @return mixed|string
     */
    public function getReturnUrl()
    {
        return $this->getParameter('back_url');
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('back_url', $value);
    }

    /**
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|AbstractRequest
     */
    public function setTransactionId($value)
    {
        return $this->setParameter('transactionId', $value);
    }

    /**
     * @return mixed|string
     */
    public function getTransactionId()
    {
        return $this->getParameter('transactionId');
    }

    /**
     * @return mixed|string
     */
    public function getRequestMethod()
    {
        $method = $this->getParameter('request_method');

        return ($method) ? $method : 'POST';
    }

    /**
     * @param $value
     *
     * @return AbstractRequest
     */
    public function setRequestMethod($value)
    {
        return $this->setParameter('request_method', $value);
    }

    public function getAction()
    {
    }

    /**
     * @return mixed|\Omnipay\Common\CreditCard
     */
    public function getCard()
    {
        return $this->getParameter('card');
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = [
            'Content-type' => 'application/json',
        ];

        return $headers;
    }

    /**
     * @param mixed $data
     *
     * @return \Omnipay\Common\Message\ResponseInterface|Response
     */
    public function sendData($data)
    {
        $headers = array_merge(
            $this->getHeaders(),
            ['Authorization' => 'Basic '.base64_encode($this->getApiKey().':'.$this->getApiPassword())]
        );

        $httpResponse = $this->httpClient->request($this->getRequestMethod(), $this->getEndpoint(), $headers, json_encode($data));
        $responseBody = json_decode($httpResponse->getBody()->getContents(), true);

        if (isset($responseBody['error']['error_number']) && $responseBody['error']['error_number'] == 720) {
            $httpResponse = $this->httpClient->request($this->getRequestMethod(), $this->getEndpointUrl().'/cards/sale', $headers, json_encode($data));
            $responseBody = json_decode($httpResponse->getBody()->getContents(), true);
        }

        if (empty($responseBody)) {
            $this->statusCode = $httpResponse->getStatusCode();
        }

        return $this->createResponse($responseBody, $httpResponse->getHeaders());
    }

    /**
     * @param $data
     * @param array $headers
     *
     * @return Response
     */
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

    /**
     * @return string
     */
    protected function getEndpointUrl()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
