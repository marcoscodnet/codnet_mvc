<?php

//estados de pago.
define('CDT_PAGOS_GATEWAY_ESTADOPAGO_PENDIENTE', 1);
define('CDT_PAGOS_GATEWAY_ESTADOPAGO_CONFIRMADO', 2);
define('CDT_PAGOS_GATEWAY_ESTADOPAGO_CANCELADO', 3);

//token de paypal (específico por vendedor.
define('CDT_PAGOS_GATEWAY_PAYPAL_PDT_IDENTITY_TOKEN', 'ZyGxYJpb6vgiz1QMZeLNA-FIG7LkusIkQVrfEirRd2X8Rv_xAA6Z_Yykrn0', true);

//define('CDT_PAGOS_GATEWAY_PAYPAL_URL', 'www.paypal.com');
define('CDT_PAGOS_GATEWAY_PAYPAL_URL', 'www.sandbox.paypal.com', true);

//path para el log de paypal
define('CDT_PAGOS_GATEWAY_PAYPAL_LOG_PATH', APP_PATH . 'paypal_log/', true);

//validaciones paypal
define('CDT_PAGOS_GATEWAY_PAYPAL_IPN_VERIFIED', 'VERIFIED');
define('CDT_PAGOS_GATEWAY_PAYPAL_IPN_INVALID', 'INVALID');
define('CDT_PAGOS_GATEWAY_PAYPAL_PDT_SUCCESS', 'SUCCESS');
define('CDT_PAGOS_GATEWAY_PAYPAL_PDT_FAIL', 'FAIL');
define('CDT_PAGOS_GATEWAY_PAYPAL_PDT_TX_TOKEN', 'tx');

//******************************************
// TIPOS DE TRANSACCIONES PAYPAL.
//******************************************

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_ADJUSTMENT', 'adjustment');
//A dispute has been resolved and closed

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_CART', 'cart');
//Payment received for multiple items; source is Express Checkout or the PayPal Shopping Cart.

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_EXPRESS_CHECKOUT', 'express_checkout');
//Payment received for a single item; source is Express Checkout

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_MASSPAY', 'masspay');
//Payment sent using MassPay

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_MP_SIGNUP', 'mp_signup'); 
//Created a billing agreement

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_MERCH_PMT', 'merch_pmt'); 
//Monthly subscription paid for Website Payments Pro

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_NEW_CASE', 'new_case');
//A new dispute was filed

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT', 'recurring_payment');
//Recurring payment received

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT_EXPIRED', 'recurring_payment_expired');
//Recurring payment expired

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT_PROFILE_CREATED', 'recurring_payment_profile_created');
//Recurring payment profile created

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_RECURRING_PAYMENT_SKIPPED', 'recurring_payment_skipped');
//Recurring payment skipped; it will be retried up to a total of 3 times, 5 days apart

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SEND_MONEY', 'send_money');
//Payment received; source is the Send Money tab on the PayPal website

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_CANCEL', 'subscr_cancel');
//Subscription canceled

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_EOT', 'subscr_eot');
//Subscription expired

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_FAILED', 'subscr_failed');
//Subscription signup failed

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_MODIFY', 'subscr_modify');
//Subscription modified

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_PAYMENT', 'subscr_payment');
//Subscription payment received

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_SUBSCR_SIGNUP', 'subscr_signup');
//Subscription started

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_VIRTUAL_TERMINAL', 'virtual_terminal');
//Payment received; source is Virtual Terminal

define('CDT_PAGOS_GATEWAY_PAYPAL_TX_TYPE_WEB_ACCEPT', 'web_accept');
//Payment received; source is a Buy Now, Donation, or Auction Smart Logos button


