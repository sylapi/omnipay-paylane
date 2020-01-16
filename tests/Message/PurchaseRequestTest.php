<?php
namespace Omnipay\Paylane\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{

    /**
     *
     * @var \Omnipay\Paylane\Message\PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'apiKey'        => 'mykey',
            'apiPassword'   => 'mypassword',
            'ip'            => '127.0.0.1',
            'language'      => 'pl',
            'amount'        => '12.00',
        ));
    }

    public function testGetData()
    {
        $this->request->initialize(array(
            'apiKey'        => 'mykey',
            'apiPassword'   => 'mypassword',
            'ip'            => '127.0.0.1',
            'language'      => 'pl',
            'amount'        => '12.00',
        ));

        $data = $this->request->getData();

        $this->assertSame("12.00", $data['amount']);
        $this->assertSame('pl', $data['language']);
        $this->assertSame('127.0.0.1', $data['ip']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\Paylane\Message\PurchaseResponse', $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertSame('https://secure.paylane.com/order/direct.html,111111,abcd1234', $response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
        $this->assertSame('tr_Qzin4iTWrU', $response->getTransactionReference());
        $this->assertTrue($response->isOpen());
        $this->assertFalse($response->isPaid());
        $this->assertNull($response->getCode());
        $this->assertNull($response->getMessage());
    }

    public function testSendFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->request->send();

        $this->assertInstanceOf('Omnipay\Paylane\Message\PurchaseResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getRedirectUrl());
        $this->assertNull($response->getRedirectData());
    }

}
