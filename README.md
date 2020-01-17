# Omnipay: Paylane

**Paylane driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Dummy support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "sylapi/paylane": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Paylane

This is a dummy gateway driver intended for testing purposes. If you provide a card number ending in an even number, the driver will return a success response. If it ends in an odd number, the driver will return a generic failure response. For example:

* 4111111111111111 - Visa - Sale successful
* 5500000000000004 - MasterCard - Sale successful
* 370000000000002 - American Express - Sale successful
* 4000000000000069 - Visa - 3-D Secure authentication is required.(sale error 700)
* 4012001036275556 - Visa - Unable to verify card enrollment (enrollment check error 720)
* 4012001038488884 - Visa - Unable to verify card enrollment (enrollment check error 720)
* 4012001036298889 - Visa - Unable to verify card enrollment (enrollment check error 720)
* 4012001038443335 - Visa - 3-D Secure Enrollment testing – card not enrolled in 3-D Secure
* 4012001036853337 - Visa - Card enrolled, verification failed (sale error 703)
* 4012001036983332 - Visa - Card enrolled, verification failed (sale error 703)
* 4012001037490006 - Visa - Card enrolled, verification failed (sale error 703)
* 4012001037461114 - Visa - Card enrolled, authentication failure (sale error 704)
* 4012001037484447 - Visa -Card enrolled, authentication not available (sale error 725)

[All errors](https://paylane.pl/devzone/wdrazanie-testy/#testowe-numery-kart) Paylane system

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/sylapi/omnipay-paylane/issues),
or better yet, fork the library and submit a pull request.
