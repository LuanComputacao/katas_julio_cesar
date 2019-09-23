<?php

use Codenation\CodenationJob;
use Codenation\Cyphers\Cesar;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../', '.env');
$dotenv->load();

$codenationJob = new CodenationJob(new Cesar());
$codenationJob->process();
