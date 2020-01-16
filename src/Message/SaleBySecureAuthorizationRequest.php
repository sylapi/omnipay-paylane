<?php

namespace Omnipay\Paylane\Message;

/**
 * Paylane Purchase Request.
 */
class SaleBySecureAuthorizationRequest extends AbstractRequest
{
    public function getData()
    {
        $data = [];
        $data['id_3dsecure_auth'] = $this->getIdSecureAuth();
        return $data;
    }

    protected function getEndpoint() {

        $this->setRequestMethod('POST');

        return $this->getEndpointUrl().'/3DSecure/authSale';
    }
}