//******************************************
// PAYMENT INFORMATION VARIABLES
//******************************************

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_AUTH_AMOUNT', 'auth_amount' );
//Authorization amount

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_AUTH_EXP', 'auth_exp' ); 
//Authorization expiration date and time, in the following format: HH:MM:SS DD Mmm YY, YYYY PST. Length: 28 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_AUTH_ID', 'auth_id' ); 
//Authorization identification number. Length: 19 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_AUTH_STATUS', 'auth_status' ); 
//Status of authorization

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_ECHECK_TIME_PROCESSED', 'echeck_time_processed'); 
//The time an eCheck was processed; for example, when the status changes to Success or Completed. The format is as follows: hh:mm:ss MM DD, YYYY ZONE, e.g. 04:55:30 May 26, 2011 PDT.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_ECHANGE_RATE','exchange_rate'); 
//Exchange rate used if a currency conversion occurred.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_FRAUD_MANAGEMENT_PENDING_FILTERS', 'fraud_managment_pending_filters_');
/*
One or more filters that identify a triggering action associated with one of the following payment_status values: Pending, Completed, Denied, where x is a number starting with 1 that makes the IPN variable name unique; x is not the filter's ID number. The filters and their ID numbers are as follows:
      1 - AVS No Match
      2 - AVS Partial Match
      3 - AVS Unavailable/Unsupported
      4 - Card Security Code (CSC) Mismatch
      5 - Maximum Transaction Amount
      6 - Unconfirmed Address
      7 - Country Monitor
      8 - Large Order Number
      9 - Billing/Shipping Address Mismatch
      10 - Risky ZIP Code
      11 - Suspected Freight Forwarder Check
      12 - Total Purchase Price Minimum
      13 - IP Address Velocity
      14 - Risky Email Address Domain Check
      15 - Risky Bank Identification Number (BIN) Check
      16 - Risky IP Address Range
      17 - PayPal Fraud Model
*/

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_INVOICE', 'invoice'); 
//Passthrough variable you can use to identify your Invoice Number for this purchase. If omitted, no variable is passed back. Length: 127 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_ITEM_NAME', 'item_name'); 
//Item name as passed by you, the merchant. Or, if not passed by you, as entered by your customer. If this is a shopping cart transaction, PayPal will append the number of the item (e.g., item_name1, item_name2, and so forth). Length: 127 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_ITEM_NUBER','item_numberx');
//Pass-through variable for you to track purchases. It will get passed back to you at the completion of the payment. If omitted, no variable will be passed back to you. If this is a shopping cart transaction, PayPal will append the number of the item (e.g., item_number1, item_number2, and so forth). Length: 127 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_CURRENCY','mc_currency');	
/*
      - For payment IPN notifications, this is the currency of the payment.
      - For non-payment subscription IPN notifications (i.e., txn_type= signup, cancel, failed, eot, or modify), this is the currency of the subscription.
      - For payment subscription IPN notifications, it is the currency of the payment (i.e., txn_type = subscr_payment)
*/

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_FEE', 'mc_fee'); 
//Transaction fee associated with the payment. mc_gross minus mc_fee equals the amount deposited into the receiver_email account. Equivalent to payment_fee for USD payments. If this amount is negative, it signifies a refund or reversal, and either of those payment statuses can be for the full or partial amount of the original transaction fee.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_GROSS', 'mc_gross'); 
//Full amount of the customer's payment, before transaction fee is subtracted. Equivalent to payment_gross for USD payments. If this amount is negative, it signifies a refund or reversal, and either of those payment statuses can be for the full or partial amount of the original transaction.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_GROSS_X', 'mc_gross_');
//The amount is in the currency of mc_currency, where x is the shopping cart detail item number. The sum of mc_gross_ x should total mc_gross.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_HANDLING', 'mc_handling');
//Total handling amount associated with the transaction.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_SHIPPING', 'mc_shipping');
//Total shipping amount associated with the transaction.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MC_SHIPPINGX','mc_shippingx');
//This is the combined total of shipping1 and shipping2 Website Payments Standard variables, where x is the shopping cart detail item number. The shipping x variable is only shown when the merchant applies a shipping amount for a specific item. Because profile shipping might apply, the sum of shipping x might not be equal to shipping.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_MEMO', 'memo'); 
//Memo as entered by your customer in PayPal Website Payments note field. Length: 255 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_NUM_CART_ITEMS', 'num_cart_items');
//If this is a PayPal Shopping Cart transaction, number of items in cart.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_OPTION_NAME', 'option_name');
//Option x name as requested by you. PayPal appends the number of the item where x represents the number of the shopping cart detail item (e.g., option_name1, option_name2). Length: 64 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_OPTION_SELECTION', 'option_selection'); 
//Option x choice as entered by your customer. PayPal appends the number of the item where x represents the number of the shopping cart detail item (e.g., option_selection1, option_selection2). Length: 200 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYER_STATUS', 'payer_status');
/*
Whether the customer has a verified PayPal account.

    -verified - Customer has a verified PayPal account.
    -unverified - Customer has an unverified PayPal account.
*/
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYER_STATUS_VERIFIED', 'verified');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYER_STATUS_UNVERIFIED', 'unverified');

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_DATE', 'payment_date');
//Time/Date stamp generated by PayPal, in the following format: HH:MM:SS DD Mmm YY, YYYY PST. Length: 28 characters

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS','payment_status');
/*	

The status of the payment:
Canceled_Reversal: A reversal has been canceled. For example, you won a dispute with the customer, and the funds for the transaction that was reversed have been returned to you.
Completed: The payment has been completed, and the funds have been added successfully to your account balance.
Created: A German ELV payment is made using Express Checkout.
Denied: You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the pending_reason variable or the Fraud_Management_Filters_x variable.
Expired: This authorization has expired and cannot be captured.
Failed: The payment has failed. This happens only if the payment was made from your customer's bank account.
Pending: The payment is pending. See pending_reason for more information.
Refunded: You refunded the payment.
Reversed: A payment was reversed due to a chargeback or other type of reversal. The funds have been removed from your account balance and returned to the buyer. The reason for the reversal is specified in the ReasonCode element.
Processed: A payment has been accepted.
Voided: This authorization has been voided.
*/
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_CANCELED_REVERSAL','Canceled_Reversal');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_COMPLETED','Completed');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_CREATED','Created');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_DENIED','Denied');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_EXPIRED','Expired');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_FAILED','Failed');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_PENDING','Pending');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_REFUNDED','REFUNDED');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_REVERSED','Reversed');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_PROCESSED','Processed');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_STATUS_VOIDED','Voided');


