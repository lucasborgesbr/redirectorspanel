<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26d0f58aabd9bf27d0cfd23ff1be7f5d
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sample\\' => 7,
        ),
        'P' => 
        array (
            'PayPalCheckoutSdk\\' => 18,
        ),
        'B' => 
        array (
            'BraintreeHttp\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sample\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypal-checkout-sdk/samples',
        ),
        'PayPalCheckoutSdk\\' => 
        array (
            0 => __DIR__ . '/..' . '/paypal/paypal-checkout-sdk/lib/PayPalCheckoutSdk',
        ),
        'BraintreeHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/braintree/braintreehttp/lib/BraintreeHttp',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26d0f58aabd9bf27d0cfd23ff1be7f5d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26d0f58aabd9bf27d0cfd23ff1be7f5d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}