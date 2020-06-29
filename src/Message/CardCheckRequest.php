<?php
namespace Omnipay\Paylane\Message;

/**
 * Class CardCheckRequest
 * @package Omnipay\Paylane\Message
 */
class CardCheckRequest extends AbstractRequest
{

    /**
     * @return mixed
     */
    public function getData()
    {
        $data['card_number'] = $this->getCard()->getNumber();
        return $data;
    }

    /**
     * @return string
     */
    protected function getEndpoint() {

        $this->setRequestMethod('GET');

        return $this->getEndpointUrl().'/cards/check';
    }
}