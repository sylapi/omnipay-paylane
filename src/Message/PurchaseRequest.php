<?php

/**
 * Paylane Purchase Request.
 */
namespace Omnipay\Paylane\Message;


class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount');
        $card_data = $this->getCard();

        $data = [];

        $data['sale'] = array(
            'amount' => (float)$this->getAmount(),
            'currency' => $this->getCurrency(),
            'description' => $this->getDescription(),
        );

        if ($card_data) {
            $customer = array(
                'name' => $this->getName(),
                'email' => $card_data->getEmail(),
                'ip' => $this->getIp()
            );
        }

        $address = array(
            'street_house' => $this->getStreetHouse(),
            'city' => $this->getCity(),
            'zip' => $this->getZip(),
            'country_code' => $this->getCountryCode(),
        );


        if ($card_data) {
            $card = array(
                'card_number' => (string)$card_data->getNumber(),
                'expiration_month' => $card_data->getExpiryMonth(),
                'expiration_year' => $card_data->getExpiryYear(),
                'name_on_card' => $card_data->getFirstName(),
                'card_code' => $card_data->getCvv()
            );
        }

        if (!empty($customer)) {
            foreach ($customer as $key => $value) {
                if ($value != '') {
                    $data['customer'][$key] = $value;
                }
            }
        }

        if (!empty($address)) {
            foreach ($address as $key => $value) {
                if ($value != '') {
                    $data['customer']['address'][$key] = $value;
                }
            }
        }

        if (!empty($card)) {
            foreach ($card as $key => $value) {
                if ($value != '') {

                    if ($key == 'expiration_month' && $value < 10) {
                        $value = '0' . (int)$value;
                    }

                    $data['card'][$key] = $value;
                }
            }
        }

        $data['back_url'] = $this->getReturnUrl();

        return $data;
    }

    protected function getEndpoint() {

        $this->setRequestMethod('POST');

        return $this->getEndpointUrl().'/3DSecure/checkCard';
    }
}
