<?php
namespace Omnipay\Paylane\Message;

use Omnipay\Tests\TestCase;

class CardCheckRequestTest extends TestCase
{
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
}