define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_TYPE','payment_type');
/*
echeck: This payment was funded with an eCheck.
instant: This payment was funded with PayPal balance, credit card, or Instant Transfer.
*/
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_TYPE_ECHECK','echeck');
define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PAYMENT_TYPE_INSTANT','instant');

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PENDING_REASON','pending_reason'); 
/*
This variable is set only if payment_status = Pending.

address: The payment is pending because your customer did not include a confirmed shipping address and your Payment Receiving Preferences is set yo allow you to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile.
authorization: You set the payment action to Authorization and have not yet captured funds.
echeck: The payment is pending because it was made by an eCheck that has not yet cleared.
intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview.
multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment.
order: You set the payment action to Order and have not yet captured funds.
paymentreview: The payment is pending while it is being reviewed by PayPal for risk.
unilateral: The payment is pending because it was made to an email address that is not yet registered or confirmed.
upgrade: The payment is pending because it was made via credit card and you must upgrade your account to Business or Premier status in order to receive the funds. upgrade can also mean that you have reached the monthly limit for transactions on your account.
verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment.
other: The payment is pending for a reason other than those listed above. For more information, contact PayPal Customer Service.
*/

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_PROTECTION_ELIGIBILITY','protection_eligibility');
/*
ExpandedSellerProtection: Seller is protected by Expanded seller protection
SellerProtection: Seller is protected by PayPal's Seller Protection Policy
None: Seller is not protected under Expanded seller protection nor the Seller Protection Policy
*/

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_QUANTITY','quantity'); 
//Quantity as entered by your customer or as passed by you, the merchant. If this is a shopping cart transaction, PayPal appends the number of the item (e.g. quantity1, quantity2).

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_REASON_CODE','reason_code');
/*
This variable is set if payment_status =Reversed, Refunded, or Canceled_Reversal.
adjustment_reversal: Reversal of an adjustment
buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your customer.
chargeback: A reversal has occurred on this transaction due to a chargeback by your customer.
chargeback_reimbursement: Reimbursement for a chargeback
chargeback_settlement: Settlement of a chargeback
guarantee: A reversal has occurred on this transaction due to your customer triggering a money-back guarantee.
other: Non-specified reason.
refund: A reversal has occurred on this transaction because you have given the customer a refund.
*/

