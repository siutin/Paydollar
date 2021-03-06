<?php

namespace Kayue\Paydollar\ServerSideDirectConnection\Tests\Functional;

use Buzz\Client\Curl;
use Kayue\Paydollar\ServerSideDirectConnection\Api;
use Kayue\Paydollar\Model\PaymentDetails;
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
        $instruction->setOrderRef(uniqid());
        $instruction->setAmount('1.00');
        $instruction->setCurrCode(840);
        $instruction->setLang('E');
        $instruction->setPMethod(Api::CREDITCARDTYPE_VISA);
        $instruction->setEpMonth('07');
        $instruction->setEpYear('2015');
        $instruction->setCardNo('4918914107195005');
        $instruction->setSecurityCode('123');
        $instruction->setCardHolder('Someone');
        $instruction->setSuccessUrl('http://google.com');
        $instruction->setFailUrl('http://google.com');
        $instruction->setErrorUrl('http://google.com');
        $instruction->setPayType(Api::PAYMENTTYPE_NORMAL);

        $captureRequest = new CaptureRequest($instruction);
        $payment->execute($captureRequest);
    }
}