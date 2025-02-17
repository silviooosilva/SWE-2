<?php

require_once __DIR__ . '/vendor/autoload.php';

use Silviooosilva\Phession\Phession;

Phession::start();
Phession::destroy();

header('Location: index.php');
die;