//Additional codes may be returned.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_REMAINING_SETTLE','remaining_settle'); 
//Remaining amount that can be captured with Authorization and Capture

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_SETTLE_AMOUNT','settle_amount'); 
//Amount that is deposited into the account's primary balance after a currency conversion from automatic conversion (through your Payment Receiving Preferences) or manual conversion (through manually accepting a payment).

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_SETTLE_CURRENCY','settle_currency'); 
//Currency of settle_amount.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_SHIPPING','shipping'); 
//Shipping charges associated with this transaction. Format: unsigned, no currency symbol, two decimal places.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_SHIPPING_METHOD','shipping_method'); 
//The name of a shipping method from the Shipping Calculations section of the merchant's account profile. The buyer selected the named shipping method for this transaction.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_TAX','tax'); 
//Amount of tax charged on payment. PayPal appends the number of the item (e.g., item_name1, item_name2). The tax x variable is included only if there was a specific tax amount applied to a particular shopping cart item. Because total tax may apply to other items in the cart, the sum of tax x might not total to tax.

define('CDT_PAGOS_GATEWAY_PAYPAL_VAR_TRANSACTION_ENTITY','transaction_entity'); 
//Authorization and Capture transaction entity


//******************************************
//TODO buyer information variables
//******************************************

/*
 
 address_country
	

Country of customer's address

Length: 64 characters

address_city
	

City of customer's address

Length: 40 characters

address_country_code
	

ISO 3166 country code associated with customer's address

Length: 2 characters

address_name
	

Name used with address (included when the customer provides a Gift Address)

Length: 128 characters

address_state
	

State of customer's address

Length: 40 characters

address_status
	

Whether the customer provided a confirmed address. It is one of the following values:

      confirmed - Customer provided a confirmed address.
      unconfirmed - Customer provided an unconfirmed address.

address_street
	

Customer's street address.

Length: 200 characters

address_zip
	

Zip code of customer's address.

Length: 20 characters

contact_phone
	

Customer's telephone number.

Length: 20 characters

first_name
	

Customer's first name

Length: 64 characters

last_name
	

Customer's last name

Length: 64 characters

payer_business_name
	

Customer's company name, if customer is a business

Length: 127 characters

payer_email
	

Customer's primary email address. Use this email to provide any credits.

Length: 127 characters

payer_id
	

Unique customer ID.

Length: 13 characters
 
*/

//******************************************
//TODO variables de las notificaciones
//******************************************

define('CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_PARENT_TXN_ID','parent_txn_id');
/*
In the case of a refund, reversal, or canceled reversal, this variable contains the txn_id of the original transaction, 
while txn_id contains a new ID for the new transaction.

Length: 19 characters
*/

define('CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_TXN_ID','txn_id');
/*
The merchant's original transaction identification number for the payment from the buyer, against which
the case was registered.
*/

define('CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_TXN_TYPE','txn_type'); 
/*The kind of transaction for which the IPN message was sent.*/

define('CDT_PAGOS_GATEWAY_PAYPAL_NOTIFICATION_VAR_VERIFY_SIGN','verify_sign');	
/*
Encrypted string used to validate the authenticity of the transaction
*/


/*
 
 business
	
Email address or account ID of the payment recipient (that is, the merchant). Equivalent to the values of receiver_email (if payment is sent to primary account) and business set in the Website Payment HTML.
Note:

The value of this variable is normalized to lowercase characters.

Length: 127 characters

charset
	

Character set

custom
	

Custom value as passed by you, the merchant. These are pass-through variables that are never presented to your customer

Length: 255 characters

ipn_track_id
	

Internal; only for use by MTS and DTS

notify_version
	

Message's version number


receipt_id
	

Unique ID generated during guest checkout (payment by credit card without logging in).

receiver_email
	

Primary email address of the payment recipient (that is, the merchant). If the payment is sent to a non-primary email address on your PayPal account, the receiver_email is still your primary email.
Note:

The value of this variable is normalized to lowercase characters.

Length: 127 characters

receiver_id
	

Unique account ID of the payment recipient (i.e., the merchant). This is the same as the recipient's referral ID.

Length: 13 characters

resend
	

Whether this IPN message was resent (equals true); otherwise, this is the original message.

residence_country
	

ISO 3166 country code associated with the country of residence

Length: 2 characters

test_ipn
	

Whether the message is a test message. It is one of the following values:

    1 - the message is directed to the Sandbox


 
 */


?>