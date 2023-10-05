<?php

$data = array(
    'username' => 'your_u`sername',
    'password' => 'your_password'
);


$data_string = json_encode($data);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/authentication/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data_string, // Set the request body
    CURLOPT_HTTPHEADER => array(
        'x-client-id: 9S98GduITJurYQKTQW88ww',
        'x-api-key: 202c8d5111e0a6a9c21ab287fc81d0b09ad19788bfebfa74d737e1cd8aa54bb220ac2acae006b9e5d153c226c9fbc3a5',
        'Content-Type: application/json', // Set the content type
        'Content-Length: ' . strlen($data_string) // Set the Content-Length header
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$token = json_decode($response,true);

$getToken = $token['token'];

$getToken; // bearer token

/**
 * Create Customer Api.
 */

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/customers/create',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "request_id": "be30ebcf-5307-45b2-80d6a-da0sezsc",
    "merchant_customer_id": "merchant_dbbcf-5307-45sb2-80d6a-daaesc",
    "first_name": "Yadira",
    "last_name": "Schinner",
    "email": "Alfonzo91@example.org",
    "phone_number": "443-953-9234"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $getToken,
  ),
));

$responseCustomer = curl_exec($curl);

curl_close($curl);

$cust = json_decode($responseCustomer,true);

// echo "<pre>";
// print_r($cust);
// die;

$customerId = "cus_hkdmppgswgpbweffplk"; // get custId

/**
 * Create payment intent Api.
 */

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_intents/create',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "request_id": "5b26118f-fc21-4504-8s0da-4d65t46",
    "customer_id": "'.$customerId.'",
    "amount": 1000,
    "currency": "AUD",
    "merchant_order_id": "Merchant_Order_d9fs44b9b-3583-4441-a8sf3-30xxx962",
    "return_url": "https://allan.biz"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $getToken,
  ),
));

$responsePayIntent = curl_exec($curl);

curl_close($curl);

$paymentIntent = json_decode($responsePayIntent,true);

// echo "<pre>";
// print_r($paymentIntent);
// die;

$intentId = $paymentIntent['id']; // get paymentIntent_id.

