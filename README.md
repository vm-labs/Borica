# Borica

This is implementation of the BORICA API for adding payments with their service.
EMV 3DS protocol.

### Content

* [Installetion](#)
* [Configuration](#)
* [Usage](#)
* [Credit cards](#)
* [Response codes ISO_8583](#)
* [APGW response codes](#)

### Installation

Install using composer:

```shell
composer require vm-labs/borica
```

### Configuration

```yaml

# config/packages/borica.yaml

borica_api:
    test_url: # default https://3dsgate-dev.borica.bg/cgi-bin/cgi_link 
    prod_url: # default https://3dsgate.borica.bg/cgi-bin/cgi_link

    profiles:
        config_1:
            backref_url: https://localhost/borica/response
            terminal_id: # terminal id
            private_key: # path to private key
            private_key_password: # private key password
            public_key: # path to public key
            merchant: 1600000001
            merchant_name: 'Payment'
            merchant_url: 'https://localhost'
            extended_mac: false # default true
        config_2: # optional
            terminal_id: # terminal id
            ...

```

### Usage

Currently possible requests are - payment, cancellation and status of transaction.

The communication and transmission of parameters is done through HTML forms and HTTP post to the e-Commerce CGI server of BORICA. So with the current implementation you can check if the data is valid or take the form for a specific transaction.


#### Payment request

```php

use Borica\Entity\Request as BoricaRequest;
use Borica\Manager\RequestManager;

class PaymentController extends AbstractController
{
    public function __invoke(RequestManager $requestManager)
    {
        $request = new BoricaRequest();
        $request->setAmount(29);
        $request->setDescription('Payment details.');

        # You can check that the data is valid or pick up the list of errors before submitting the form.
        if (!$paymentRequest->isValidData()) {
            $errorList = $paymentRequest->getErrorList();
            // ...
        }

        $paymentRequest = $requestManager->payment($request, 'config_1'); // the second argument is required if you have more than one configuration

        return $this->render('payment-details.html.twig', [
            'form' => $paymentRequest->getForm()->createView(),
        ]);
    }
}

```

#### Response

```php

use Borica\Manager\ResponseManager;

class PaymentResponseController extends AbstractController
{
    public function __invoke(ResponseManager $responseManager)
    {
        $boricaResponse = $this->responseManager->response();

        # Verification of the signature in response from APGW
        if (!$boricaResponse->isValid()) {
            // ...
        }

        # Check if the borica response is completed successfully.
        if (!$boricaResponse->isSuccessful()) {
            $responseCode = $boricaResponse->getResponseCode();
            // ...
        }

        $response = $boricaResponse->getData();
        $orderId = $response->getOrderId();
        // ...
    }
}

```

#### Status

```php

use Borica\Entity\Request as BoricaRequest;
use Borica\Manager\RequestManager;

class StatusRequestController extends AbstractController
{
    public function __invoke(RequestManager $requestManager)
    {
        $request = new BoricaRequest();
        $request->setOrder($order);

        $statusRequest = $requestManager->status($request);

        if (!$paymentRequest->isValidData()) {
            $errorList = $paymentRequest()->getErrorList();
            // ...
        }

        $boricaResponse = $statusRequest->request();

        if ($boricaResponse->isValid()) {
            // ...
        }

        if ($boricaResponse->isSuccessful()) {
            // ...
        }
    }
}

```

### Credit cards

 Card number      | Response code        | 3DS password
------------------|:--------------------:|-------------:
 5100770000000022 | **00**               | -
 4341792000000044 | **00**               | 111111
 5555000000070019 | **04**               | -
 5555000000070027 | **13**               | -
 5555000000070035 | **91**               | -
 4010119999999897 | **amount dependant** | -
 5100789999999895 | **amount dependant** | 111111

##### Amount dependant

  Amount             | Response code | Description 
--------------------:|:-------------:|-------------
 1,00 - 1,99         | **01**        | Refer to card issuer
 2,00 - 2,99         | **04**        | Pick up
 3,00 - 3,99         | **05**        | Do not honour
 4,00 - 4,99         | **13**        | Invalid amount
 5,00 - 5,99         | **30**        | Format error
 6,00 - 6,99         | **91**        | Issuer or switch is inoperative
 7,00 - 7,99         | **96**        | System Malfunction
 8,00 - 8,99         | **-**         | Timeout
 30,00 - 40,00       | **01**        | Refer to card issuer
 50,00 - 70,00       | **04**        | Pick up
 80,00 - 90,00       | **05**        | Do not Honour
 100,00 - 110,00     | **13**        | Invalid amount
 120,00 - 130,00     | **30**        | Format error
 140,00 - 150,00     | **91**        | Issuer or switch is inoperative
 160,00 - 170,00     | **96**        | System Malfunction
 180,00 - 190,00     | **-**         | Timeout
 10000,65 - 10000,65 | **65/1A**     | Soft Decline

### Response codes 
###### [ISO_8583](https://en.wikipedia.org/wiki/ISO_8583)

 Response Code | Description
:-------------:|-------------
 **00**        | Successfully completed
 **01**        | Refer to card issuer
 **04**        | Pick Up
 **05**        | Do not Honour
 **06**        | Error
 **12**        | Invalid transaction
 **13**        | Invalid amount
 **14**        | No such card
 **15**        | No such issuer
 **17**        | Customer cancellation
 **30**        | Format error
 **35**        | Pick up, card acception contact acquirer
 **36**        | Pick up, card restricted
 **37**        | Pick up, call acquirer security
 **38**        | Pick up, allowable PIN tries exceeded
 **39**        | No credit account
 **40**        | Requested function not supported
 **41**        | Pick up, lost card
 **42**        | No universal account
 **43**        | Pick up, stolen card
 **54**        | Expired card / target
 **55**        | Incorrect PIN
 **56**        | No card record
 **57**        | Transaction not permitted to cardholder
 **58**        | Transaction not permitted to terminal
 **59**        | Suspected fraud
 **85**        | No reason to decline
 **88**        | Cryptographic failure
 **89**        | Authentication failure
 **91**        | Issuer or switch is inoperative
 **95**        | Reconscile error / auth not found
 **96**        | System malfunction

### APGW response codes

 Response Code | Descriptioin
:-------------:|--------------
 **-1**        | A mandatory request field is not filled in
 **-2**        | CGI request validation failed
 **-3**        | Acquirer host (TS) does not respond or wrong format of e-gateway response template file
 **-4**        | No connection to the acquirer host (TS)
 **-5**        | The acquirer host (TS) connection failed during transaction processing
 **-6**        | e-Gateway configuration error
 **-7**        | The acquirer host (TS) response is invalid, e.g. mandatory fields missing
 **-8**        | Error in the "Card number" request field
 **-9**        | Error in the "Card expiration date" request field
 **-10**       | Error in the "Amount" request field
 **-11**       | Error in the "Currency" request field
 **-12**       | Error in the "Merchant ID" request field
 **-13**       | The referrer IP address (usually the merchant's IP) is not the one expected
 **-14**       | No connection to the internet terminal PIN pad or agent program is not running on the internet terminal computer/workstation
 **-15**       | Error in the "RRN" request field
 **-16**       | Another transaction is being performed on the terminal
 **-17**       | The terminal is denied access to e-Gateway
 **-18**       | Error in the CVC2 or CVC2 Description request fields
 **-19**       | Error in the authentication information request or authentication failed
 **-20**       | The permitted time interval (1 hour by default) between the transaction timestamp request field and the e-Gateway time was exceeded
 **-21**       | The transaction has already been executed
 **-22**       | Transaction contains invalid authentication information
 **-23**       | Invalid transaction context
 **-24**       | Transaction context data mismatch
 **-25**       | Transaction canceled (e.g. by user)
 **-26**       | Invalid action BIN
 **-27**       | Invalid merchant name
 **-28**       | Invalid incoming addendum(s)
 **-29**       | Invalid/duplicate authentication reference
 **-30**       | Transaction was declined as fraud
 **-31**       | Transaction already in progress
 **-32**       | Duplicate declined transaction
 **-33**       | Customer authentication by random amount or verify one-time code in progress
 **-34**       | Mastercard Installment customer choice in progress
 **-35**       | Mastercard Installments auto canceled
 **-36**       | Mastercard Installment user canceled
