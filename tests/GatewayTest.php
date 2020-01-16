<?php

namespace Omnipay\Paylane;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{

    protected $gateway;
    public $options;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = array(
            'amount' => '10.00',
            'card' => new CreditCard(array(
                'firstName' => 'Example',
                'lastName' => 'User',
                'number' => '4111111111111111',
                'expiryMonth' => '12',
                'expiryYear' => date('Y'),
                'cvv' => '123',
            )),
        );
    }

    public function testAuthorize()
    {
        $options = array(
            'card' => [
                'number' => '12345678900'
            ],
        );
        $request = $this->gateway->authorize($options);

        $this->assertInstanceOf('\Omnipay\Paylane\Message\CardCheckRequest', $request);
        $this->assertSame('12345678900', $request->getCard()->getNumber());
    }

    public function testPurchase()
    {
        $options = array(
            'amount' => '10.00',
            'card' => [
                'number' => '1234567890',
                'cvv' => '123',
                'expiryMonth' => '10'
            ],
            'ReturnUrl' => 'http://test.com/getReturnUrl'
        );
        $request= $this->gateway->purchase($options);

        $this->assertInstanceOf('\Omnipay\Paylane\Message\PurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
        $this->assertSame('http://test.com/getReturnUrl', $request->getReturnUrl());
        $this->assertSame('1234567890', $request->getCard()->getNumber());
        $this->assertSame('123', $request->getCard()->getCvv());
        $this->assertSame(10, $request->getCard()->getExpiryMonth());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertNotNull($response->getMessage());
    }


    public function testAuthorizeParameters()
    {
        if ($this->gateway->supportsAuthorize()) {
            foreach ($this->gateway->getDefaultParameters() as $key => $default) {
                $getter = 'get'.ucfirst($key);
                $setter = 'set'.ucfirst($key);
                $value = $this->getParameterValue($key);
                $this->gateway->$setter($value);
                $request = $this->gateway->authorize();
                $this->assertSame($value, $request->$getter());
            }
        }
    }

    public function testPurchaseParameters()
    {
        foreach ($this->gateway->getDefaultParameters() as $key => $default) {
            $getter = 'get'.ucfirst($key);
            $setter = 'set'.ucfirst($key);
            $value = $this->getParameterValue($key);
            $this->gateway->$setter($value);
            $request = $this->gateway->purchase();
            $this->assertSame($value, $request->$getter());
        }
    }
    public function testCompletePurchaseParameters()
    {
        if ($this->gateway->supportsCompletePurchase()) {
            foreach ($this->gateway->getDefaultParameters() as $key => $default) {
                $getter = 'get'.ucfirst($key);
                $setter = 'set'.ucfirst($key);
                $value = $this->getParameterValue($key);
                $this->gateway->$setter($value);
                $request = $this->gateway->completePurchase();
                $this->assertSame($value, $request->$getter());
            }
        }
    }

    protected function getParameterValue($key = '')
    {
        if ($key == 'merchantId') {
            $value = mt_rand(32767, mt_getrandmax());
        } elseif ($key == 'method') {
            $value = (rand(0, 1) ? 'POST' : 'GET');
        } else {
            $value = uniqid();
        }
        return $value;
    }

}