/**
 * Create Confirm Payment intent Api.
 */

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_intents/'.$intentId.'/confirm',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "customer_id": "'.$customerId.'",
  "device_data": {
    "accept_header": "*/*",
    "browser": {
      "java_enabled": false,
      "javascript_enabled": true,
      "user_agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36"
    },
    "device_id": "00000000-000000000000000",
    "language": "EN or en-US",
    "location": {
      "lat": "-37.81892",
      "lon": "144.95913"
    },
    "mobile": {
      "device_model": "Apple IPHONE 7",
      "os_type": "IOS or ANDROID",
      "os_version": "IOS 14.5"
    },
    "screen_color_depth": 24,
    "screen_height": 1080,
    "screen_width": 1920,
    "timezone": "-2 or 3:30"
  },
  "external_recurring_data": {
    "merchant_trigger_reason": "scheduled",
    "triggered_by": "merchant"
  },
  "payment_method": {
    "ach_direct_debit": {
      "aba_routing_number": "123456789",
      "account_number": "1234567890",
      "business_account": false,
      "mandate_version": "1",
      "owner_email": "john.doe@gmail.com",
      "owner_name": "John Doe"
    },
    "alfamart": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "alipaycn": {
      "flow": "webqr",
      "os_type": "android"
    },
    "alipayhk": {
      "flow": "webqr",
      "os_type": "android"
    },
    "applepay": {
      "billing": {
        "address": {
          "city": "Shanghai",
          "country_code": "CN",
          "postcode": "100000",
          "state": "Shanghai",
          "street": "Pudong District"
        },
        "date_of_birth": "2011-10-23",
        "email": "john.doe@airwallex.com",
        "first_name": "John",
        "last_name": "Doe",
        "phone_number": "13800000000"
      },
      "encrypted_payment_token": "string",
      "payment_data_type": "encrypted_payment_token",
      "tokenized_card": {
        "authentication_method": {
          "emv": {
            "emv_data": "string",
            "encrypted_pin_data": "string"
          },
          "three_ds": {
            "eci_indicator": "string",
            "online_payment_cryptogram": "string"
          },
          "type": "string"
        },
        "device_manufacturer_identifier": "050110030222",
        "expiry_month": "12",
        "expiry_year": "2030",
        "name": "John Doe",
        "number": "4035501000000008"
      }
    },
    "atome": {
      "shopper_phone": "+6587654321"
    },
    "axs_kiosk": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "bacs_direct_debit": {
      "account_number": "12345678",
      "address": {
        "line1": "777 Casino Drive",
        "line2": "Apartment 123",
        "postcode": "A11 B12",
        "town": "LONDON"
      },
      "bank_name": "revolut",
      "mandate_version": "1",
      "owner_email": "john.doe@gmail.com",
      "owner_name": "John Doe",
      "sort_code": "123456"
    },
    "bancontact": {
      "shopper_name": "Alex Wang"
    },
    "bank_transfer": {
      "bank_name": "mandiri",
      "country_code": "ID",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "becs_direct_debit": {
      "account_number": "1234567890",
      "bsb_number": "123456",
      "mandate_version": "1",
      "owner_email": "john.doe@gmail.com",
      "owner_name": "John Doe"
    },
    "bitpay": {
      "country_code": "ID",
      "shopper_name": "Alex Wang"
    },
    "blik": {
      "shopper_name": "Alex Wang"
    },
    "boost": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "card": {
      "additional_info": {
        "merchant_verification_value": "A52BD7",
        "token_requestor_id": "50272768100"
      },
      "billing": {
        "address": {
          "city": "Shanghai",
          "country_code": "CN",
          "postcode": "100000",
          "state": "Shanghai",
          "street": "Pudong District"
        },
        "date_of_birth": "2011-10-23",
        "email": "john.doe@airwallex.com",
        "first_name": "John",
        "last_name": "Doe",
        "phone_number": "13800000000"
      },
      "cvc": "123",
      "expiry_month": "12",
      "expiry_year": "2030",
      "name": "John Doe",
      "number": "4035501000000008",
      "number_type": "PAN"
    },
    "dana": {
      "flow": "webqr",
      "os_type": "android"
    },
    "doku_ewallet": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "dragonpay": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "duit_now": {
      "shopper_name": "Alex Wang"
    },
    "enets": {
      "bank_name": "krungsri_bank",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "eps": {
      "shopper_name": "Alex Wang"
    },
    "esun": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "family_mart": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "fps": {
      "flow": "webqr"
    },
    "fpx": {
      "bank_name": "affin",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "gcash": {
      "flow": "webqr",
      "os_type": "android"
    },
    "giropay": {
      "shopper_name": "Alex Wang"
    },
    "go_pay": {
      "shopper_name": "Alex Wang"
    },
    "googlepay": {
      "billing": {
        "address": {
          "city": "Shanghai",
          "country_code": "CN",
          "postcode": "100000",
          "state": "Shanghai",
          "street": "Pudong District"
        },
        "date_of_birth": "2011-10-23",
        "email": "john.doe@airwallex.com",
        "first_name": "John",
        "last_name": "Doe",
        "phone_number": "13800000000"
      },
      "encrypted_payment_token": "string",
      "payment_data_type": "encrypted_payment_token",
      "tokenized_card": {
        "authentication_method": {
          "emv": {
            "emv_data": "string",
            "encrypted_pin_data": "string"
          },
          "three_ds": {
            "eci_indicator": "string",
            "online_payment_cryptogram": "string"
          },
          "type": "string"
        },
        "device_manufacturer_identifier": "050110030222",
        "expiry_month": "12",
        "expiry_year": "2030",
        "name": "John Doe",
        "number": "4035501000000008"
      }
    },
    "grabpay": {
      "shopper_name": "Alex Wang"
    },
    "hi_life": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "ideal": {
      "bank_name": "rabobank",
      "shopper_name": "Alex Wang"
    },
    "indomaret": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "jenius_pay": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "kakaopay": {
      "flow": "webqr",
      "os_type": "android"
    },
    "klarna": {
      "billing": {
        "address": {
          "city": "Shanghai",
          "country_code": "CN",
          "postcode": "100000",
          "state": "Shanghai",
          "street": "Pudong District"
        },
        "date_of_birth": "2011-10-23",
        "email": "john.doe@airwallex.com",
        "first_name": "John",
        "last_name": "Doe",
        "phone_number": "13800000000"
      },
      "country_code": "US",
      "language": "en"
    },
    "konbini": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "linkaja": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "maxima": {
      "shopper_name": "Alex Wang"
    },
    "multibanco": {
      "shopper_name": "Alex Wang"
    },
    "mybank": {
      "shopper_name": "Alex Wang"
    },
    "narvesen": {
      "shopper_name": "Alex Wang"
    },
    "online_banking": {
      "bank_name": "krungsri",
      "country_code": "TH",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "ovo": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "p24": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "pay_now": {
      "shopper_name": "Alex Wang"
    },
    "paybybankapp": {
      "shopper_name": "Alex Wang"
    },
    "payeasy": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "04501582125"
    },
    "paypal": {
      "country_code": "ID",
      "shopper_name": "Alex Wang"
    },
    "paypost": {
      "shopper_name": "Alex Wang"
    },
    "paysafecard": {
      "country_code": "NL",
      "shopper_name": "Alex Wang"
    },
    "paysafecash": {
      "country_code": "NL",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "paysera": {
      "bank_name": "citadele",
      "country_code": "NL",
      "shopper_name": "Alex Wang"
    },
    "payu": {
      "shopper_name": "Alex Wang"
    },
    "perlas_terminals": {
      "shopper_name": "Alex Wang"
    },
    "prompt_pay": {
      "shopper_name": "Alex Wang"
    },
    "rabbit_line_pay": {
      "flow": "webqr",
      "os_type": "android"
    },
    "sam_kiosk": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "satispay": {
      "country_code": "IT",
      "shopper_name": "Alex Wang"
    },
    "sepa_direct_debit": {
      "bank_name": "revolut",
      "country_code": "DE",
      "iban": "DE123456789012345",
      "mandate_version": "1",
      "owner_email": "john.doe@gmail.com",
      "owner_name": "John Doe"
    },
    "seven_eleven": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "shopee_pay": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "skrill": {
      "country_code": "MY",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "sofort": {
      "country_code": "NL",
      "shopper_name": "Alex Wang"
    },
    "tesco_lotus": {
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang",
      "shopper_phone": "045015821254"
    },
    "tng": {
      "flow": "webqr",
      "os_type": "android"
    },
    "truemoney": {
      "flow": "webqr",
      "os_type": "android"
    },
    "trustly": {
      "country_code": "NL",
      "shopper_name": "Alex Wang"
    },
    "type": "card",
    "verkkopankki": {
      "bank_name": "aktia",
      "shopper_email": "somebody@airwallex.com",
      "shopper_name": "Alex Wang"
    },
    "wechatpay": {
      "flow": "webqr",
      "ip_address": "192.168.0.1",
      "open_id": "oeTcWwyQ0TnCAZvjj8ltcNigWnBI"
    }
  },
  "payment_method_options": {
    "card": {
      "authorization_type": "final_auth",
      "auto_capture": true,
      "cryptogram": "AgAAAAAAPRpgCwAAmdDBgskAAAA=",
      "three_ds": {
        "acs_response": "threeDSMethodData=eyJ0aH...",
        "device_data_collection_res": "Standard JWT",
        "ds_transaction_id": "Y2FyZGluYWxjb21tZXJjZWF1dGg=",
        "return_url": "https://www.example.com/3ds-result"
      }
    },
    "klarna": {
      "auto_capture": true
    },
    "wechatpay": {
      "enable_funds_split": false
    }
  },
  "request_id": "ee939540-3203-4a2c-9172-8d3h34g4dh",
  "return_url": "https://www.example.com/3ds-result"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $getToken,
  ),
));

$responseCon = curl_exec($curl);

curl_close($curl);

$paymentIntentCon = json_decode($responseCon,true);

echo "<pre>";
print_r($paymentIntentCon);
die;