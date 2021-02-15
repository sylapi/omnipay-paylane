<?php

namespace Omnipay\Paylane\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Class CreditCardRequest.
 */
class CreditCardRequest extends AbstractRequest
{
    /**
     * @throws \Omnipay\Common\Exception\InvalidCreditCardException
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     *
     * @return array|mixed
     */
    public function getData()
    {
        $this->validate('amount', 'card');

        $this->getCard()->validate();

        return ['amount' => $this->getAmount()];
    }

    /**
     * @param mixed $data
     *
     * @return ResponseInterface|Response
     */
    public function sendData($data)
    {
        $data['reference'] = uniqid();
        $data['success'] = 0 === substr($this->getCard()->getNumber(), -1, 1) % 2;
        $data['message'] = $data['success'] ? 'Success' : 'Failure';

        return $this->response = new Response($this, $data);
    }
}
