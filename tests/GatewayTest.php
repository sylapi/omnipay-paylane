<?php

namespace Omnipay\Paylane;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    protected $gateway;
    public $options;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'amount' => '10.00',
            'card'   => new CreditCard([
                'firstName'   => 'Example',
                'lastName'    => 'User',
                'number'      => '4111111111111111',
                'expiryMonth' => '12',
                'expiryYear'  => date('Y'),
                'cvv'         => '123',
            ]),
        ];
    }

    public function testAuthorize()
    {
        $options = [
            'card' => [
                'number' => '12345678900',
            ],
        ];
        $request = $this->gateway->authorize($options);

        $this->assertInstanceOf('\Omnipay\Paylane\Message\CardCheckRequest', $request);
        $this->assertSame('12345678900', $request->getCard()->getNumber());
    }

    public function authorizeSuccess()
    {
        $this->setMockHttpResponse('AuthorizeSuccess.txt');

        $response = $this->gateway->authorize($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
        $this->assertSame('VISA', $response->getData()['card_type']);
    }

    public function authorizeFailure()
    {
        $this->setMockHttpResponse('AutorizeFailure.txt');

        $response = $this->gateway->authorize($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNotNull($response->getMessage());
        $this->assertSame('411', $response->getCode());
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertNotNull($response->getMessage());
    }

    public function testCompletePurchaseSuccess()
    {
        $this->setMockHttpResponse('CompletePurchaseSuccess.txt');

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
        $this->assertSame('123456789', $response->getTransactionReference());
    }

    public function testCompletePurchaseFailure()
    {
        $this->setMockHttpResponse('CompletePurchaseFailure.txt');

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertNotNull($response->getMessage());
        $this->assertSame('723', $response->getCode());
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
