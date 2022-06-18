#!/usr/bin/php
<?php

use App\Gentree;

require 'vendor/autoload.php';

$cli = new Gentree();
$cli->run();
