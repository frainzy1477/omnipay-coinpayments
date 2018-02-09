# omnipay-coinpayments
Coinpayments gateway for [Omnipay](https://github.com/thephpleague/omnipay) payment processing library.


[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Stripe support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "omnipay/stripe": "~2.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update


### Purchase

The CoinPayments integration is fairly straight forward.

```php
$gateway = Omnipay::create('CoinPayments');

$gateway->setMerchantId('b65b2c534aced4d3f6082091aab9a3d7');
$gateway->setPrivateKey('9830beCbAe6D66460b05997530bE969D66bBa5ef0Ae0424D05a6824F97cBF7d1');
$gateway->setPublicKey('8b47f589f38cc1d177e93753ab2eb6c02a02b437d1fa1ca9a953c6928e0fa394');
$gateway->setIpnSecret('StrongSecret');


$response = $gateway->purchase([
    'amount' => '10.00',
    'currency' => 'USD', // USD, RUB, EUR, etc.
    'paymentMethod' => 'CreditCard', // Qiwi, CreditCard, YandexMoney, BankTransfer
    'returnUrl' => 'http://merchant.com/success', // Redirect to success page
    'cancelUrl' => 'http://merchant.com/failed', // Redirect to failed page
    'notifyUrl' => 'http://merchant.com/notify', // Notify URL
    'description' => 'Description'
])->send();
```
