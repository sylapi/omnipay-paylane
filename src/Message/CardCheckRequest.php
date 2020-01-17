<?php
namespace Omnipay\Paylane\Message;

/**
 * Paylane Purchase Request.
 */
class CardCheckRequest extends AbstractRequest
{

    public function getData()
    {
        $data['card_number'] = $this->getCard()->getNumber();
        return $data;
    }

    protected function getEndpoint() {

        $this->setRequestMethod('GET');

        return $this->getEndpointUrl().'/cards/check';
    }
}