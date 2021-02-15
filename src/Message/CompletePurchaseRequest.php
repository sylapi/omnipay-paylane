<?php

namespace Omnipay\Paylane\Message;

/**
 * Class CompletePurchaseRequest.
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    /**
     * @var
     */
    private $data;

    /**
     * @return array|mixed
     */
    public function getData()
    {
        $this->data = [
            'id_3dsecure_auth' => $this->httpRequest->request->get('id_3dsecure_auth'),
        ];

        return $this->data;
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        if ($this->httpRequest->request->get('status') == 'SUCCESS') {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        if (!$this->isSuccessful()) {
            return $this->httpRequest->request->get('error_text');
        } else {
            return $this->httpRequest->request->get('description');
        }
    }

    /**
     * @return int|mixed
     */
    public function getCode()
    {
        if (!$this->isSuccessful()) {
            $code = $this->httpRequest->request->get('error_code');
            if ($code) {
                return $code;
            }

            return $this->httpRequest->request->get('status');
        }

        return 0;
    }

    /**
     * @return string
     */
    protected function getEndpoint()
    {
        $this->setRequestMethod('POST');

        return $this->getEndpointUrl().'/3DSecure/authSale';
    }
}
