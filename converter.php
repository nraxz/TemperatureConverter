#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Converter\TemperatureConverter;

$application = new Application('Tempreture Converter');
$converter = new TemperatureConverter();

$application->add($converter);

$application->setDefaultCommand($converter->getName(), true);

$application->run();

