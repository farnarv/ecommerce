#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \App\Command\CheckoutCommand());

$application->run();
