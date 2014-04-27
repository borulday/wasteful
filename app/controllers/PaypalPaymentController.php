<?php

class PaypalPaymentController extends \BaseController {

    /**
     * object to authenticate the call.
     * @param object $_apiContext
     */
    private $_apiContext;

    private $_cred;
    
    // private $_cred;

    /**
     * Set the ClientId and the ClientSecret.
     * @param 
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId='AZTj8BDH6KyWNjAxPIMF-RvowFTi2zY-JIFIsApdMzYZqkriLWn0IU4Q5dhl';
    private $_ClientSecret='EOjfuRAFsn1xjaj3lihWYm54g77CGfBIS-2N7IC5z8P5I142t9FkM_jEJC2F';

    /*
     *   These construct set the SDK configuration dynamiclly, 
     *   If you want to pick your configuration from the sdk_config.ini file
     *   make sure to update you configuration there then grape the credentials using this code :
     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct() {
    	$wfb = Session::get('wfb');
		$user = Session::get('user');
		
		if(!isset($wfb['user_profile']['id']) || !isset($user['token'])) return Redirect::to('/');

    	// $this->_cred= Paypalpayment::OAuthTokenCredential($this->_ClientId, $this->_ClientSecret);
    	// Log::info('cred:', $this->_cred);

        ### Api Context
        // Pass in a `ApiContext` object to authenticate 
        // the call. You can also send a unique request id 
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly. 

        $this->_apiContext = Paypalpayment:: ApiContext(
            Paypalpayment::OAuthTokenCredential(
                $this->_ClientId,
                $this->_ClientSecret
            )
        );

        // dynamic configuration instead of using sdk_config.ini

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => __DIR__.'/../storage/logs/PayPal.log',
            'log.LogLevel' => 'FINE'
        ));

    }


	/*
     * Create payment using credit card
     * url:payment/create
    */
    public function create($pay) {
        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $addr= Paypalpayment::Address();
        $addr->setLine1("3909 Witmer Road");
        $addr->setLine2("Niagara Falls");
        $addr->setCity("Niagara Falls");
        $addr->setState("NY");
        $addr->setPostal_code("14305");
        $addr->setCountry_code("US");
        $addr->setPhone("716-298-1822");

        // ### CreditCard
        // A resource representing a credit card that can be
        // used to fund a payment.
        $card = Paypalpayment::CreditCard();
        $card->setType("visa");
        $card->setNumber("4417119669820331");
        $card->setExpire_month("11");
        $card->setExpire_year("2019");
        $card->setCvv2("012");
        $card->setFirst_name("Anouar");
        $card->setLast_name("Abdessalam");
        $card->setBilling_address($addr);

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::FundingInstrument();
        $fi->setCredit_card($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::Payer();
        $payer->setPayment_method("credit_card");
        $payer->setFunding_instruments(array($fi));

        // ### Amount
        // Let's you specify a payment amount.
        $amount = Paypalpayment:: Amount();
        $amount->setCurrency("USD");
        $amount->setTotal("1.00");

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types
        $transaction = Paypalpayment:: Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription("I am so sorry! Because I damaged the nature.");

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'
        $payment = Paypalpayment:: Payment();
        $payment->setIntent("sale");
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));

        // ### Create Payment
        // Create a payment by posting to the APIService
        // using a valid ApiContext
        // The return object contains the status;
        try {
            $payment->create($this->_apiContext);
        } catch (\PPConnectionException $ex) {
        	Log::info($ex->getMessage());
            // return "Exception: " . $ex->getMessage() . PHP_EOL;
            // var_dump($ex->getData());
            return Redirect::to('/');
            exit(1);
        }

        // $response = $payment->toArray();
        // echo"<pre>";
        // print_r($response);

        // var_dump($payment->getId());
        // var_dump($payment->getState());

        //print_r($payment->toArray());//$payment->toJson();
        return Redirect::to('/payment/info/'.urlencode($payment->getId()).'/'.$pay );
    } 

    public function info($paymentID, $pay) {
       $payment = Paypalpayment::get(urldecode($paymentID), $this->_apiContext);

       // echo "<pre>";

       // Odeme Basarili.
       // print_r($payment);
       return View::make('payment', array('payment'=>$pay, 'paymentID'=>$payment->getId()) );
    }

}