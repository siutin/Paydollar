<?php

namespace Kayue\Paydollar\ServerSideDirectConnection\Tests\Functional;

use Buzz\Client\Curl;
use Kayue\Paydollar\ServerSideDirectConnection\Api;
use Kayue\Paydollar\ServerSideDirectConnection\Model\PaymentDetails;
use Kayue\Paydollar\ServerSideDirectConnection\PaymentFactory;
use Payum\Request\CaptureRequest;

class ExecuteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testVisa()
    {
        //@testo:start
        $payment = PaymentFactory::create(new Api(new Curl, array(
            'merchantId' => $GLOBALS['__KAYUE_PAYDOLLAR_MERCHANT_ID'],
            'sandbox' => true
        )));

        $instruction = new PaymentDetails();
        $instruction->setOrderRef('HBS-1234-5678');
        $instruction->setAmount('1.00');
        $instruction->setCurrCode(840);
        $instruction->setLang('E');
        $instruction->setMerchantId($GLOBALS['__KAYUE_PAYDOLLAR_MERCHANT_ID']);
        $instruction->setPMethod('VISA');
        $instruction->setEpMonth('07');
        $instruction->setEpYear('2015');
        $instruction->setCardNo('4918914107195005');
        $instruction->setSecurityCode('123');
        $instruction->setCardHolder('Someone');
        $instruction->setSuccessUrl('http://google.com');
        $instruction->setFailUrl('http://google.com');
        $instruction->setErrorUrl('http://google.com');
        $instruction->setPayType('N');

        $captureRequest = new CaptureRequest($instruction);
        $payment->execute($captureRequest);

        $this->markTestIncomplete('Nothing here at the moemnt.');
    }
}