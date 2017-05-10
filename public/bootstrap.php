<?php
/**
 * Autoload files
 */
require __DIR__.'/../vendor/autoload.php';

include(__DIR__.'/../src/Illuminati/Container/Operations.php');
include(__DIR__.'/../src/Illuminati/Container/InsertOperation.php');
include(__DIR__.'/../src/Illuminati/Container/DeleteOperation.php');
include(__DIR__.'/../src/Illuminati/Container/ReplaceOperation.php');
include(__DIR__.'/../src/Illuminati/Container/IlluminatiService.php');
include(__DIR__.'/../src/Illuminati/Container/IlluminatiServiceProvider.php');

require __DIR__.'/../app/app.php';