<?php

namespace Omnipay\Paylane\Message;

/**
 * Class SaleBySecureAuthorizationRequest.
 */
class SaleBySecureAuthorizationRequest extends AbstractRequest
{
    /**
     * @return array|mixed
     */
    public function getData()
    {
        $data = [];
        $data['id_3dsecure_auth'] = $this->getIdSecureAuth();

        return $data;
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
