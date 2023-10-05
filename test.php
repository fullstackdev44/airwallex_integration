<?php

$data = array(
    'username' => 'your_username',
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

// create customer Api.

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
    "request_id": "be30ebcf-5307-45b2-80d6a-da0ezsc",
    "merchant_customer_id": "merchant_dbbcf-5307-45b2-80d6a-daaesc",
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

$customerId = "cus_hkdmppgswgpbw98f3co";

// create payment method.

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_methods/create',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//   "applepay": {
//     "billing": {
//       "address": {
//         "city": "Shanghai",
//         "country_code": "CN",
//         "postcode": "100000",
//         "state": "Shanghai",
//         "street": "Pudong District"
//       },
//       "date_of_birth": "2011-10-23",
//       "email": "john.doe@airwallex.com",
//       "first_name": "John",
//       "last_name": "Doe",
//       "phone_number": "13800000000"
//     },
//     "encrypted_payment_token": "string",
//     "payment_data_type": "encrypted_payment_token",
//     "tokenized_card": {
//       "authentication_method": {
//         "emv": {
//           "emv_data": "string",
//           "encrypted_pin_data": "string"
//         },
//         "three_ds": {
//           "eci_indicator": "string",
//           "online_payment_cryptogram": "string"
//         },
//         "type": "string"
//       },
//       "device_manufacturer_identifier": "050110030222",
//       "expiry_month": "12",
//       "expiry_year": "2030",
//       "name": "John Doe",
//       "number": "4035501000000008"
//     }
//   },
//   "card": {
//     "additional_info": {
//       "merchant_verification_value": "A52BD7",
//       "token_requestor_id": "50272768100"
//     },
//     "billing": {
//       "address": {
//         "city": "Shanghai",
//         "country_code": "CN",
//         "postcode": "100000",
//         "state": "Shanghai",
//         "street": "Pudong District"
//       },
//       "date_of_birth": "2011-10-23",
//       "email": "john.doe@airwallex.com",
//       "first_name": "John",
//       "last_name": "Doe",
//       "phone_number": "13800000000"
//     },
//     "cvc": "123",
//     "expiry_month": "12",
//     "expiry_year": "2030",
//     "name": "John Doe",
//     "number": "4035501000000008",
//     "number_type": "PAN"
//   },
//   "customer_id": "'.$customerId.'",
//   "googlepay": {
//     "billing": {
//       "address": {
//         "city": "Shanghai",
//         "country_code": "CN",
//         "postcode": "100000",
//         "state": "Shanghai",
//         "street": "Pudong District"
//       },
//       "date_of_birth": "2011-10-23",
//       "email": "john.doe@airwallex.com",
//       "first_name": "John",
//       "last_name": "Doe",
//       "phone_number": "13800000000"
//     },
//     "encrypted_payment_token": "string",
//     "payment_data_type": "encrypted_payment_token",
//     "tokenized_card": {
//       "authentication_method": {
//         "emv": {
//           "emv_data": "string",
//           "encrypted_pin_data": "string"
//         },
//         "three_ds": {
//           "eci_indicator": "string",
//           "online_payment_cryptogram": "string"
//         },
//         "type": "string"
//       },
//       "device_manufacturer_identifier": "050110030222",
//       "expiry_month": "12",
//       "expiry_year": "2030",
//       "name": "John Doe",
//       "number": "4035501000000008"
//     }
//   },
//   "metadata": {
//     "id": 1
//   },
//   "request_id": "ee939540-3203-4a2c-9ssd7ds2-d2",
//   "type": "card"
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Authorization: Bearer ' . $getToken,
//   ),
// ));

// $responsePaymentMethod = curl_exec($curl);

// curl_close($curl);

// $paymethod = json_decode($responsePaymentMethod,true);

// $getPay_id = $paymethod['id'];

// // create payment consent.

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_consents/create',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//     "request_id": "a76e9a04-0262-4b7a-bdsed43-asd1",
//     "customer_id": "'.$customerId.'",
//     "amount": 541,
//     "currency": "AUD",
//     "payment_method": {
//         "id": "'.$getPay_id.'",
//         "type": "card"
//     },
//     "next_triggered_by": "merchant",
//     "merchant_trigger_reason": "scheduled"
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Authorization: Bearer ' . $getToken,
//   ),
// ));

// $responseConsentPayment = curl_exec($curl);

// curl_close($curl);

// $payConsent = json_decode($responseConsentPayment,true);

// $PaymentConcent_Id = $payConsent['id']; // payment consentId


// echo "<pre>";
// print_r($payConsent);
// die;

// verify a payment-consent.

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_consents/'.$PaymentConcent_Id.'/verify',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//   "amount" : "120",
//   "descriptor": "string",
//   "device_data": {
//     "accept_header": "*/*",
//     "browser": {
//       "java_enabled": false,
//       "javascript_enabled": true,
//       "user_agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36"
//     },
//     "device_id": "dev12",
//     "language": "EN or en-US",
//     "location": {
//       "lat": "-37.81892",
//       "lon": "144.95913"
//     },
//     "mobile": {
//       "device_model": "Apple IPHONE 7",
//       "os_type": "IOS or ANDROID",
//       "os_version": "IOS 14.5"
//     },
//     "screen_color_depth": 24,
//     "screen_height": 1080,
//     "screen_width": 1920,
//     "timezone": "-2 or 3:30"
//   },
//   "payment_method": {
//     "ach_direct_debit": {
//       "aba_routing_number": "123456789",
//       "account_number": "1234567890",
//       "business_account": false,
//       "owner_email": "john.doe@gmail.com",
//       "owner_name": "John Doe"
//     },
//     "applepay": {
//       "billing": {
//         "address": {
//           "city": "Shanghai",
//           "country_code": "CN",
//           "postcode": "100000",
//           "state": "Shanghai",
//           "street": "Pudong District"
//         },
//         "date_of_birth": "2011-10-23",
//         "email": "john.doe@airwallex.com",
//         "first_name": "John",
//         "last_name": "Doe",
//         "phone_number": "13800000000"
//       },
//       "encrypted_payment_token": "string",
//       "payment_data_type": "encrypted_payment_token",
//       "tokenized_card": {
//         "authentication_method": {
//           "emv": {
//             "emv_data": "string",
//             "encrypted_pin_data": "string"
//           },
//           "three_ds": {
//             "eci_indicator": "string",
//             "online_payment_cryptogram": "string"
//           },
//           "type": "string"
//         },
//         "device_manufacturer_identifier": "050110030222",
//         "expiry_month": "12",
//         "expiry_year": "2030",
//         "name": "John Doe",
//         "number": "4035501000000008"
//       }
//     },
//     "bacs_direct_debit": {
//       "account_number": "12345678",
//       "address": {
//         "line1": "777 Casino Drive",
//         "line2": "Apartment 123",
//         "postcode": "A11 B12",
//         "town": "LONDON"
//       },
//       "bank_name": "revolut",
//       "owner_email": "john.doe@gmail.com",
//       "owner_name": "John Doe",
//       "sort_code": "123456"
//     },
//     "becs_direct_debit": {
//       "account_number": "1234567890",
//       "bsb_number": "123456",
//       "owner_email": "john.doe@gmail.com",
//       "owner_name": "John Doe"
//     },
//     "card": {
//       "additional_info": {
//         "merchant_verification_value": "A52BD7",
//         "token_requestor_id": "50272768100"
//       },
//       "billing": {
//         "address": {
//           "city": "Shanghai",
//           "country_code": "CN",
//           "postcode": "100000",
//           "state": "Shanghai",
//           "street": "Pudong District"
//         },
//         "date_of_birth": "2011-10-23",
//         "email": "john.doe@airwallex.com",
//         "first_name": "John",
//         "last_name": "Doe",
//         "phone_number": "13800000000"
//       },
//       "cvc": "123",
//       "expiry_month": "12",
//       "expiry_year": "2030",
//       "name": "John Doe",
//       "number": "4035501000000008",
//       "number_type": "PAN"
//     },
//     "googlepay": {
//       "billing": {
//         "address": {
//           "city": "Shanghai",
//           "country_code": "CN",
//           "postcode": "100000",
//           "state": "Shanghai",
//           "street": "Pudong District"
//         },
//         "date_of_birth": "2011-10-23",
//         "email": "john.doe@airwallex.com",
//         "first_name": "John",
//         "last_name": "Doe",
//         "phone_number": "13800000000"
//       },
//       "encrypted_payment_token": "string",
//       "payment_data_type": "encrypted_payment_token",
//       "tokenized_card": {
//         "authentication_method": {
//           "emv": {
//             "emv_data": "string",
//             "encrypted_pin_data": "string"
//           },
//           "three_ds": {
//             "eci_indicator": "string",
//             "online_payment_cryptogram": "string"
//           },
//           "type": "string"
//         },
//         "device_manufacturer_identifier": "050110030222",
//         "expiry_month": "12",
//         "expiry_year": "2030",
//         "name": "John Doe",
//         "number": "4035501000000008"
//       }
//     },
//     "id": "'.$getPay_id.'",
//     "sepa_direct_debit": {
//       "bank_name": "revolut",
//       "country_code": "DE",
//       "iban": "DE123456789012345",
//       "owner_email": "john.doe@gmail.com",
//       "owner_name": "John Doe"
//     },
//     "type": "card"
//   },
//   "request_id": "88bf9327-0c10-4e87-b050-s4sddvc6",
//   "return_url": "https://allan.biz",
//   "risk_control_options": {
//     "skip_risk_processing": false,
//     "tra_applicable": false
//   },
//   "verification_options": {
//     "alipaycn": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "alipayhk": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "card": {
//       "amount": 0,
//       "cryptogram": "AgAAAAAAPRpgCwAAmdDBgskAAAA=",
//       "currency": "CNY",
//       "cvc": "124",
//       "risk_control": {
//         "skip_risk_processing": false,
//         "three_domain_secure_action": "FORCE_3DS",
//         "three_ds_action": "FORCE_3DS"
//       },
//       "three_ds_action": "FORCE_3DS"
//     },
//     "dana": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "gcash": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "kakaopay": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "tng": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "truemoney": {
//       "flow": "webqr",
//       "os_type": "android"
//     },
//     "wechatpay": {
//       "currency": "CNY",
//       "flow": "webqr",
//       "ip_address": "192.168.0.1",
//       "open_id": "oeTcWwyQ0TnCAZvjj8ltcNigWnBI"
//     }
//   }
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Authorization: Bearer ' . $getToken,
//     'x-client-ip: string',
//     'x-client-ip-source: string'
//   ),
// ));

// $responseVerifyConsentPay = curl_exec($curl);

// curl_close($curl);

// $payVerifyConsent = json_decode($responseVerifyConsentPay,true);

// // $PaymentConcent_Id = $payConsent['id'];

// echo "<pre>";
// print_r($payVerifyConsent);
// die;




// create payment intent.

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_intents/create',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'{
//     "request_id": "5b26118f-fc21-4504-80da-4a3s66",
//     "customer_id": "'.$customerId.'",
//     "payment_method": "'.$getPay_id.'",
//     "amount": 541,
//     "currency": "AUD",
//     "merchant_order_id": "Merchant_Order_d9fs44b9b-3583-4441-a8sf3-30x9as62",
//     "return_url": "https://allan.biz"
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'Authorization: Bearer ' . $getToken,
//   ),
// ));

// $responsePayIntent = curl_exec($curl);

// curl_close($curl);

// $paymentIntent = json_decode($responsePayIntent,true);

// // echo "<pre>";
// // print_r($paymentIntent);
// // die;

// $getPayIntentId = "int_hkdm4226rgoxkpp9h1z";


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
  "amount": 100.01,
  "connected_account_id": "acct_4lnVokTfP3ulKDlzLDJdjg",
  "currency": "USD",
  "customer": {
    "additional_info": {
      "first_successful_order_date": "2019-09-18",
      "last_modified_at": "2019-09-18T12:30:00Z",
      "purchase_summaries": [
        {
          "currency": "USD",
          "first_successful_purchase_date": "2019-01-01",
          "last_successful_purchase_date": "2019-01-01",
          "payment_method_type": "klarna",
          "successful_purchase_amount": 123.45,
          "successful_purchase_count": 1
        }
      ],
      "registered_via_social_media": false,
      "registration_date": "2019-09-18"
    },
    "address": {
      "city": "Shanghai",
      "country_code": "CN",
      "postcode": "100000",
      "state": "Shanghai",
      "street": "Pudong District"
    },
    "business_name": "Abc Trading Limited",
    "email": "john.doe@airwallex.com",
    "first_name": "John",
    "last_name": "Doe",
    "merchant_customer_id": "string",
    "phone_number": "13800000000"
  },
  "customer_id": "cus_ps8e0ZgQzd2QnCxVpzJrHD6KOVu",
  "descriptor": "Airwallex - T-shirt",
  "merchant_order_id": "cc9bfc13-ba30-483b-a62c-ee925fc9bfea",
  "metadata": {
    "id": 1
  },
  "order": {
    "products": [
      {
        "code": "3414314111",
        "desc": "IPHONE 7",
        "effective_end_at": "2020-12-31T23:59:59Z",
        "effective_start_at": "2020-01-01T00:00:00Z",
        "name": "IPHONE7",
        "quantity": 5,
        "seller": {
          "identifier": "string",
          "name": "string"
        },
        "sku": "100004",
        "type": "physical",
        "unit_price": 100.01,
        "url": "http://airwallex/product/23213"
      }
    ],
    "sellers": [
      {
        "additional_info": {
          "address_updated_at": "2023-01-01T00:00:00",
          "email_updated_at": "2023-01-01T00:00:00Z",
          "password_updated_at": "2023-01-01T00:00:00Z",
          "products_updated_at": "2023-01-01T00:00:00Z",
          "sales_summary": {
            "currency": "string",
            "period": "string",
            "sales_amount": 0,
            "sales_count": 0
          }
        },
        "business_info": {
          "email": "john.doe@airwallex.com",
          "phone_number": "13800000000",
          "postcode": "10000",
          "rating": 4.5,
          "registration_date": "2019-09-18"
        },
        "identifier": "string",
        "name": "string"
      }
    ],
    "shipping": {
      "address": {
        "city": "Shanghai",
        "country_code": "CN",
        "postcode": "100000",
        "state": "Shanghai",
        "street": "Pudong District"
      },
      "first_name": "John",
      "last_name": "Doe",
      "phone_number": "13800000000",
      "shipping_method": "sameday"
    },
    "supplier": {
      "address": {
        "city": "Shanghai",
        "country_code": "CN",
        "postcode": "100000",
        "state": "Shanghai",
        "street": "Pudong District"
      },
      "business_name": "Abc Trading Limited",
      "email": "john.doe@airwallex.com",
      "first_name": "John",
      "last_name": "Doe",
      "phone_number": "13800000000"
    },
    "type": "physical_goods"
  },
  "payment_method_options": {
    "card": {
      "risk_control": {
        "skip_risk_processing": false,
        "three_domain_secure_action": "FORCE_3DS",
        "three_ds_action": "FORCE_3DS"
      },
      "three_ds_action": "FORCE_3DS"
    }
  },
  "request_id": "ee939540-3203-4a2c-9172-89a566485dd9",
  "return_url": "http://www.example.com",
  "risk_control_options": {
    "skip_risk_processing": false,
    "tra_applicable": false
  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ0b20iLCJyb2xlcyI6WyJ1c2VyIl0sImlhdCI6MTQ4ODQxNTI1NywiZXhwIjoxNDg4NDE1MjY3fQ.UHqau03y5kEk5lFbTp7J4a-U6LXsfxIVNEsux85hj-Q'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$paymentIntentRes = json_decode($response,true);

echo "<pre>";
print_r($paymentIntentRes);
die;


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-demo.airwallex.com/api/v1/pa/payment_intents/att_hkdmppgswgpbsu5gknz_u4ofs4/confirm',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "request_id": "b5c066a9-9c8a-4bd4-9734-03345cxz7",
    "payment_method": {
        "type": "card",
        "card": {
            "billing": {
                "address": {
                    "city": "Port Kamren",
                    "country_code": "US",
                    "postcode": "25000",
                    "state": "West Grantmouth",
                    "street": "87039 Kaleigh Terrace"
                },
                "first_name": "Ariel",
                "last_name": "Yost"
            },
            "expiry_month": "12",
            "expiry_year": "2030",
            "number": "4111111111111111"
        }
    },
    "payment_method_options": {
        "card": {
            "auto_capture": true
        }
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $getToken,
  ),
));

$responsePaymentConfirm = curl_exec($curl);

curl_close($curl);

$paymentIntent_confirm = json_decode($responsePaymentConfirm,true);

echo "<pre>";
print_r($paymentIntent_confirm);
die;










