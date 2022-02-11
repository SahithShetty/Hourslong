<?php
require_once("PayPal-PHP-SDK-1.14.0/PayPal-PHP-SDK/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Afex824T-ZlIKAeGeIZxLIqRlBZc0zDfREohhxzkF4qVtTnmbpdKSw9Xo90lbrGg4LutucG4DAP9DuGj',     // ClientID
        'EH67Vv6COc07bYJa50yy8x0dFNG6IZk3gPWn6bRU9FEFtQcf2ppQ8Qgh7I6yhI_9gbaro7xGShUBC5bI'      // ClientSecret
    )
);
?>