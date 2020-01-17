<?php

namespace Omnipay\Paylane\Message;

class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        print_r($_POST);

        $data = [
            'id_3dsecure_auth' => $this->httpRequest->request->get('id_3dsecure_auth')
        ];

        return $data;
    }

    protected function getEndpoint() {

        $this->setRequestMethod('POST');

        return $this->getEndpointUrl().'/3DSecure/authSale';
    }
}
