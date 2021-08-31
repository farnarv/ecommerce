<?php

require_once 'vendor/autoload.php';

use App\Http\CheckoutController;

$controller = new CheckoutController();
$controller->checkout(1);